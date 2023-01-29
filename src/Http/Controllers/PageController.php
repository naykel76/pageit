<?php

namespace Naykel\Pageit\Http\Controllers;

use App\Http\Controllers\Controller;
use Naykel\Pageit\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        return view('pages.show')->with([
            'title' => $page->title,
            'page' => $page
        ]);
    }
}
