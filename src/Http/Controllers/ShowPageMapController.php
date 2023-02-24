<?php

namespace Naykel\Pageit\Http\Controllers;

use App\Http\Controllers\Controller;
use Naykel\Pageit\Models\Page;
use Illuminate\Http\Request;

class ShowPageMapController extends Controller
{
    public function __invoke(Request $request)
    {
        $pages = Page::pagesNotCategory()->get();

        $uncategorisedPages = Page::uncategorisedPages()->get();

        $categoryLandingPages = Page::categoryLandingPages()->get()
            ->sortBy('route_prefix');

        return view('pageit::pages-map', [
            'title' => 'Site Pages Map',
            'pages' => $pages,
            'uncategorisedPages' => $uncategorisedPages,
            'categoryLandingPages' => $categoryLandingPages,
        ]);
    }
}
