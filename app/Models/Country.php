<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  protected $fillable = [
    'name',
    'code',
  ];
  public function users(){
      return $this->hasMany('App\User');
    }
public function suppliers(){
    return $this->hasMany('App\Supplier');
  }
}
