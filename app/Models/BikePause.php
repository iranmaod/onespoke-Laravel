<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikePause extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        self::created(function($model) {

        });

        self::updated(function($model) {

        });

        self::deleted(function($model) {
            $model->updateParentTotal();
        });
    }

    public function updateParentTotal()
    {
        $this->bike->updatePauseTotal();
    }

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    public function siblings()
    {
        return $this->hasMany(self::class, 'bike_id', 'bike_id')->where('id', '!=', $this->id);
    }

}
