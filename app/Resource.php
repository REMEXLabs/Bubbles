<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
  protected $fillable = [
      'type',
      'data',
      'author_id',
      'description',
  ];

  public static function getValidationRules() {
    return array(
      'type' => 'required|in:'.implode(',', array_keys(Resource::getTypes())),
      'data' => 'required|max:255',
    );
  }

  public static function getTypes() {
    $types = array(
      'git' => 'Git',
      'url' => 'URL',
      'img' => 'Image'
    );
    ksort($types);
    return $types;
  }

  public static function getDefaultType() {
    return 'git';
  }

  public function author() {
      return $this->belongsTo('App\User')->get()->first();
  }

}
