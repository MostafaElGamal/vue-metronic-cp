<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class indexResource extends ResourceCollection
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    $users = [];

    foreach ($this->collection as $user) {
      array_push($users, [
        'name' => $user->name,
        'id' => $user->id,
        'email' => $user->email,
        'status' => $user->status,
        'role_name' => $user->roles()->firstOrFail()->name,
        'date' => $user->created_at->format('Y-m-d')
      ]);
    }
    return $users;
  }
}
