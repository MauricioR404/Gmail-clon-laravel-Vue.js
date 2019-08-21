<?php

namespace Tests\Feature;

use App\User;
use App\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListMessagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_see_all_messages()
    {
        $response = $this->getJson(route('messages.index'));
    
        $response->assertStatus(401);
    }
    
    /** @test */
    public function admin_can_see_all_messages()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create(['email' => 'admin@gmail.com']);

        $this->actingAs($user);
        
        $message1 = factory(Message::class)->create(['created_at' => now()->subDays(4)]);
        $message2 = factory(Message::class)->create(['created_at' => now()->subDays(3)]);
        $message3 = factory(Message::class)->create(['created_at' => now()->subDays(2)]);
        $message4 = factory(Message::class)->create(['created_at' => now()->subDays(1)]);

        $response = $this->getJson(route('messages.index'));

        $response->assertSuccessful();
        
        $response->assertJson([
            'total' => 4
        ]);

        $response->assertJsonStructure([
            'data', 'total', 'first_page_url', 'last_page_url'
        ]);

        $this->assertEquals(
            $message4->id,
            $response->json('data.0.id')
        );
    }
    
}
