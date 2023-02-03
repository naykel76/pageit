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

    // public function getStatusColorAttribute()
    // {
    //     return [
    //         'success' => 'green',
    //         'failed' => 'red',
    //     ][$this->status] ?? 'cool-gray';
    // }

    // bg-{{ $transaction->status_color }}-100


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
