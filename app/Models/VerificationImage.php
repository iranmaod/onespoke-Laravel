<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class VerificationImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function directoryPath() : string
    {
        return sprintf("verification-images/%s", $this->user->getRouteKey());
    }

    public function filePath() : string
    {
        return sprintf("%s/%s", $this->directoryPath(), $this->filename);
    }

    public function url() : string
    {
        return Storage::url($this->filePath());
    }

    public function temporaryUrl($minutes = 5) : string
    {
        return Storage::temporaryUrl(
            $this->filePath(),
            now()->addMinutes($minutes),
            [
                'ResponseContentType' => 'application/octet-stream',
                'ResponseContentDisposition' => 'attachment; filename=' . $this->original_filename,
            ]
        );
    }

}
