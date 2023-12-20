<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('name', 'asc');
    }

    public function bikes()
    {
        return $this->hasMany(Bike::class)->published()->unpaused()->unsold();
    }
}
