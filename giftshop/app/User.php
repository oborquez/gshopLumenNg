<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Http\Request; 

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
    protected $table = 'user';
    protected $fillable = [
        'name', 'email','password','api_token','level'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    static function isAdminUser(Request $request)
    {
        if ($request->header('api_token')) {
            $user = User::where('api_token', $request->header('api_token') )->first();
            return $user->level == 2 ? true : false; 
        }
        return false;
        
    }
}
