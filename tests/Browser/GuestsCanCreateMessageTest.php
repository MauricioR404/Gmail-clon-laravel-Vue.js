<?php

namespace Tests\Browser;

use App\Message;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GuestsCanCreateMessageTest extends DuskTestCase
{
    use DatabaseMigrations;
    /** @test */
    public function guests_can_create_message()
    {
        $message = factory(Message::class)->create();
        $this->browse(function (Browser $browser) use($message) {
            $browser->visit('/')
                    ->type('name', $message->name)
                    ->type('phone', $message->phone)
                    ->type('email', $message->email)
                    ->type('body', $message->body)
                    ->press('@btn-message')
                    ->assertPresent('@succes-messages')
                    ;
        });
    }
}
