@extends('dashboard.master')

@section('content')
<div class="container">
    <h1 class="my-4">{{ $post->title }}</h1>
    
    <!-- Mostrar imagen, si existe -->
    @if ($post->image)
        <div class="mb-3">
            <img src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
        </div>
    @endif

    <p><strong>Categoría:</strong> {{ $post->category->title ?? 'Sin categoría' }}</p>
    
    <p><strong>Contenido:</strong></p>
    <div>{!! nl2br(e($post->content)) !!}</div>
    
    <p><strong>Descripción:</strong></p>
    <div>{!! nl2br(e($post->description)) !!}</div>

    <p><strong>Publicado:</strong> 
        @if($post->posted == 'yes')
            <span class="badge bg-success">Sí</span>
        @else
            <span class="badge bg-danger">No</span>
        @endif
    </p>

    <a href="{{ route('post.index') }}" class="btn btn-primary">Volver a la lista</a>
</div>
@endsection
