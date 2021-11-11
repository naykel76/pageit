<?php

namespace Naykel\Pageit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasFactory;
    use HasSlug;

    /**
     * guard against uploaded_file included in validation being persisted
     * to the database, converts to correct field name in validateMerge 
     * data method
     */

    protected $guarded = ['uploaded_file'];

    /**
     * Create a new factory instance for the model allowing factory
     * to be run from package.
     */
    protected static function newFactory()
    {
        return \Naykel\Pageit\Database\Factories\PageFactory::new();
    }


    /**
     * Get the options for generating the slug.
     * https://github.com/spatie/laravel-sluggable
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
            // ->doNotGenerateSlugsOnUpdate();
    }
}
