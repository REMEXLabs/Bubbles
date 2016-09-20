<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bubble extends Model
{
    protected $fillable = [
      'type',
      'user_id',
      'project_id',
      'quest_id',
      'order',
    ];

    // public static $public = [
    // ];

    public static function getValidationRules()
    {
        return array(
          'type' => 'required|in:'.implode(',', array_keys(Bubble::getTypes())),
          'project_id' => 'required_if:type,project|exists:projects,id|numeric',
          'quest_id' => 'required_if:type,quest|exists:quests,id|numeric',
          'order' => 'numeric',
        );
    }

    public static function getType($type)
    {
        $types = array(
          'project' => 'Project',
          'quest' => 'Quest',
        );
        return $types[$type];
    }

    public static function getTypes()
    {
        return array(
          'project' => 'Project',
          'quest' => 'Quest',
        );
    }

    public static function getDefaultType()
    {
        return 'project';
    }

    public function user()
    {
        return $this->belongsTo('App\User')->get()->first();
    }

    public function project()
    {
        return $this->belongsTo('App\Project')->get()->first();
    }

    public function quest()
    {
        return $this->belongsTo('App\Quest')->get()->first();
    }

    public static function map($val, $iStart, $iStop, $oStart, $oStop)
    {
        return $oStart + ($oStop - $oStart) * (($val - $iStart) / ($iStop - $iStart));
    }
}
