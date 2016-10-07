<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'color',
        'author_id',
    ];

    public static function getValidationRules()
    {
        return array(
            'name' => 'required|max:255',
        );
    }

    public function projects()
    {
        return $this->morphedByMany('App\Project', 'tagable');
    }

    public function quests()
    {
        return $this->morphedByMany('App\Quest', 'tagable');
    }
}
