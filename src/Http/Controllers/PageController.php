<?php

namespace Naykel\Pageit\Http\Controllers;

use App\Http\Controllers\Controller;
use Naykel\Pageit\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    // This function needs to be more flexible, as not all pages will have categories!
    public function show(Request $request, Page $page)
    {
        $routePrefix = ltrim($request->route()->getPrefix(), '/');

        $subCategories = $this->getCategoryPages($routePrefix . '/' . $page->slug)->get();

        $layout = $page->layout ?? 'default';

        return view('pageit::pages.' . $layout)->with([
            'title' => $page->title,
            'page' => $page,
            'subCategories' => $subCategories
        ]);
    }

    public function categoriesPage(Request $request)
    {
        $routePrefix = ltrim($request->route()->getPrefix(), '/');

        // fetch all pages that start with the route prefix
        $pages = Page::where('route_prefix', 'like',  $routePrefix . '%')->get();

        $categories = Page::where('route_prefix', 'like',  $routePrefix . '%')
            ->select('route_prefix', 'slug', 'image', 'title')
            ->whereIsCategory(true)->get();

        return view('pages.category-page')->with([
            'parentCategory' => $routePrefix,
            'categories' => $categories,
            'pages' => $pages,
            'title' => ucwords(str_replace('-', ' ', $routePrefix)),
        ]);
    }

    protected function getCategoryPages(string $routePrefix)
    {
        return Page::where('route_prefix', 'like',  $routePrefix . '%');
    }
}
