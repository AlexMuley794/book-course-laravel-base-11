<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed', // Contraseña opcional pero debe ser confirmada si se ingresa
        ]);

        // Obtener el usuario autenticado
        $user = $request->user();

        // Actualizar nombre y email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Guardar los cambios
        $user->save();

        // Redirigir con un mensaje de éxito
        return Redirect::route('profile.edit')->with('status', 'perfil actualizado');
    }

    /**
     * Show the user's profile.
     */
    public function show(): View
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        return view('profile.show'); // Asegúrate de que 'profile' sea la vista correcta
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Obtener el usuario autenticado
        $user = $request->user();
    
        // Eliminar el perfil del usuario
        $user->delete();
    
        // Cerrar la sesión del usuario
        Auth::logout();
    
        // Redirigir al login o a la página principal
        return redirect('/login')->with('status', 'profile-deleted');
    }
}
