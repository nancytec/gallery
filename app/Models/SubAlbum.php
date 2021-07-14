<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SubAlbum extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImagePathAttribute()
    {
        return Storage::disk('public')->url($this->image);

    }
}
