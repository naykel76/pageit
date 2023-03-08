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
