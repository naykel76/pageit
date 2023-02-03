<div>

    <h1>{{ $title }}</h1>

    <x-gt-actions-toolbar :$routePrefix :$editing />

    <x-gotime-errors />
    <x-gt-admin-form>

        <x-slot name="main">

            <x-gt-input wire:model.defer="editing.title" for="editing.title" label="Title" req inline />
            <x-gt-input wire:model.defer="editing.route_prefix" for="editing.route_prefix" label="Route Prefix" req inline />
            <x-gt-input wire:model.defer="editing.slug" for="editing.slug" label="Slug" inline />
            <x-gt-input wire:model.defer="editing.type" for="editing.type" label="type" inline />
            <hr>

            <x-gt-ckeditor-full wire:model="editing.body" for="editing.body" editor-id="{{ '_' . rand() }}" />

        </x-slot>

        <x-slot name="aside">

            <div>

                <div class="mb">

                    @if($tmpUpload)

                        <img src="{{ $tmpUpload->temporaryUrl() }}" alt="{{ $editing->title ?? null }}" class="mxy-auto">

                        @if((isset($editing->image) ))
                            <div class="tac"><small class="txt-red lh-1">Previous image will be deleted automatically when saved.</small></div>
                        @endif

                    @else

                        <img src="{{ $editing->mainImageUrl() }}" alt="{{ $editing->title ?? null }}" class="mxy-auto">

                    @endif

                </div>

                <x-gt-filepond wire:model="tmpUpload" for="tmpUpload" />

                <hr>

                <label class="toggle">
                    <input type="checkbox" wire:model.defer="isPublished">
                    <div></div>
                    <span class="ml">Published</span>
                </label>
                <br>
                <label class="toggle">
                    <input type="checkbox" wire:model.defer="editing.hide_title">
                    <div></div>
                    <span class="ml">Hide Title</span>
                </label>
                <br>
                <label class="toggle">
                    <input type="checkbox" wire:model.defer="editing.is_category">
                    <div></div>
                    <span class="ml">Is Category</span>
                </label>
                {{-- <x-gt-checkbox wire:model.defer="isPublished" for="isPublished" label="Published" /> --}}
            </div>

        </x-slot>

    </x-gt-admin-form>

    <x-gt-modal.confirmation wire:model="actionItemId">

        <x-slot name="title">
            Delete Item
        </x-slot>

        <p> Are you sure you want to delete this item? </p>

        <x-slot name="footer">
            <button wire:click.prevent="$set('actionItemId', false)"
                wire:loading.attr="disabled" class="btn">Nevermind </button>
            <button wire:click.prevent="delete({{ $actionItemId }})" withRedirect
                class="btn danger">Delete</button>
        </x-slot>

    </x-gt-modal.confirmation>

</div>
