<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="py-5-3-2-2">

    <div class="container maxw-md my-3">

        <article>

            @if(empty($page->config['hide_title']))
                <h1 class="title tac">{{ $page->title }}</h1>
            @endif

            @if($page->lead_text)
                <p class="lead tac">{{ $page->lead_text }}</p>
            @endif

            @if($page->image)
                <div class="my-2"><img src="{{ $page->mainImageUrl() }}" alt="{{ $page->title ?? null }}" class="mx-auto rounded-05"></div>
            @endif

            {!! $page->body !!}

        </article>

        @if($page->isParentCategory())
            <x-pageit::sub-categories :$subCategories />
        @endif

        @if($page->isSubCategory())
            <x-pageit::category-pages :$categoryPages />
        @endif

    </div>

</x-gotime-app-layout>
