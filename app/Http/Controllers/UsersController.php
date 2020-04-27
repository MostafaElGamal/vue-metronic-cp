<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\AdminRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\Users\indexResource;
use App\Http\Resources\Users\ShowResource;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('name', '!=', 'superadministrator')->orderBy('name')->paginate(15);
        return new indexResource($users);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new ShowResource($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->attachRole($request->role);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $password = function () use ($request, $user) {
            if ($request->password) {
                return Hash::make($request->password);
            }
            return $user->password;
        };

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password()
        ]);

        $user->syncRoles([$request->role]);

        return response()->json($user, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin(AdminRequest $request, User $user)
    {
        $password = function () use ($request, $user) {
            if ($request->password) {
                return Hash::make($request->password);
            }
            return $user->password;
        };
        $user->update([
            'password' => $password(),
        ]);

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->id == $user->id) {
            return Response()->json(['message' => 'What are you doing are trying to kill your self ? '], 403);
        }

        $user->delete();
        return Response()->json('deleted');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate(User $user)
    {
        if (Auth::user()->id == $user->id) {
            return Response()->json(['message' => 'What are you doing are you trying to kill your self ? '], 403);
        } else {
            $user->update([
                'status' => 'deactivate'
            ]);
            logger(print_r($user->status, true));
            return  Response()->json('User Deactivated');
        }
    }


    public function activate(User $user)
    {
        if ($user->status == 'deactivate') {
            $user->update([
                'status' => 'active'
            ]);

            return  Response()->json('User Activated', 200);
        }
        return  response()->json('The User is already Activate', 405);
    }

    public function findUser(Request $request)
    {

        $name = $request->name;
        $email = $request->email;
        $status = $request->status;

        if (!empty($name)) {
            $users = User::where('name', 'like', '%' . $name . '%')->paginate(10);
        }

        if (!empty($email)) {
            $users = User::where('email', 'like', '%' . $email . '%')->paginate(10);
        }
        if (!empty($status)) {
            $users = User::where('status', 'like', '%' . $status . '%')->paginate(10);
        }
        return  new indexResource($users);
    }
}
