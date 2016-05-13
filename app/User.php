<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function profile(){
        return $this->hasOne('App\UserProfile');
    }
    
    public function events(){
        return $this->hasMany('App\Event');
    }
    public function friends(){
        return $this->hasMany('App\Friend');
    }
    public function getId()
    {
        return $this->id;
    }
}
