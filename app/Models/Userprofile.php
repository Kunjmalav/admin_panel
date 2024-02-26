<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Media;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ImageOptimizer\OptimizerChainFactory;


class Userprofile extends Model implements HasMedia,Authenticatable
{
    use HasFactory, InteractsWithMedia, AuthenticatableTrait;

    protected $fillable = ['name', 'mobile', 'password', 'username', 'media_id'];

    public function userMedia()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_photo_video');
    }

    // public function compressAndSaveImage($path): void
    // {
    //     // Implement your image compression logic here
    //     $this->addMediaConversion('compressed')
    //         ->optimize()
    //         ->quality(50); // You can adjust the quality as needed
    // }
    public function compressAndSaveImage($path): void
    {
        // Add the media conversion for compression
        $this->addMediaConversion('compressed')
            ->optimize()
            ->quality(50); // You can adjust the quality as needed
    
        // Retrieve the default collection and perform the conversion
        $this->getMedia('profile_photo_video')->first()->performConversions(['compressed']);
    }
}
