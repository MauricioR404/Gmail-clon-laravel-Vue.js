<?php

namespace Tests\Feature;

use App\User;
use App\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCanSeeAMessageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function admin_can_see_a_message()
    {
        $user = factory(User::class)->create(['email' => 'admin@gmail.com']);
        $message = factory(Message::class)->create();

        $this->actingAs($user);
        $response = $this->getJson(route('message.show', $message->id));
        
        $response->assertSuccessful();
        
        $this->assertEquals(
            $message->id, 
            $response->json('id')
        );
    }
}
