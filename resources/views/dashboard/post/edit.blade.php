{{-- resources/views/dashboard/post/edit.blade.php --}}

@extends('dashboard.master')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Editar Post</h1>

    @include('dashboard.fragment._errors-form')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <form action="{{ route('post.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Indica que es una actualización --}}

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}">
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" id="slug" value="{{ $post->slug }}">
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Contenido</label>
                            <textarea name="content" class="form-control" id="content" rows="5">{{ $post->content }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoría</label>
                            <select name="category_id" class="form-select" id="category_id">
                                @foreach ($categories as $id => $title)
                                    <option value="{{ $id }}" {{ $post->category_id == $id ? 'selected' : '' }}>
                                        {{ $title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        
                        
                        

                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea name="description" class="form-control" id="description" rows="3">{{ $post->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="posted" class="form-label">Publicado</label>
                            <select name="posted" class="form-select" id="posted">
                                <option value="not" {{ $post->posted == 'not' ? 'selected' : '' }}>No</option>
                                <option value="yes" {{ $post->posted == 'yes' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4">Guardar cambios</button>
                            <a href="{{ route('post.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
