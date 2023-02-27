<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$title>

    <div class="banner flex va-c blue" style="background-image: url({{ $page->mainImageUrl() }});">

        <div class="container maxw-lg space-y-1.5">

            @if(empty($page->config['hide_title']))
                <div class="flex">
                    <h1 class="banner-title bg-blue-09">{{ $page->title }}</h1>
                </div>
            @endif

            <div class="banner-text inline-flex">

                <div class="icon-list tick-svg maxw-md">
                    {!! $page->headline !!}
                </div>

            </div>

            <div>
                <a href="/contact" class="btn warning txt-lg">Book your apoinment today</a>
            </div>

        </div>

    </div>

    @if($page->body)
        <div class="container maxw-md my-3">
            <article>
                {!! $page->body !!}
            </article>
        </div>
    @endif

</x-gotime-app-layout>
