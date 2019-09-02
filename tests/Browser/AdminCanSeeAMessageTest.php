<?php

namespace Tests\Browser;

use App\User;
use App\Message;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminCanSeeAMessageTest extends DuskTestCase
{
    use DatabaseMigrations;
    /** @test */
    public function admin_can_see_a_message()
    {   
        $user = factory(User::class)->create(['email' => 'admin@gamil.com']);
        $message = factory(Message::class)->create(['email' => 'admin@gamil.com']);
        
        $this->browse(function (Browser $browser) use($user, $message) {
            $browser->loginAs($user)
                    ->visit('/messages')
                    ->click('@btn-show')
                    ->waitForText($message->body)
                    ->assertSee($message->body);
        });
    }
}
