<div>

    <x-gt-actions-toolbar :$routePrefix :$editing />


    <x-gt-form>

        <div class="bx">

            <x-gt-input wire:model.defer="editing.title" for="editing.title" label="Title" req inline />
            <x-gt-ckeditor wire:model.lazy="editing.body" for="editing.body" label="Main Body" inline :x="$editing"/>

            <x-slot name="actions">
                <x-gt-actions-toolbar :$routePrefix :$editing />
            </x-slot>

        </div>

    </x-gt-form>


    <x-gt-modal.delete wire:model="actionItemId" id="{{ $actionItemId }}" withRedirect />

</div>
