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
                        @method('PATCH') <!-- Asegúrate de usar PATCH para la actualización -->

                        <!-- Campo para el nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                        </div>

                        <!-- Campo para el email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                        </div>

                        <!-- Campo para la contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña (opcional)</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                        <!-- Campo para confirmar la contraseña -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4">Guardar cambios</button>
                            <a href="{{ route('profile.show') }}" class="btn btn-secondary px-4">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Formulario para eliminar el perfil -->
            <form action="{{ route('profile.destroy') }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE') <!-- Usamos DELETE para eliminar -->

                <div class="text-center">
                    <button type="submit" class="btn btn-danger px-4">Eliminar perfil</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
