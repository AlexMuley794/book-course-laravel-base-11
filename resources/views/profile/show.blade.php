{{-- resources/views/profile/show.blade.php --}}

@extends('dashboard.master')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Mi Perfil</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        
                        <div class="text-center">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary px-4">Editar Perfil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
