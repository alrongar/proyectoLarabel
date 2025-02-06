<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class EventControllerTest extends TestCase
{
    
    use RefreshDatabase;
    /** @test */
    public function ExitoCrearEvento()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();

        $data = [
            'title' => 'Concierto de Rock',
            'description' => 'Un gran evento musical.',
            'category_id' => $category->id,
            'start_time' => now()->addHours(2),
            'end_time' => now()->addHours(4),
            'location' => 'Auditorio Nacional',
            'latitude' => 19.432608,
            'longitude' => -99.133209,
            'max_attendees' => 200,
            'price' => 100.00,
        ];

        $response = $this->post(route('organizer.store'), $data);

        $this->assertDatabaseHas('events', [
            'title' => 'Concierto de Rock',
            'location' => 'Auditorio Nacional',
            'category_id' => $category->id,
            'organizer_id' => $user->id,
        ]);

        $response->assertRedirect(route('events.index'));
    }

    /** @test */    
    public function exitoCreacionEventoConImagen()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = Category::factory()->create();

    Storage::disk('public')->put('images/interrogante.jpg', 'fake_image_content');
    $data = [
        'title' => 'Concierto de Jazz',
        'description' => 'Evento exclusivo de Jazz.',
        'category_id' => $category->id,
        'start_time' => now()->addHours(2),
        'end_time' => now()->addHours(4),
        'location' => 'Teatro Metropolitan',
        'latitude' => 19.432608,
        'longitude' => -99.133209,
        'max_attendees' => 200,
        'price' => 150.00,
        'image_url' => UploadedFile::fake()->image('event.jpg'),
    ];

    $response = $this->post(route('organizer.store'), $data);

    $this->assertDatabaseHas('events', [
        'title' => 'Concierto de Jazz',
        'location' => 'Teatro Metropolitan',
        'category_id' => $category->id,
        'organizer_id' => $user->id,
    ]);

    $response->assertRedirect(route('events.index'));
    $response->assertSessionHas('success', 'Evento creado exitosamente');
}

    /** @test */
    public function ExitoEliminarEvento()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();

        $event = Event::factory()->create([
            'organizer_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $response = $this->delete(route('organizer.delete', $event->id));

        $this->assertDatabaseMissing('events', [
            'id' => $event->id,
        ]);

        $response->assertRedirect(route('organizer'));
    }


    /** @test */
    public function ErrorCrearEventoDatosInvalidos()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'title' => '',
            'description' => 'no hay descripcion',
            'category_id' => 999,  
            'start_time' => '310-14-5',
            'end_time' => '111-23-2',
            'location' => '',
            'latitude' => 1000,  
            'longitude' => 1000, 
            'max_attendees' => -1, 
            'price' => -100, 
        ];

        $response = $this->post(route('organizer.store'), $data);

        $response->assertSessionHasErrors([
            'title', 'category_id', 'start_time', 'end_time', 'location', 
            'latitude', 'longitude', 'max_attendees', 'price'
        ]);
    }

}
