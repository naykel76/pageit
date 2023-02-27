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

    protected $casts = [
        'config' => 'array'
    ];

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
            // if a slug exists leave it alone.
            ->skipGenerateWhen(fn () => !empty($this->slug));
    }

    /**
     * ----------------------------------------------------------------------
     *
     * ----------------------------------------------------------------------
     *
     */
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
     */

    public function scopeCategoryLandingPages($query)
    {
        $query->select('id', 'title', 'route_prefix', 'slug', 'is_category')
            ->where('is_category', true);
    }

    /**
     * SELECT pages WHERE 'route_prefix' NOT IN 'categoryLandingPages'
     */
    public function scopeUncategorisedPages($query)
    {
        $query->select('id', 'title', 'route_prefix', 'slug', 'is_category')
            ->whereNotIn('route_prefix', function ($query) {
                $query->select('route_prefix')
                    ->from('pages')
                    ->where('is_category', true);
            });
    }

    public function scopePagesNotCategory($query)
    {
        $query->select('id', 'title', 'route_prefix', 'slug', 'is_category')
            ->where('is_category', false);
    }
}
