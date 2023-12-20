<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryApp extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
      ];
      protected $parent = ['parent_id'];
      public function products(){
          return $this->hasMany('App\Product');
        }
    
      public function parent()
        {
            return $this->belongsTo('App\Category', 'parent_id');
        }
    
        public function children()
        {
            return $this->hasMany('App\Category', 'parent_id');
        }
}
