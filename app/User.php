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
     * Get the created projects by the user.
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    /**
     * Get the created resources by the user.
     */
    public function resources()
    {
        return $this->hasMany('App\Resource', 'author_id')
            ->orderBy('id', 'DESC');
    }

    /**
     * Get the created quests by the user.
     */
    public function createdQuests()
    {
        return $this->hasMany('App\Quest', 'author_id')
            ->orderBy('id', 'DESC');
    }

    /**
     * Get the accepted quests by the user.
     */
    public function acceptedQuests()
    {
        return $this->hasMany('App\Quest', 'editor_id')
            ->where('state', 'wip')
            ->orderBy('id', 'DESC');
    }

    /**
     * Get the resolved quests by the user.
     */
    public function resolvedQuests()
    {
        return $this->hasMany('App\Quest', 'editor_id')
            ->where('state', 'resolved')
            ->orderBy('id', 'DESC');
    }

}
