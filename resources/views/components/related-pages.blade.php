@if($relatedPages->isNotEmpty())
    <section id="relatedPages" class="tac my-3">
        <div class="container">
            <div class="grid cols-4-2-1">
                @foreach($relatedPages as $page)
                    <div class="mt">
                        <a class="txt-lg" href="/{{ $page->route_prefix ? $page->route_prefix . '/' : '' }}{{ $page->slug }}">
                            <img class="rounded-05" src="{{ $page->mainImageUrl() }}" alt="{{ $page->title ?? null }}">
                            {{ $page->title }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
