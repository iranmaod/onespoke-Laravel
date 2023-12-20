<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrawlerEbay extends Model
{
  protected $fillable = [
    'affiliate_id',
    'product_block_ini',
    'product_name_element',
    'product_url_element',
    'product_image_element',
    'product_price_element',
  ];
}
