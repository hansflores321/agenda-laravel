<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contactos - Panel de Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="text-center mb-4">Agenda de Contactos 📒</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            Usuario: <strong>{{ Auth::user()->name }}</strong>
        </div>
        <div>
            <a href="{{ route('direcciones.index') }}" class="btn btn-secondary btn-sm">Menú</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-dark btn-sm">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('direcciones.create') }}" class="btn btn-primary mb-3">+ Nuevo contacto</a>

    <div class="table-responsive shadow-sm bg-white p-3">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contactos as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->nombre }}</td>
                    <td>{{ $row->apellido }}</td>
                    <td>{{ $row->telefono ?? 'N/A' }}</td>
                    <td>{{ $row->correo }}</td>
                    <td>{{ $row->direccion }}</td>
                    <td>{{ $row->created_at->format('d/m/Y') }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            {{-- Botón Editar --}}
                            <a href="{{ route('direcciones.edit', $row->id) }}" class="btn btn-success btn-sm">Editar</a>
                            
                            {{-- Botón Eliminar con Formulario --}}
                            <form action="{{ route('direcciones.destroy', $row->id) }}" method="POST" onsubmit="return confirm('¿Seguro que lo quieres borrar?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-muted">No hay registros disponibles en la base de datos.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>