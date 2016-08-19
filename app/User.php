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

    function pointsToLevelUp()
    {
        $points = $this->points;
        if ($points > 1250) {
            $level = (int)$points/250;
            return ($level + 1) * 250;
        }
        if ($points > 1000) {
            return 1250;
        }
        if ($points > 750) {
            return 1000;
        }
        if ($points > 500) {
            return 750;
        }
        if ($points > 300) {
            return 500;
        }
        if ($points > 200) {
            return 300;
        }
        if ($points > 100) {
            return 200;
        }
        if ($points > 50) {
            return 100;
        }
        if ($points > 10) {
            return 50;
        }
        return 10;
    }

    function level()
    {
        $points = $this->points;
        if ($points > 1250) {
            $points = $points - 1000;
            return 10 + (int)($points/250);
        }
        if ($points > 1000) {
            return 9;
        }
        if ($points > 750) {
            return 8;
        }
        if ($points > 500) {
            return 7;
        }
        if ($points > 300) {
            return 6;
        }
        if ($points > 200) {
            return 5;
        }
        if ($points > 100) {
            return 4;
        }
        if ($points > 50) {
            return 3;
        }
        if ($points > 10) {
            return 2;
        }
        return 1;
    }

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
     * Get the finished quests by the user.
     */
    public function checkingQuests()
    {
        return $this->hasMany('App\Quest', 'editor_id')
            ->where('state', 'check')
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
