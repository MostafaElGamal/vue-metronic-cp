<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\ResourceCollection;

class roleResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $roles = [];

        foreach ($this->collection as $role) {
            array_push($roles, [
                'name' => $role->name,
                'id' => $role->id,
                'status' => $role->status,
                'permissions' => $role->permissions,
                'time' => $role->created_at->format('Y-m-d')
            ]);
        }
        return $roles;
    }
}
