<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'original_url',
        'slug',
        'image',
        'image_ex1',
        'image_ex2',
        'image_ex3',
        'image_ex4',
        'image_ex5',
        'supplier_id',
        'views_count',
        'cart_count',
        'parent_id',
        'variant_id',
        'variant_name',
        'unique_value',
        'variant_name',
        'category_id',
        'rating_id',
        'supplier_price',
        'stock',
        'active',
      ];
      public function category(){
        return $this->belongsTo('App\Models\Category');
      }
      public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
      }
      public function variant_type(){
        return $this->belongsTo('App\Models\Variant', 'variant_id');
      }
      public function parent()
        {
            return $this->belongsTo('App\Models\Products', 'parent_id');
        }
    
        public function variants()
        {
            return $this->hasMany('App\Models\Products', 'parent_id');
        }
    
      public function sub_invoice(){
        return $this->belongsTo(Child_Invoice::class,'id','product_id');
      }
}
