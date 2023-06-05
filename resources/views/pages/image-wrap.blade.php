<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="py-5-3-2-2">

    <div class="container">

        @if(empty($page->config['hide_title']))
            <h1 class="title mb-3">{{ $pageTitle }}</h1>
        @endif

        <article class="image-wrap">

            @if($page->image)
                <img src="{{ $page->mainImageUrl() }}" alt="{{ $pageTitle ?? null }}">
            @endif

            @if($page->lead_text)
                <p class="lead">{{ $page->lead_text }}</p>
            @endif

            {!! $page->body !!}

        </article>

        {{--
@if($page->isParentCategory())
            <x-pageit::sub-categories :$subCategories />
@endif

@if($page->isSubCategory())
            <x-pageit::category-pages :$categoryPages />
@endif--}}

    </div>

</x-gotime-app-layout>
