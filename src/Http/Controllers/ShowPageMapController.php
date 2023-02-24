<?php

namespace Naykel\Pageit\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowPageMapController extends Controller
{
    public function __invoke(Request $request)
    {
        $pages = \Naykel\Pageit\Models\Page::get()
            ->sortBy('route_prefix')
            ->groupBy('route_prefix');

        return view('pageit::pages-map', [
            'title' => 'Site Pages Map',
            'pages' => $pages
        ]);
    }
}
