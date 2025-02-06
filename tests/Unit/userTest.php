<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function exitoLoginConDatosValidos()
    {
        $usuario = User::factory()->create([
            'email' => 'usuario@example.com',
            'password' => bcrypt('password123'),
            'email_confirmed' => true,
            'actived' => 1
        ]);

        $response = $this->post('/login', [
            'email' => 'usuario@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/user/dashboard');
        $this->assertAuthenticatedAs($usuario);
    }

    /** @test */
    public function testExitoRegistroDatosValidos()
    {
        $response = $this->post('/register', [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'rol' => 'u' 
        ]);
    
        $this->assertDatabaseHas('users', [
            'email' => 'nuevo@example.com',
        ]);
    
        $response->assertRedirect('/home');
    }
    

    // Errores
    /** @test */
    public function errorRegistroDatosInvalidos()
    {
        $response = $this->post('/register', [
            'email' => 'email',
            'password' => '12c',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }


    /** @test */
    public function errorLoginSiNoEstaConfirmado()
    {
        $usuario = User::factory()->create([
            'email' => 'usuario@example.com',
            'password' => bcrypt('password123'),
            'email_confirmed' => false,
            'actived' => 0
        ]);

        $response = $this->post('/login', [
            'email' => 'usuario@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function errorLoginConDatosInvalidos()
    {
        $response = $this->post('/login', [
            'email' => 'usuario_inexistente@example.com', 
            'password' => 'wrongpassword', 
        ]);

        $response->assertRedirect('/'); 
        $response->assertSessionHasErrors('email');  
    }

    /** @test */
    public function errorLoginSiUsuarioInactivo()
    {
        $usuario = User::factory()->create([
            'email' => 'usuario_inactivo@example.com',
            'password' => bcrypt('password123'),
            'actived' => false,
        ]);

        $response = $this->post('/login', [
            'email' => 'usuario_inactivo@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors();
    }

    
}

