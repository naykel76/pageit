<x-gt-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="py-5-3-2-2">
    <div class="container maxw-md">
        <article>
            @if (empty($page->config['hide_title']))
                <h1 class="title">{{ $page->title }}</h1>
            @endif
            <x-pageit::page-intro :intro="$page->intro" />
            @if ($page->image)
                <div class="my-2"><img src="{{ $page->mainImageUrl() }}" alt="{{ $page->title ?? null }}" class="mx-auto rounded-05"></div>
            @endif
            {!! $page->body !!}
        </article>
    </div>
</x-gt-app-layout>
