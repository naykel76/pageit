<?php

namespace Naykel\Pageit\Controllers;

use App\Http\Controllers\Controller;
use Naykel\Pageit\Models\Page;
use Naykel\Pageit\Requests\ValidatePage;

class PageController extends Controller
{

    protected $storageDir = 'content';

    /**
     * Display a table listing the resource.
     */
    public function index()
    {

        // \Naykel\Pageit\Models\Page::factory(100)->create();
        return view('pageit::pages.index')->with([
            'title' => 'Site Pages List',
            'pages' => Page::paginate(24),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pageit::pages.create-edit')->with([
            'title' => 'Create Page',
            'formType' => 'store',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidatePage $request)
    {
         /**
         * file upload is managed in the validateMergeData function
         * need to add options for different types of upload
         * e.g. override, custom name
         */
        $validatedData = validateMergeData($request, $this->storageDir);
        $page = Page::create($validatedData);
        return redirectById('pages', $page->id); // redirect based on form action
    }


    /**
     * Display the specified resource.
     * 
     * @param $page can be string or integer
     */
    public function show($page)
    {
        // if integer query by id else query by slug
        $page = Page::when(
            is_numeric($page),
            fn ($query) => $query->where('id', $page),
            fn ($query) => $query->where('slug', $page)
        )->firstOrFail();

        return view('pageit::pages.show')->with([
            'title' => $page->name,
            'page' => $page
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('pageit::pages.create-edit')->with([
            'title' => 'Edit Page',
            'page' => $page,
            'formType' => 'update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidatePage $request, Page $page)
    {
        /**
         * file upload is managed in the validateMergeData function
         * need to add options for different types of upload
         * e.g. override, custom name
         */
        $validatedData = validateMergeData($request, $this->storageDir);
        $page->update($validatedData);
        return redirectById('pages', $page->id); // redirect based on form action
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return back();
    }
}
