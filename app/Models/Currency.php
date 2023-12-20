<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

  protected $fillable = [
    'name',
    'code',
    'symbol',
    'html_entity',
  ];
  public function users(){
      return $this->hasMany('App\Models\User');
    }

public function settings(){
    return $this->hasOne('App\Models\Setting');
  }

}
