@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')
    <h1>Usuario #{{ $user->id }}</h1>

   <p>Nombre: {{ $user->name }}</p>
   <p>Correo electronico: {{ $user->email }}</p>
   <p>
       <a href="{{ route('users') }}">Regresar al listado de usuarios</a>
   </p>
@endsection