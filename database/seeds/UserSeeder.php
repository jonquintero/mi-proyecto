<?php

use App\Profession;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $professions = DB::select('SELECT id FROM professions WHERE title = ?', ['Desarrollador Back-end']);
        //DB es un FACADE
       /* $professionId = DB::table('professions')
            ->where('title','Desarrollador Back-end')
            ->value('id');*/

       $professionId = Profession::where('title','Desarrollador Back-end')
           ->value('id');

        /*DB::table('users')->insert([
            'name' => 'Jonathan Quintero',
            'email' => 'jonquintero@hotmail.com',
            'password' => bcrypt('secret'),
            'profession_id' =>  $professionId,



        ]);*/

        User::create([
            'name' => 'Jonathan Quintero',
            'email' => 'jonquintero@hotmail.com',
            'password' => bcrypt('secret'),
            'profession_id' =>  $professionId,
        ]);
    }
}
