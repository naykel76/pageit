<?php

namespace Naykel\Pageit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

class Page extends Model
{
    use HasFactory, HasSlug;

    public function pageBlocks()
    {
        return $this->hasMany(PageBlock::class);
    }

    public function mainImageUrl()
    {
        return $this->image
            ? Storage::disk('public')->url($this->image)
            : url('/svg/placeholder.svg');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function isPublished()
    {
        return $this->published_at ? true : false;
    }
}
