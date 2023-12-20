<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    const MOUNTAIN_BIKE = 1;
    const ROAD = 2;
    const OTHER = 3;

    protected $guarded = ['id'];

    public function types()
    {
        return $this->hasMany(FrameType::class);
    }
    protected $parent = ['parent_id'];

      public function products(){
          return $this->hasMany('App\Models\Product');
        }
    
      public function parent()
        {
            return $this->belongsTo('App\Models\Category', 'parent_id');
        }
    
        public function children()
        {
            return $this->hasMany('App\Models\Category', 'parent_id');
        }

}
