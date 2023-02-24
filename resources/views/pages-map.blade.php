<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$title>

    <div class="container py-5-3-2">

        <div class="grid-3 cols-2">

            <div>

                @foreach($categoryLandingPages as $category)

                    @php
                        $parentCategory = numSegments($category->route_prefix) === 1
                    @endphp

                    <h4 class="{{ $parentCategory ? '' : 'ml' }}">
                        {{ $parentCategory ? 'Main-Category:' : 'Sub-Category:' }}
                        <span class="fw4"><a href="{{ url($category->route_prefix) }}">{{ $category->title }}</a></span>
                    </h4>

                    <ul class="mt-05 {{ $parentCategory ? '' : 'ml-2' }}">
                        @foreach($pages as $page)
                            @if($page->route_prefix === $category->route_prefix)
                                <li> {{ $page->title }}</li>
                            @endif
                        @endforeach
                    </ul>

                @endforeach

            </div>

            <ul>
                <h4>Uncategorised Pages</h4>
                @foreach($uncategorisedPages as $page)
                    <li class="ml">{{ $page->title }}</li>
                @endforeach
            </ul>

        </div>

    </div>

</x-gotime-app-layout>
