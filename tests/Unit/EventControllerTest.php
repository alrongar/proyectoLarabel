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


    public function test_event_creation_success()
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
            'image_url' => null,  
        ];

        $response = $this->post(route('organizer.store'), $data);

        $this->assertDatabaseHas('events', [
            'title' => 'Concierto de Rock',
            'location' => 'Auditorio Nacional',
            'category_id' => $category->id,
            'organizer_id' => $user->id,
        ]);

        $response->assertRedirect(route('events.index'));
        $response->assertSessionHas('success', 'Evento creado exitosamente');
    }

    
    public function test_event_creation_with_image()
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

    
     
    public function test_event_creation_validation_fail()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'title' => '',
            'description' => 'Descripción inválida.',
            'category_id' => 999,  
            'start_time' => 'invalid_date',
            'end_time' => 'invalid_date',
            'location' => '',
            'latitude' => 1000,  
            'longitude' => 1000, 
            'max_attendees' => -1, 
            'price' => -100, 
        ];

        $response = $this->post(route('organizer.store'), $data);

        $response->assertSessionHasErrors(['title', 'category_id', 'start_time', 'end_time', 'location', 'latitude', 'longitude', 'max_attendees', 'price']);
    }

    public function test_delete_event()
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

        $response->assertSessionHas('success', 'Evento eliminado con éxito');
    }
}
