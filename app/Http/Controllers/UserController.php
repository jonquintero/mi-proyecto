<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        //$users = DB::table('users')->get();
        $users = User::all();

        $title = 'Listado de usuarios';

      /*  return view('users')
            ->with('users', User::all())
            ->with('title', 'Listado de usuarios ');*/

       return view('users.index', compact('title', 'users'));
    }

    public function show(User $user)
    {
        //$user = User::findOrFail($id);

       /* if($user == null)
        {
            return response()->view('errors.404',[], 404);
        }*/

        return view('users.show', compact('user'));

    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        //request se usa para obtener los datos del formulario
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ],[
            'name.required' => 'El campo nombre es obligatorio',

        ]);


        User::create([
           'name' => $data['name'],
           'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users');
    }

    public function edit(User $user)
    {

        return view('users.edit', ['user' => $user]);
    }
}