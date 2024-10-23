<?php

namespace Naykel\Pageit\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasFactory, HasSlug;

    public $guarded = [];

    protected static function newFactory(): Factory
    {
        return \Naykel\Pageit\PageFactory::new();
    }

    // protected $casts = [
    //     'config' => 'array'
    // ];

    public function mainImageUrl()
    {
        return $this->image_name
            ? Storage::disk('content')->url($this->image_name)
            : url('https://placehold.co/400x300');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            // if a slug exists leave it alone.
            ->skipGenerateWhen(fn () => !empty($this->slug));
    }
}
