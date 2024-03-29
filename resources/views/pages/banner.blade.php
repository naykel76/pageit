<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="py-5-3-2-2">

    <div class="banner flex va-c blue" style="background-image: url({{ $page->mainImageUrl() }});">

        <div class="container maxw-md space-y-1.5">

            @if(empty($page->config['hide_title']))
                <div class="flex">
                    <h1 class="banner-title bg-blue-09">{{ $page->title }}</h1>
                </div>
            @endif

            @isset($page->lead_text)
                <p class="lead">{{ $page->lead_text }}</p>
            @endisset

            @isset($page->headline)
                <div class="banner-text inline-flex">
                    <div class="icon-list tick-svg maxw-md">
                        {!! $page->headline !!}
                    </div>
                </div>
            @endisset

        </div>

    </div>

    @if($page->body)
        <div class="container maxw-md my-3">
            <article>
                {!! $page->body !!}
            </article>
        </div>
    @endif

    @if($page->isParentCategory())
        <x-pageit::sub-categories :$subCategories />
    @endif

    @if($page->isSubCategory())
        <x-pageit::related-pages :$relatedPages />
    @endif

</x-gotime-app-layout>
