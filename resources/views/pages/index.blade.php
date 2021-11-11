@extends('gotime::layouts.admin')

@section('content')

<h1>{{ $title }}</h1>

<div class="bx danger">This feature is currently under constuction. <a href="/admin" class="btn">Return to Admin</a></div>

{{-- <div class="bx pxy-05"><a href="{{ route('admin.pages.create') }}" class="btn success">Create New</a></div>

<table>

    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Published</th>
            <th class="tac">Actions</th>
        </tr>
    </thead>

    @forelse($pages as $page)
        <tr>
            <td>{{ $page->id }}</td>
            <td>{{ $page->title }}</td>
            <td>{{ $page->published_at }}</td>
            <td class="tac">
                <div class="flex ha-c">
                    <a href="{{ route('pages.show', $page) }}" target="_blank" class="btn info xs mr-025">Preview</a>
                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn success xs mr-025">Edit</a>
                    <form method="POST" action="{{ route('admin.pages.destroy', $page->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn danger xs" onclick="return confirm('Are you sure? This action can not be undone.')"> Delete </button>
                    </form>
                </div>
            </td>

        </tr>

    @empty

        <tr>
            <td colspan="4" class="tac">
                <p>No pages to display</p>
            </td>
        </tr>

    @endforelse


</table>

{{ $pages->links() }} --}}


@endsection