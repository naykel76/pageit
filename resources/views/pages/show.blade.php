@extends('gotime::layouts.' . config('naykel.template'))

@section('content')

    <div class="container">
        <h1>{{ $page->title }}</h1>
    </div>

    {!! $page->body !!}

@endsection




