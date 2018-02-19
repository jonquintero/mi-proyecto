<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    //use RefreshDatabase;
   use DatabaseTransactions;

    /** @test */
    function it_show_the_users_list()
    {
        factory(User::class)->create([
            'name' => 'Joel',
        ]);

        factory(User::class)->create([
            'name' => 'Ellie',
        ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Joel')
            ->assertSee('Ellie');
    }

    /** @test */
    function it_show_a_default_message_if_the_users_list_is_empty()
    {
        DB::table('users')->truncate();

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }

    /** @test */
    function it_display_the_users_details()
    {
        $user = factory(User::class)->create([
            'name'  => 'Jonathan Quintero',
        ]);

        $this->get('/usuarios/'.$user->id)
            ->assertStatus(200)
            ->assertSee('Jonathan Quintero');
    }

    /** @test */

    function it_displays_a_404_error_if_the_user_is_not_found()
    {

        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }

    /** @test */
    function it_loads_the_new_users_page()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear usuario');
    }

    /** @test */
    function it_create_a_new_user()
    {
        $this->withoutExceptionHandling();
        $this->post('/usuarios/', [
            'name' => 'Jonathan',
            'email' => 'jquintero@hotmail.com',
            'password' => 'secret'
        ])->assertRedirect('usuarios');

        $this->assertCredentials([
            'name' => 'Jonathan',
            'email' => 'jquintero@hotmail.com',
            'password' => 'secret',
        ]);
    }

    /** @test */
    function the_name_is_required()
    {
      //  $this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
            'name' => '',
            'email' => 'jonquintero@hotmail.com',
            'password' => 'secret'
        ])->assertRedirect('usuarios/nuevo')
         ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertEquals(0, User::count());
        /*$this->assertDatabaseMissing('users', [
            'email' => 'jonquintero@hotmail.com',
        ]);*/

    }

    /** @test */
    function the_email_is_required()
    {
       // $this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Jonathan',
                'email' => 'correo-no-valido',
                'password' => 'secret'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(0, User::count());
        /*$this->assertDatabaseMissing('users', [
            'name' => 'Jonathan',
        ]);*/

    }

    /** @test */
    function the_email_must_be_unique()
    {
        factory(User::class)->create([
            'email' => 'jonquintero@hotmail.com'
        ]);
       // $this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Jonathan',
                'email' => 'jonquintero@hotmail.com',
                'password' => 'secret'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertEquals(1, User::count());
        /*$this->assertDatabaseMissing('users', [
            'name' => 'Jonathan',
        ]);*/

    }

    /** @test */
    function the_password_is_required()
    {
       // $this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Jonathan',
                'email' => 'jonquintero@hotmail.com',
                'password' => ''
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);

        $this->assertEquals(0, User::count());
       /* $this->assertDatabaseMissing('users', [
            'name' => 'Jonathan',
        ]);*/

    }

}
