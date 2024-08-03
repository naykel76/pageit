{{-- this layout name is not correct --}}
<x-gt-app-layout layout="{{ config('naykel.template') }}" :$pageTitle class="py-5-3-2-2">
    <div class="container">
        @if (empty($page->config['hide_title']))
            <h1 class="title">{{ $page->title }}</h1>
        @endif
        <article class="flex-col gap lg:gap-5 lg:flex-row">
            <div class="fg1 order-1">
                <x-pageit::page-intro :intro="$page->intro" />
                {!! $page->body !!}
            </div>
            <aside class="fs0 lg:w-20 lg:order-1">
                <img src="{{ $page->mainImageUrl() }}" alt="{{ $page->title ?? null }}">
            </aside>
        </article>
    </div>
</x-gt-app-layout>