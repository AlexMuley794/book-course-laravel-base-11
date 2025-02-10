{{-- resources/views/dashboard/post/create.blade.php --}}

@extends('dashboard.master')

@section('content')
<div class="container">
    <h1 class="my-4">Crear nuevo post</h1>

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('post.store') }}" method="POST" class="bg-white border border-secondary p-4 rounded shadow">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="title">
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" id="slug">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" class="form-control" id="content" rows="5"></textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-select" id="category_id">
                @foreach ($categories as $id => $title)
                    <option value="{{ $id }}">{{ $title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="posted" class="form-label">Posted</label>
            <select name="posted" class="form-select" id="posted">
                <option value="not">Not</option>
                <option value="yes">Yes</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Send</button>
    </form>
</div>
@endsection
