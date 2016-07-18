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

  public function user() {
      return $this->belongsTo('App\User')->get()->first();
  }

}
