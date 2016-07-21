<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
  protected $fillable = [
      'name',
      'description',
      'author_id',
      'editor_id',
      'language',
      'difficulty',
      'stage'
  ];

  public function author() {
      return $this->belongsTo('App\User')->get()->first();
  }

  public function editor() {
      return $this->belongsTo('App\User')->get()->first();
  }

}
