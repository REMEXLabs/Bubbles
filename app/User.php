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
        'quests_public',
        'password',
        'name',
        'bio',
    ];

    public static function getRegistrationValidationRules()
    {
        return array(
            'username'    => 'required|regex:/^[A-Za-z0-9\-_]+$/|unique:users,username|min:3|max:255',
            'email'       => 'required|email|unique:users,email|max:255',
            'password'    => 'required|min:6|max:255|confirmed',
            'terms'       => 'required'
        );
    }

    public static function getValidationRules()
    {
        return array(
            'name' => 'regex:/^[A-Za-zÀ-ÿäöüÄÖÜá\- ]+$/i|min:3|max:255',
        );
    }

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

    // /^[\pL\s]+$/u

    public function isAnAdmin()
    {
        return (bool)($this->role == 'admin');
    }

    /**
     * Get the created bubbles by the user.
     */
    public function bubbles()
    {
        return $this->hasMany('App\Bubble')
            ->orderBy('order', 'DESC')
            ->orderBy('id', 'DESC');
        ;
    }

    /**
     * Get the created bubbles by the user.
     */
    public function questBubbles()
    {
        return $this->hasMany('App\Bubble')
            ->where('type', 'quest')
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'DESC');
    }

    /**
     * Get the created bubbles by the user.
     */
    public function projectBubbles()
    {
        return $this->hasMany('App\Bubble')
            ->where('type', 'project')
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'DESC');
    }

    /**
     * Get the created projects by the user.
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    /**
     * Get the created quests by the user.
     */
    public function quests()
    {
        return $this->hasMany('App\Quest', 'author_id');
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
