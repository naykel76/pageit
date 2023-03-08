<?php

namespace Naykel\Pageit\Http\Controllers;

use App\Http\Controllers\Controller;
use Naykel\Pageit\Models\Page;

class PageController extends Controller
{

    public function show(Page $page)
    {
        $routePrefix = $page->route_prefix;

        $subCategories = Page::select('id', 'route_prefix', 'title', 'slug', 'image')
            ->whereRaw('LENGTH(route_prefix) - LENGTH(REPLACE(route_prefix, "/", "")) + 1 = 2')
            ->where('route_prefix', 'like',  $routePrefix . '%')
            ->where('is_category', true)
            ->get();

        $categoryPages = Page::select('id', 'route_prefix', 'title', 'slug', 'image')
            ->where('route_prefix', 'like',  $routePrefix . '%')
            ->where('is_category', false)
            ->get();

        $view = $this->getView(($page->layout ?? 'default'));

        return view($view)->with([
            'title' => $page->title,
            'page' => $page,
            'subCategories' =>  $subCategories,
            'categoryPages' =>  $categoryPages
        ]);
    }

    /**
     * Return local view if one exists
     */
    public function getView($view): string
    {
        if (view()->exists('layouts.pages.' . $view)) {
            return 'layouts.pages.' . $view;
        } else {
            return 'pageit::pages.' . $view;
        }
    }

}
