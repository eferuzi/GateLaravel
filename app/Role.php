<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug', 'permissions'
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

    public function users(){
        $this->belongsToMany('App\User', 'role_user');
    }

    public function hasAccess(array $permissions) : bool
    {
        foreach ($permissions as $permission){
            if($this->hasPermission($permission)){
                return true;
            }
        }

        return false;
    }


    private function  hasPermission($permission) : bool {
        return $this->permissions[$permission] ?? false;
    }
}
