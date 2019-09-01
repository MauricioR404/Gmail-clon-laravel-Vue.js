<?php

namespace Tests\Feature;

use App\User;
use App\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCanMarkAMessage extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function the_admin_can_mark_a_message_as_read()
    {
        $this->withoutExceptionHandling();
        //Poner el estado a leído
        $message = factory(Message::class)->create();
        $user = factory(User::class)->create(['email' => 'admin@gmail.com']);
        $update = 'readOrUnread'; //Especificar que se actualizara el campo " state "

        $this->actingAs($user)
            ->getJson(route('message.update', [$message->id, $update]))
            ->assertSuccessful();

        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'state' => 1
        ]);

        //Quitar el estado a no leído
        $this->getJson(route('message.update', [$message->id, $update]));

        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'state' => 0
        ]);
    }
}
