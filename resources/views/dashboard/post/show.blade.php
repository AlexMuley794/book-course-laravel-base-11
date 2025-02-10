@extends('dashboard.master')

@section('content')
<div class="container">
    <h1 class="my-4">{{ $post->title }}</h1>
    
    <p>{{ $post->content }}</p>

    <p><strong>Categoría:</strong> {{ optional($post->category)->title ?? 'Sin categoría' }}</p>

    <a href="{{ route('post.index') }}" class="btn btn-primary">Volver a la lista</a>
</div>
@endsection
