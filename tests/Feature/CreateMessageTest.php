<?php

namespace Tests\Feature;

use App\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateMessageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_invited_can_create_message()
    {
        $message = [
            'name' => 'mauricio',
            'email' => 'mauricio@gmail.com',
            'phone' => 7979,
            'body' => 'mi testo'
        ];

        $this->post(route('message.store'), $message);

        $this->assertDatabaseHas('messages', $message);
    }
}
