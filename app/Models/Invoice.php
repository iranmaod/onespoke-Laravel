<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  protected $fillable = [

    'user_id',
    'invoice_number',
    'payment_method',
    'status',
    'tax',
    'currency_symbol',
    'country',
    'address',
    'state',
    'city',
    'phone',
    'postal_code',
    'total_products',
    'total_items',
    'total_amount_without_tax',
    'tax_amount',
    'total_amount_with_tax',
    'tracking_code',
    'amount_gain',
    'supplier_amount',
    'user_read',
    'admin_read',
    'initial_amount',
    'coupon_code',
    'coupon_amount',
    'coupon_percentage_off',
  ];
  public function user(){
      // return $this->hasMany('App\User');
      return $this->belongsTo(User::class,'user_id','id');
    }
    public function child(){
        return $this->hasMany(Child_Invoice::class,'invoice_number','invoice_number');
      }

}
