@extends('layout')

@section('title', "Editar usuario")

@section('content')
    <h1>Editar usuario</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <h6>Por favor corriga los siguientes errores:</h6>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <form method="POST" action="{{ url('usuarios') }}">
        {{ csrf_field() }}

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name', $user->name) }}">

        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email', $user->email) }}">

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="mayor a 6 caracteres">

        <button type="submit"> Actualizar usuario</button>
    </form>
    <a href="{{ route('users') }}">Regresar al listado de usuarios</a>
    </p>
@endsection