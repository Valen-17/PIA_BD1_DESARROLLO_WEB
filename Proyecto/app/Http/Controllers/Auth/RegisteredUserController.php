<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:usuarios'], 
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'], 
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $usuario = Usuario::create([
            'username' => $request->username, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'activo' => true,            
        ]);

        \App\Models\Evaluador::create([
            'usuario_id' => $usuario->id,
            'identificacion' => 'TEMP-' . $usuario->id,
            'nombres' => $request->username,
            'apellidos' => 'N/A',
            'email' => $usuario->email,
        ]);

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect(route('dashboard', absolute: false));
    }
}
