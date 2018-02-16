@extends('layout')

@section('title', "Crear usuario")

@section('content')
    <h1>Crear usuario</h1>

    <form method="POST" action="{{ url('usuarios') }}">
       {{ csrf_field() }}

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="Pedro Perez">

        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" placeholder="pedro@example.com">

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="mayor a 6 caracteres">

        <button type="submit"> Crear usuario</button>
    </form>
       <a href="{{ route('users') }}">Regresar al listado de usuarios</a>
   </p>
@endsection