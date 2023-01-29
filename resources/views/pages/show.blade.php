<x-gotime-app-layout layout="{{ config('naykel.template') }}">

    <div class="container">

        <article class="py-5">

            @if($page->show_title)
                <h1 class="title">{{ $page->title }}</h1>
            @endif

            @isset($page->image_path)
                <img class="pull-right pl-1 pb-1" src="{{ asset('storage/' . $page->image_path) }}" alt="{{ $page->title }}">
            @endisset

            {!! $page->body !!}

        </article>

    </div>

</x-gotime-app-layout>
