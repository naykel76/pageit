<div>

    @push('styles')

        <style>
            .trix-button-group.trix-button-group--file-tools,
            .trix-button--icon-code,
            .trix-button--icon-number-list,
            .trix-button--icon-heading-1,
            .trix-button--icon-link,
            .trix-button--icon-quote,
            .trix-button--icon-strike,
            .trix-button--icon-increase-nesting-level,
            .trix-button--icon-decrease-nesting-level {
                display: none !important;
            }
        </style>

    @endpush

    <h1>{{ $title }}</h1>

    <x-gt-actions-toolbar :$routePrefix :$editing />

    <x-gotime-errors />

    <x-gt-admin-form>

        <x-slot name="main">

            <x-gt-input wire:model.defer="editing.title" for="editing.title" label="Title" req />

            <div class="grid cols-2">
                <x-gt-input wire:model.defer="editing.route_prefix" for="editing.route_prefix" label="Route Prefix"
                    placeholder="Advanced use for routing" disabled />
                <x-gt-input wire:model.defer="editing.slug" for="editing.slug" label="Slug" />
            </div>

            <p class="mt-05"><small>The route prefix and slug are used for site navigation and should not be changed unless instructed.</small></p>

            <hr>

            <div x-data="{show: false}" class="tar">
                <button class="" x-on:click.prevent="show = !show">
                    <x-gt-icon-info class="txt-blue" /></button>
                <div class="bx info-light pxy-05 tal mb" x-show="show">
                    <button class="pull-right btn pxy-025 ml-05" x-on:click.prevent="show=true">
                        <x-gt-icon-cross class="icon sm" /></button>
                    <small>The headline section is typically positioned directly beneath the page title and is reserved for displaying an introductory list or lead paragraph. Depending on the chosen page layout and template configuration, the style of this section may vary.</small>
                </div>
            </div>

            <x-gt-trix wire:model.lazy="editing.headline" for="editing.headline" label="Headline" />

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

                <x-gt-select wire:model.defer="editing.layout" for="editing.layout" label="Layout" placeholder="Please Select..."
                    help-text="Select the desired layout style for this page.">
                    @foreach(self::$model::LAYOUTS as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </x-gt-select>

                <hr>

                <label class="toggle">
                    <input type="checkbox" wire:model.defer="isPublished">
                    <div></div>
                    <span class="ml">Published</span>
                </label>

                <br>

                <hr>
                <div class="bx danger-light pxy-05">

                    <p><small>These toggle switches are required for develpoment purpose and should not be changed.</small></p>

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

                    <x-gt-input wire:model.defer="editing.type" for="editing.type" placeholder="Page type advanced or normal" disabled row-class="mt" />

                </div>

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
