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
        'username',
        'email',
        'email_public',
        'password',
        'name',
        'bio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role',
    ];

    public function isAnAdmin() {
        return (bool)($this->role == 'admin');
    }

    /**
     * Get the comments for the blog post.
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

}
