<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
