<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$title>

    <div class="container maxw-md my-3">

        <article class="fancy">

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

    </div>

    @if($subCategories->isNotEmpty())

        <section id="subCategories" class="tac my-3">

            <div class="container">

                <div class="grid cols-4-2-1">

                    @foreach($subCategories as $category)

                        <div class="mt">
                            <a class="txt-lg" href="/{{ $category->route_prefix ? $category->route_prefix . '/' : '' }}{{ $category->slug }}">
                                <img class="rounded-05" src="{{ $category->mainImageUrl() }}" alt="{{ $category->title ?? null }}">
                                {{ $category->title }}
                            </a>
                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif

</x-gotime-app-layout>
