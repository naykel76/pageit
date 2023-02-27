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

    <x-gt-actions-toolbar :$routePrefix :$editing :$actionItemId />

    <x-gotime-errors />

    <x-gt-admin-form>

        <x-slot name="main">

            <div class="flex gg-2">

                <div class="fg1">

                    <x-gt-input wire:model.defer="editing.title" for="editing.title" label="Title" req inline />

                    <hr>

                    <x-gt-select wire:model.defer="editing.layout" for="editing.layout" label="Layout" placeholder="Please Select..." req inline>
                        @foreach(self::$model::LAYOUTS as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-gt-select>

                    <hr>

                    <x-gt-trix wire:model.lazy="editing.headline" for="editing.headline" label="Headline">
                        <x-slot name="tooltip">
                            <span x-data="{open:false}" x-on:mouseenter="open=true" x-on:mouseleave="open=false" class="relative">
                                <x-gt-icon-help />
                                <div class="absolute pos-r mt-05 flex w-24 z-100 bx info-light pxy-05 " x-show="open" x-transition.duration style="display: none;">
                                    <small>The headline section usually appears right after the page title and is used to showcase a brief paragraph or bullet list. The appearance of this section can differ based on the page layout and template settings selected.</small>
                                </div>
                            </span>
                        </x-slot>
                    </x-gt-trix>

                </div>

                <div class="w-20 fs0">

                    <div class="bx pxy-1">

                        @if($tmpUpload)

                            <img src="{{ $tmpUpload->temporaryUrl() }}" alt="{{ $editing->title ?? null }}" class="mxy-auto mb">

                            @if((isset($editing->image) ))
                                <div class="tac"><small class="txt-red lh-1">Previous image will be deleted automatically when saved.</small></div>
                            @endif

                        @else

                            <img src="{{ $editing->mainImageUrl() }}" alt="{{ $editing->title ?? null }}" class="mxy-auto mb">

                        @endif

                        <x-gt-filepond wire:model="tmpUpload" for="tmpUpload" />

                    </div>

                </div>

            </div>

            <hr>

            {{-- warning to indicate the page has advanced coding --}}
            @if(!empty($editing->config['advanced_code']))

                <div class="bx danger">
                    <div class="flex">
                        <x-gt-icon-warning class="icon wh-5 mr-2" />
                        <div>
                            <div class="bx-title">IMPORTANT</div>
                            <p class="mt-05">This section of content has custom coding for its layout, modifying it without proper understanding may cause unintended or unexpected consequences.</p>
                        </div>
                    </div>
                </div>

            @endif

            <x-gt-ckeditor-full wire:model="editing.body" for="editing.body" editor-id="{{ '_' . rand() }}" />

        </x-slot>

        <x-slot name="aside">

            <hr class="mt-0">

            <label class="toggle">
                <input type="checkbox" wire:model.defer="isPublished">
                <div></div>
                <span class="ml">Published</span>
            </label>

            <hr>

            <div>

                <p class="txt-xs">The route prefix and slug are used for site navigation and should not be changed unless you know what you are doing.</p>

                <x-gt-input wire:model.defer="editing.route_prefix" for="editing.route_prefix" label="Route Prefix"
                    placeholder="Advanced use, required for routing" />

                <x-gt-input wire:model.defer="editing.slug" for="editing.slug" label="Slug" />

                <hr>

                <div class="bx danger-light pxy-05 flex-col gg-1 space-y-0">

                    <p class="txt-sm">These toggle switches are required for develpoment purpose and should not be changed.</p>

                    <label class="toggle">
                        <input type="checkbox" wire:model.defer="editing.config.hide_title">
                        <div></div>
                        <span class="ml">Hide Title</span>
                    </label>


                    <label class="toggle">
                        <input type="checkbox" wire:model.defer="editing.is_category">
                        <div></div>
                        <span class="ml">Is Category</span>
                    </label>

                    <label class="toggle">
                        <input type="checkbox" wire:model.defer="editing.config.advanced_code">
                        <div></div>
                        <span class="ml">Advanced Code</span>
                    </label>

                    {{-- <x-gt-input wire:model.defer="editing.type" for="editing.type" placeholder="Page type advanced or normal" disabled row-class="mt" /> --}}

                </div>

            </div>

        </x-slot>

    </x-gt-admin-form>


    <x-gt-modal.delete wire:model="actionItemId" id="{{ $actionItemId }}" withRedirect />

</div>
