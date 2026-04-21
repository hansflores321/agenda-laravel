<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionController extends Controller
{

    public function index()
    {
        $contactos = Direccion::all();
        return view('agenda', compact('contactos'));
    }


    public function create()
    {
        return view('nuevo_contacto');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:50',
            'apellido'  => 'required|string|max:50',
            'telefono'  => 'nullable|string|max:20',
            'correo'    => 'required|email|max:100',
            'direccion' => 'required|string|max:255',
        ]);

        Direccion::create($request->all());
        return redirect()->route('direcciones.index')->with('success', '¡Contacto creado con éxito!');
    }

  
    public function edit($id)
    {
        $contacto = Direccion::findOrFail($id);
        return view('direcciones.edit', compact('contacto'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'    => 'required|string|max:50',
            'apellido'  => 'required|string|max:50',
            'telefono'  => 'nullable|string|max:20',
            'correo'    => 'required|email|max:100',
            'direccion' => 'required|string|max:255',
        ]);

        $contacto = Direccion::findOrFail($id);
        $contacto->update($request->all());

        return redirect()->route('direcciones.index')->with('success', '¡Contacto actualizado correctamente!');
    }

    public function destroy($id)
    {
        $contacto = Direccion::findOrFail($id);
        $contacto->delete();

        return redirect()->route('direcciones.index')->with('success', 'Contacto eliminado.');
    }
}