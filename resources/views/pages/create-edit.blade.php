@extends('gotime::layouts.admin')

@section('content')

<h1>{{ $title . ($page->name ?? null) }}</h1>

<x-gotime-actions-toolbar formName="page-form" routeName="pages" :preview=true />

{{-- form start --}}

@if($formType === 'store')

    <form id="page-form" method="POST" action="{{ route('pages.store') }}" enctype="multipart/form-data">
        @csrf

    @else

        <form id="page-form" method="POST" action="{{ route('pages.update', $page) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

@endif


<div class="row">

    <div class="col-md-70">

        <div class="frm-row flex">
            <div class="col-md-10">
                <x-formit::input for="id" label="ID" value="{{ $page->id ?? null }}" adv=true disabled />
            </div>
            <div class="col-md-90">
                <x-formit::input for="title" label="Title" value="{{ $page->title ?? null }}" adv=true />
            </div>
        </div>

        @if(isset($page))
            <x-formit-ckeditor for="body" value="{!! $page->body ?? null !!}" />
        @else
            <x-formit-ckeditor for="body" />
        @endif

    </div>

    <div class="col-md-30 bdr-l">
        <x-gotime-image-picker image-path="{{ $page->image_path ?? null }}" />

        <hr>

        <x-formit-checkbox for="isChecked" label="Published" isChecked="{{ isset($page->published_at) ? ($page->published_at ? true : false) : null }}" />
        <x-formit::input for="slug" label="URL Alias" value="{{ $page->slug ?? null }}" disabled helpText="The alias is used in the URL and will update on save" />
        <hr>

    </div>

</div>

</form>



@endsection