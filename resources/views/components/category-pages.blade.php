@if($categoryPages->isNotEmpty())

    <section id="categoryPages" class="tac my-3">

        <div class="container">

            <div class="grid cols-4-2-1">

                @foreach($categoryPages as $page)

                    <div class="mt">

                        <a class="txt-lg" href="/{{ $page->route_prefix ? $page->route_prefix . '/' : '' }}{{ $page->slug }}">

                        {{-- <a class="txt-lg" href="/{{ $page->route_prefix }}"> --}}
                            <img class="rounded-05" src="{{ $page->mainImageUrl() }}" alt="{{ $page->title ?? null }}">
                            {{ $page->title }}
                        </a>
                    </div>

                @endforeach

            </div>

        </div>

    </section>

@endif
