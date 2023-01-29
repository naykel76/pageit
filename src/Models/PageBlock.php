<?php

namespace Naykel\Pageit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageBlock extends Model

{
    use HasFactory;

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
