<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        $this->belongsToMany('App\Role', 'role_user');
    }

    public function hasAccess(array $permissions) : bool {
        foreach ($this->roles as $role){
            if($role->hasAccess($permissions)){
                return true;
            }
        }

        return false;
    }

    public function inRole(string $roleSlug){
        $this->roles()->where('slug', $roleSlug)->count() == 1;
    }
}
