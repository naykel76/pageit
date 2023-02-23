<div>
    <x-gt-title-bar :$title :$routePrefix />

    <x-gt-search-sort-toolbar :$searchField :$searchOptions :$paginateOptions hideButton>
        <div class="flex fg1 va-c ha-r space-x-05">
            <span class="mr fw6">Filter By:</span>
            <button wire:click.prevent="$set('filterBy', 'published')" class="btn outline round primary">
                <span>Published</span></button>
            <button wire:click.prevent="$set('filterBy', 'draft')" class="btn outline round primary">
                <span>Draft</span></button>
            <button wire:click.prevent="$set('filterBy', '')" class="btn round">
                <span>Reset</span></button>
        </div>
    </x-gt-search-sort-toolbar>

    <table class="w-full">

        <thead>
            <x-gt-table.th sortable wire:click="sortField('title')" :direction="$sortField === 'title' ? $sortDirection : null" class="w-full">Title</x-gt-table.th>
            <th class="tac px">Published</th>
            <th></th>
        </thead>

        <tbody wire:loading.class="txt-muted">

            @forelse($items as $item)

                <tr>
                    <td class="w-full">{{ $item->title }} <div class="txt-muted txt-sm">{{ $item->route_prefix . '/' }}{{ $item->slug }}</div>
                    </td>
                    <td class="tac">
                        {{-- <div class="round "> --}}
                            <span class="badge {{ $item->isPublished() ? 'success' : 'danger' }}">{{ $item->isPublished() ? 'Yes' : 'No' }}</span>
                        {{-- </div> --}}
                    </td>
                    <td>
                        <div class="flex">
                            <a href="{{ route("$routePrefix.edit", $item->id) }}" class="ml-05 btn blue sm pxy-025">
                                <x-gt-icon-edit-o class="icon" /></a>
                            {{-- <a href="{{ route("pages.show", $item->slug) }}" target="_blank" class="ml-05 btn yellow sm pxy-025">
                            <x-gt-icon-eyes class="icon" /></a> --}}
                        </div>

                    </td>
                </tr>

            @empty

                <tr>
                    <td class="tac pxy txt-lg" colspan="6">No records found...</td>
                </tr>

            @endforelse

        </tbody>

    </table>

    {{ $items->links('gotime::pagination.livewire') }}

</div>
