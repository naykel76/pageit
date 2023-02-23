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

    /**
     * Defines the layout a page will use when the show method is called
     */
    const LAYOUTS = [
        'default' => 'General Page',
        'banner' => 'Banner',
    ];

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

    public function isCategory()
    {
        return $this->is_category ? true : false;
    }

    public function isParentCategory()
    {
        return $this->route_prefix ? numSegments($this->route_prefix) == 1 && $this->is_category : false;
    }

    public function isSubCategory()
    {
        return $this->route_prefix ? numSegments($this->route_prefix) == 2 && $this->is_category : false;
    }

    /**
     * ----------------------------------------------------------------------
     * QUERY SCOPES
     * ----------------------------------------------------------------------
     *
     *
     */

    // /**
    //  * Fetch all categories and sub-categories.
    //  */
    // public function scopeCategories($query)
    // {
    //     return $query->select('is_category', true);
    // }



    // public function scopePagesByCategory($query, $routePrefix)
    // {
    //     return $query->where('route_prefix', 'like',  $routePrefix . '%');
    // }
}
