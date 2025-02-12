<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-gray-800 p-4">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="flex-shrink-0 text-white">
                <!-- Logo o texto principal de la barra -->
                <span>Mi Barra de Navegación</span>
            </div>
            <div class="hidden sm:block sm:ml-6">
                <div class="flex space-x-4">
                    {{ $slot }} <!-- Aquí puedes agregar enlaces dinámicos pasados al slot -->

                    <!-- Solo mostrar el botón de Cerrar sesión si el usuario está autenticado -->
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="ml-4">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Cerrar sesión</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
