@extends('dashboard.master')

@section('content')
<div class="container">
    <h1 class="my-4">Crear nuevo post</h1>

    @include('dashboard.fragment._errors-form')

    <form action="{{ route('post.store') }}" method="POST" class="bg-white border border-secondary p-4 rounded shadow" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenido</label>
            <textarea name="content" class="form-control" id="content" rows="5" required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select name="category_id" class="form-select" id="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control" id="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="posted" class="form-label">Publicado</label>
            <select name="posted" class="form-select" id="posted" required>
                <option value="not" {{ old('posted') == 'not' ? 'selected' : '' }}>No</option>
                <option value="yes" {{ old('posted') == 'yes' ? 'selected' : '' }}>Sí</option>
            </select>
        </div>

        <!-- Campo para cargar imagen -->
        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control" id="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
</div>
@endsection
