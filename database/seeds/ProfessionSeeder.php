<?php

use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       /* DB::table('professions')->insert([
            'title' => 'Desarrollador Back-end',

        ]);

        DB::table('professions')->insert([
            'title' => 'Desarrollador Front-end',

        ]);

        DB::table('professions')->insert([
            'title' => 'Diseñador web',

        ]);*/

       Profession::create([
           'title' => 'Desarrollador Back-end',
       ]);

        Profession::create([
            'title' => 'Desarrollador Front-end',
        ]);

        Profession::create([
            'title' => 'Diseñador web',
        ]);
    }
}
