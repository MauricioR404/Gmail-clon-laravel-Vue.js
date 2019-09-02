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
        $response = $this->getJson(route('messages.index', 'all'));
    
        $response->assertStatus(401);
    }
    
    /** @test */
    public function admin_can_see_all_messages()
    {
        $user = factory(User::class)->create(['email' => 'admin@gmail.com']);
        $category = 'all'; //List all messages

        $this->actingAs($user);
        
        $message1 = factory(Message::class)->create(['created_at' => now()->subDays(4)]);
        $message2 = factory(Message::class)->create(['created_at' => now()->subDays(3)]);
        $message3 = factory(Message::class)->create(['created_at' => now()->subDays(2)]);
        $message4 = factory(Message::class)->create(['created_at' => now()->subDays(1)]);

        $response = $this->getJson(route('messages.index', $category));

        $response->assertSuccessful();
        
        $response->assertJson([
            'meta' => ['total' => 4]
        ]);

        $response->assertJsonStructure([
            'data', 'links' => ['prev', 'next']
        ]);

        $this->assertEquals(
            str_limit($message4->body, 100),
            $response->json('data.0.body')
        );
    }

    /** @test */
    public function admin_can_see_only_starred_messages()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create(['email' => 'admin@gmail.com']);
        $category = 'starred'; //list only starred messages

        /** We create two messages the have starred and one that doesn't */
        $message1 = factory(Message::class)->create([
            'created_at' => now()->subDays(2),
            'category_id' => 1
        ]);

        $message2 = factory(Message::class)->create([
            'created_at' => now()->subDays(1),
            'category_id' => 1
        ]);

        $message3 = factory(Message::class)->create(['created_at' => now()->subDays(1)]);

        $response = $this->actingAs($user)
                         ->getJson(route('messages.index', $category))
                         ->assertSuccessful();
        
        $response->assertJson([
            'meta' => ['total' => 2] //l
        ]);

        $response->assertJsonStructure([
            'data', 'links' => ['prev', 'next']
        ]);

        $this->assertEquals(
            str_limit($message2->body, 100),
            $response->json('data.0.body')
        );
    }
    
}
