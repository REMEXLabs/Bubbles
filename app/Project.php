<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
      'name',
      'description',
      'user_id'
    ];

    public static $public = [
      'id',
      'name',
      'description',
      'user_id',
      'created_at',
      'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User')->get()->first();
    }

    public function resources()
    {
        return $this->morphToMany('App\Resource', 'resourceable');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'tagable');
    }
}
