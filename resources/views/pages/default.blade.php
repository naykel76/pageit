<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$pageTitle>

    <div class="container maxw-md my-3">

        <article>

            @if(empty($page->config['hide_title']))
                <h1 class="title tac">{{ $page->title }}</h1>
            @endif

            @if($page->intro)
                <p class="lead tac">{{ $page->intro }}</p>
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
