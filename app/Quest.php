<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
  // Preferences:

  protected $fillable = [
      'name',
      'description',
      'author_id',
      'editor_id',
      'language',
      'difficulty',
      'state',
      'points',
  ];


  // Statics:

  public static function getValidationRules() {
    return array(
      'name' => 'required|max:255',
      'description' => 'required',
      'difficulty' => 'required|in:'.implode(',', array_keys(Quest::getDifficulties())),
    );
  }

  public static function getDifficulties() {
    return array(
      'easy' => 'Easy',
      'normal' => 'Normal',
      'hard' => 'Hard'
    );
  }

  public static function getDefaultDifficulty() {
    return 'normal';
  }

  public static function getStates() {
    return array(
      'open' => 'Open',
      'wip' => 'Work in progress',
      'resolved' => 'Resolved'
    );
  }


  // Attributes:

  function getPointsAttribute() {
    $points = 10;
    switch ($this->difficulty) {
      case 'easy': $points *= 1.0; break;
      case 'normal': $points *= 1.5; break;
      case 'hard': $points *= 2.0; break;
    }
    return (int)$points;
  }

  public function author() {
      return $this->belongsTo('App\User')->get()->first();
  }

  public function editor() {
      return $this->belongsTo('App\User')->get()->first();
  }

}
