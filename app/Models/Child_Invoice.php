<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child_Invoice extends Model
{
  protected $fillable = [
    'product_id',
    'product_name',
    'product_quantity',
    'price_without_tax',
    'price_with_tax',
    'tax_amount',
    'supplier_id',
    'user_id',
    'invoice_number',
    'status',
    'currency_symbol',
    'tracking_code',
    'amount_gain',
    'supplier_price',
    'link',
    'supplier',
    'initial_amount',
    'coupon_code',
    'coupon_amount',
    'coupon_percentage_off',
  ];
  public function parent(){
      return $this->belongsTo(Invoice::class,'invoice_number','invoice_number');
    }
  public function product(){
      return $this->hasMany(Product::class,'id','product_id');
    }
  // public function sub_invoice(){
  //     return $this->belongsTo(Supplier::class,'id','supplier_id');
  //   }
}
