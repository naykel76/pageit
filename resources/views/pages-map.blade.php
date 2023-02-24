<x-gotime-app-layout layout="{{ config('naykel.template') }}" :$title>

    <div class="container py-5-3-2">

        @foreach($pages as $routePrefix => $pagesGrouped)

            <div class="bdr">
                {{-- Get the category landing page --}}
                @php
                    $categoryPage = $pagesGrouped->where('is_category', true)->first();
                @endphp

                {{-- Output the category or subcategory for the current group --}}
                <h6>{{ ($categoryPage->title ?? 'Uncategorized Pages') }}</h6>

                <ul>
                    {{-- Loop through the pages in the current group and output their titles --}}
                    @foreach($pagesGrouped as $page)
                        <li class="ml">{{ $page->title }}</li>
                    @endforeach
                </ul>

            </div>

        @endforeach

    </div>

</x-gotime-app-layout>
