@extends('dashboard.master')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Editar Perfil</h1>

    @include('dashboard.fragment._errors-form')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT') 

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                        </div>

                        <!-- Cambiar Contraseña del Usuario -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Nueva contraseña">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirmar nueva contraseña">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4">Guardar cambios</button>
                            <a href="{{ route('profile.show') }}" class="btn btn-secondary px-4">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
