<?php

namespace Tests\Feature;

use App\User;
use App\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCanDeleteMessageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function the_admin_can_delete_a_message()
    {
        $admin =  factory(User::class)->create(['email' => 'admin@gmail.com']);
        
        $message = factory(Message::class)->create();
        
        $this->actingAs($admin)
             ->deleteJson(route('message.delete', $message))
             ->assertSuccessful();

        $this->assertDatabaseMissing('messages', [$message->fresh()]);
    }
}
