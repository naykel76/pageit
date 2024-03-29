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

    public $guarded = [];

    protected $casts = [
        'config' => 'array'
    ];

    /**
     * Defines the layout a page will use when the show method is called
     */
    const LAYOUTS = [
        'default' => 'Default',
        'banner' => 'Banner',
        'image-wrap' => 'Image Wrap'
    ];

    public function blocks()
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
            // if a slug exists leave it alone.
            ->skipGenerateWhen(fn () => !empty($this->slug));
    }

    /**
     * ----------------------------------------------------------------------
     *
     * ----------------------------------------------------------------------
     *
     */
    public function isPublished(): bool
    {
        return $this->published_at !== null;
    }

    public function isCategory(): bool
    {
        return $this->is_category !== null;
    }

    public function isParentCategory(): bool
    {
        return $this->route_prefix ? numSegments($this->route_prefix) == 1 && $this->is_category : false;
    }

    public function isSubCategory(): bool
    {
        return $this->route_prefix ? numSegments($this->route_prefix) == 2 && $this->is_category : false;
    }

    /**
     * ----------------------------------------------------------------------
     * QUERY SCOPES
     * ----------------------------------------------------------------------
     */

    /**
     * Fetch all categories (both main and subcategory) by published status.
     */
    public function scopeCategories($query, $isPublished = true)
    {
        $query->select('id', 'route_prefix', 'title', 'slug', 'image')
            ->where('is_category', true)
            ->get();

        if ($isPublished) $query->whereNotNull('published_at');

        return $query;
    }

    /**
     * Fetch pages by the route_prefix (can be category or sub-category as
     * long as the route matches) and published status. Note: this only
     * returns selected columns to be used for navigation.
     */
    public function scopePagesByRoutePrefix($query, $routePrefix, $isPublished = true)
    {
        $query->select('id', 'route_prefix', 'title', 'slug', 'image')
            ->where('route_prefix', 'like',  $routePrefix . '%')
            ->where('is_category', false);

        if ($isPublished) $query->whereNotNull('published_at');

        return $query;
    }

    /**
     * Fetch related sub-categories by the route_prefix (category) and
     * published status. Note: this only returns selected columns to be used
     * for navigation.
     */
    public function scopeSubCategoryLinksByCategory($query, $routePrefix, $isPublished = true)
    {
        $query->select('id', 'route_prefix', 'title', 'slug', 'image')
            ->whereRaw('LENGTH(route_prefix) - LENGTH(REPLACE(route_prefix, "/", "")) + 1 = 2')
            ->where('route_prefix', 'like',  $routePrefix . '%')
            ->where('is_category', true);

        if ($isPublished) $query->whereNotNull('published_at');

        return $query;
    }


    //
    //
    // FOR REVIEW
    //
    //
    //

    // ??????WTF??????????????
    // it think this is for the page map!
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
