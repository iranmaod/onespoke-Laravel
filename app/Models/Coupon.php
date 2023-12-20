<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'per_off',
        'percentage_off',
        'customer_age',
        'usage_total',
        'usage_per_customer',
        'min_product',
        'min_item',
        'min_amount',
        'start_date',
        'end_date',
        'activation_method',
        'status'
      ];
}
