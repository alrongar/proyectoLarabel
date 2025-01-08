<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_usuario_no_puede_registrarse_con_datos_invalidos()
    {
        $response = $this->post('/register', [
            'email' => 'invalid-email',
            'password' => 'short',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    public function un_usuario_puede_iniciar_sesion_con_datos_validos()
    {
        // Crear un usuario confirmado
        $usuario = User::factory()->create([
            'email' => 'usuario@example.com',
            'password' => bcrypt('password123'),
            'email_confirmed' => true, // Asegúrate de que el usuario esté confirmado
            'actived'=> 1
        ]);

        // Intentar iniciar sesión con las credenciales correctas
        $response = $this->post('/login', [
            'email' => 'usuario@example.com',
            'password' => 'password123',
        ]);

        // Cambiar a la URL correcta /user/dashboard
        $response->assertRedirect('/user/dashboard');
        $this->assertAuthenticatedAs($usuario);
    }

    /** @test */
    public function un_usuario_no_puede_iniciar_sesion_si_no_esta_confirmado()
    {
        // Crear un usuario no confirmado
        $usuario = User::factory()->create([
            'email' => 'usuario@example.com',
            'password' => bcrypt('password123'),
            'email_confirmed' => false,
            'actived' => 0
        ]);

        // Intentar iniciar sesión con el usuario no confirmado
        $response = $this->post('/login', [
            'email' => 'usuario@example.com',
            'password' => 'password123',
            'actived' => 1
        ]);

        // Verificar que se genera un error en la sesión, ya que el email no está confirmado
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function un_usuario_no_puede_iniciar_sesion_con_datos_invalidos()
    {
        // Intentar iniciar sesión con credenciales incorrectas
        $response = $this->post('/login', [
            'email' => 'usuario_inexistente@example.com', 
            'password' => 'wrongpassword', 
        ]);

        
        $response->assertRedirect('/'); 

        
        $response->assertSessionHasErrors('email');  
       
    }


    /** @test */
    public function un_usuario_no_puede_iniciar_sesion_si_esta_inactivo()
    {
        // Crear un usuario inactivo
        $usuario = User::factory()->create([
            'email' => 'usuario_inactivo@example.com',
            'password' => bcrypt('password123'),
            'actived' => false, // El usuario está inactivo
        ]);

        // Intentar iniciar sesión con el usuario inactivo
        $response = $this->post('/login', [
            'email' => 'usuario_inactivo@example.com',
            'password' => 'password123',
        ]);

        // Verificar que el login falla porque el usuario está inactivo
        $response->assertSessionHasErrors();
    }
}
