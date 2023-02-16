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

    // pageit::pages.page-banner-layout
    // add the layout view as the key

    /**
     * Defines the layout a page will use when the show method is called
     */
    const LAYOUTS = [
        'default' => 'General Page',
        'banner' => 'Banner',
    ];

    public function pageBlocks()
    {
        return $this->hasMany(PageBlock::class);
    }

    public function mainImageUrl()
    {
        return $this->image
            ? Storage::disk('content')->url($this->image)
            : url('/svg/placeholder.svg');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function isPublished()
    {
        return $this->published_at ? true : false;
    }

    public function scopePublished($q)
    {
        return $q->whereNotNull('published_at');
    }


    public function scopeSubCategories($query)
    {
        return $query;
    }
}
