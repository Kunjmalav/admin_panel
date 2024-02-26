<?php

// app/Models/Media.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasFactory;

    public function userprofile()
    {
        return $this->hasOne(Userprofile::class, 'media_id');
    }
}
