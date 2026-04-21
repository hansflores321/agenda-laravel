<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

 public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        

        return redirect()->intended('direcciones')
            ->with('success', '¡Ya estás dentro!'); 
    }

    return back()->withErrors([
        'username' => 'El usuario o la clave no coinciden.',
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    // Muestra el formulario de registro
public function showRegister()
{
    return view('register');
}

// Guarda el usuario en la base de datos
public function register(Request $request)
{
    // Validaciones nivel profesional
    $request->validate([
        'name'      => 'required|string|max:50',
        'apellido'  => 'required|string|max:50',
        'username'  => 'required|string|max:20|unique:users,username', // Único en la tabla users
        'email' => 'nullable|email|unique:users,email',
        'rol'       => 'required|in:ADMIN,DOCENTE,ESTUDIANTE', // Solo estos valores valen
        'password'  => 'required|string|min:6|confirmed', // Debe coincidir con password_confirmation
    ], [
        // Mensajes personalizados para que la profe vea el detalle
        'username.unique' => 'Ese nombre de usuario ya está pedido.',
        'rol.in'          => 'Ese rol no existe.',
        'password.confirmed' => 'Las contraseñas no son iguales.',
    ]);

    // Si pasa la validación, creamos al usuario
    \App\Models\User::create([
        'name'     => $request->name,
        'apellido' => $request->apellido,
        'username' => $request->username,
        'email'    => $request->email,
        'rol'      => $request->rol,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ]);

    return redirect()->route('login')->with('success', '¡Cuenta creada! Ya puedes entrar.');
}
}