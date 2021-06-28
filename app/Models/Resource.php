<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'topic_id',
        'resourceable_id',
        'resourceable_type',
        'layout',
        'show_steps',
        'sort',
        'parent',
        'active'
    ];
    
    public function resourceable() {
        return $this->morphTo();
    }
    
    public function topics() {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function parent() {
    	return $this->belongsTo(self::class, "parent")->with('parent');
  	}

    public function parentStep() {
    	return $this->belongsTo(self::class, "parent")->with('parentStep');
  	}

    public static function rearrange($array) {
        self::_rearrange($array, 0);
    }

    private static function _rearrange($array, $count, $parent = 0) {
    	foreach($array as $a) {
          $count++;
          self::where('id', $a['id'])->update(['parent'=> $parent, 'sort' => $count]);
          if(isset($a['children'])) {
            $count = self::_rearrange($a['children'], $count, $a['id']);
          }
        }

        return $count;
    } 

    public function children() {
        return $this->hasMany(self::class, "parent")->orderBy('sort','ASC');
    }
    
    
    public function explanations() {
        return $this->hasMany(Explanation::class);
    }

    public function resources() {
        return $this->hasMany(PageAdditional::class);
    }
}