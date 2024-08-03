<?php

namespace Naykel\Pageit\Http\Controllers;

use App\Http\Controllers\Controller;
use Naykel\Pageit\Models\Page;

class PageController extends Controller
{

    public function show(Page $page)
    {
        $routePrefix = $page->route_prefix;
        // $subCategoryLinksByCategory = Page::subCategoryLinksByCategory($routePrefix)->get();
        // $pagesByRoutePrefix = Page::pagesByRoutePrefix($routePrefix)->get();

        // use the default 'show' view if no layout is set
        $view = $this->getView(($page->layout ?? 'default'));

        return view($view)->with([
            'pageTitle' => $page->title,
            'page' => $page,
            // 'subCategories' =>  $subCategoryLinksByCategory,
            // 'relatedPages' =>  $pagesByRoutePrefix
        ]);
    }

    /**
     * Return local view if one exists
     * 
     * ** The local templates should be stored in the components/layouts/pages directory
     */
    public function getView($view): string
    {
        if (view()->exists('components.layouts.pages.' . $view)) {
            return 'components.layouts.pages.' . $view;
        } else {
            return 'pageit::pages.' . $view;
        }
    }
}
