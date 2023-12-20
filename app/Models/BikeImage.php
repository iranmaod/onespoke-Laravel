<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class BikeImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    public function directoryPath() : string
    {
        return sprintf("bike-images/%s", $this->bike->getRouteKey());
    }

    public function filePath() : string
    {
        return sprintf("%s/%s", $this->directoryPath(), $this->filename);
    }

    public function url() : string
    {
        return Storage::url($this->filePath());
    }

    public function thumbDirectoryPath() : string
    {
        return sprintf("bike-thumbs/%s", $this->bike->getRouteKey());
    }

    public function thumbFilePath() : string
    {
        return sprintf("%s/%s", $this->thumbDirectoryPath(), $this->filename);
    }

    public function thumbUrl() : string
    {
        return Storage::url($this->thumbFilePath());
    }

}
