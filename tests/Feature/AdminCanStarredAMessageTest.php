<?php

namespace Tests\Feature;

use App\User;
use App\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCanStarredAMessageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function admin_can_starred_a_message()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create(['email' => 'admin@gmail.com']);
        $message = factory(Message::class)->create();
        $update = 'starred';
        
        $this->actingAs($user)
             ->getJson(route('message.update', [$message->id, $update]))
             ->assertSuccessful();

        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'category_id' => 1
        ]);
        

        $this->getJson(route('message.update', [$message->id, $update]))
             ->assertSuccessful();

        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'category_id' => 0
        ]);


    }
}
