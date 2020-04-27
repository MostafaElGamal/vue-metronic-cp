<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Resources\Role\roleResource;
use App\Http\Resources\Role\ShowResource;
use App\Permission;
use App\Role;

class RoleController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:manage-posts', ['only' => ['create']]);
    //     $this->middleware('permission:edit-posts',   ['only' => ['edit']]);
    //     $this->middleware('permission:view-posts',   ['only' => ['show', 'index']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('name', '!=', 'superadministrator')->orderBy('name')->paginate(50);
        return new roleResource($roles);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_02()
    {
        $roles = Role::where('name', '!=', 'superadministrator')->get();
        return new roleResource($roles);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        if ($role->name != 'superadministrator') {
            return new ShowResource($role);
        } else {
            return Response()->json(404);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->name,
            'description' => $request->description
        ]);
        $role->permissions()->sync(array_column($request->permissions, 'id'));
        return Response()->json($role, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'display_name' => $request->name,
            'description' => $request->description,
        ]);

        $role->permissions()->sync(array_column($request->permissions, 'id'));


        return Response()->json($role, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->users()->count() >= 1) {
            return Response()->json(['message' => 'This Role Has Users Delete them then get back to me'], 403);
        } else {
            $role->delete();
            return response()->json('Deleted', 200);
        }
    }

    public function deactivate(Role $role)
    {
        if ($role->users()->count() >= 1) {
            return Response()->json(['message' => 'This Role Has Users Delete them then get back to me'], 403);
        } else {
            $role->update([
                'status' => 'deactivate'
            ]);


            return  Response()->json('Role Deactivated', 200);
        }
    }

    public function activate(Role $role)
    {
        if ($role->status == 'deactivate') {
            $role->update([
                'status' => 'active'
            ]);
            return  Response()->json('Role Activated', 200);
        }

        return  response()->json('The Role is already Activate', 405);
    }


    public function findRoles(Request $request)
    {

        $name = $request->name;
        $status = $request->status;


        if (!empty($name)) {
            $roles = Role::where('name', 'like', '%' . $name . '%')->paginate(10);
        }

        if (!empty($status)) {
            $roles = Role::where('status', 'like', '%' . $status . '%')->paginate(10);
        }


        return response()->json(['data' => $roles]);
    }



    public function permissions()
    {
        return Response()->json(Permission::all(), 200);
    }
}
