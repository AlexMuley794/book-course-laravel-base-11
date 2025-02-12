@extends('dashboard.master')

@section('content')
<div class="container">
    <h1 class="my-4">Posts</h1>
    
    <!-- Contenedor para el mensaje de alerta -->
    <div id="alert-container" class="mb-3" style="height: 50px; overflow: hidden;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <a href="{{ route('post.create') }}" class="btn btn-success mb-4">
        Crear nuevo post
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Publicado</th>
                    <th>Categoría</th>
                    <th>Imagen</th> <!-- Nueva columna para la imagen -->
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr id="post-{{ $post->id }}">
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if($post->posted == 'yes')
                                <span class="badge bg-success">Sí</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>
                            {{ optional($post->category)->title ?? 'Sin categoría' }}
                        </td>
                        <td>
                            <!-- Mostrar la imagen si existe -->
                            @if($post->image)
                                <img src="{{ asset('images/'.$post->image) }}" alt="Imagen del post" width="100">
                            @else
                                <span>No disponible</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-secondary btn-sm">Mostrar</a>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay posts disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successAlert = document.getElementById('success-alert');
        
        if (successAlert) {
            successAlert.style.transition = 'opacity 1s ease-out';
            setTimeout(function () {
                successAlert.style.opacity = '0';
            }, 2000);
            setTimeout(function () {
                successAlert.style.display = 'none';
            }, 3000);
        }
    });
</script>

@endsection
