<?php

namespace Naykel\Pageit\Http\Controllers;

use App\Http\Controllers\Controller;
use Naykel\Pageit\Models\Page;

class PageController extends Controller
{

    public function show(Page $page)
    {
        $routePrefix = $page->route_prefix;
        $subCategoryLinksByCategory = Page::subCategoryLinksByCategory($routePrefix)->get();
        $pagesByRoutePrefix = Page::pagesByRoutePrefix($routePrefix)->get();

        $view = $this->getView(($page->layout ?? 'default'));

        return view($view)->with([
            'pageTitle' => $page->title,
            'page' => $page,
            'subCategories' =>  $subCategoryLinksByCategory,
            'relatedPages' =>  $pagesByRoutePrefix
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
