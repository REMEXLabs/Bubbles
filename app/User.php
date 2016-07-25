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

    /**
     * Get the private quests of a user.
     */
    public function createdQuests()
    {
        return $this->hasMany('App\Quest', 'author_id')
            ->orderBy('id', 'DESC');
    }

    /**
     * Get the private quests of a user.
     */
    public function acceptedQuests()
    {
        return $this->hasMany('App\Quest', 'editor_id')
            ->where('state', 'wip')
            ->orderBy('id', 'DESC');
    }

    /**
     * Get the private quests of a user.
     */
    public function resolvedQuests()
    {
        return $this->hasMany('App\Quest', 'editor_id')
            ->where('state', 'resolved')
            ->orderBy('id', 'DESC');
    }

}
