<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'nada_roles';

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'nada_role_permissions');
    }
}
