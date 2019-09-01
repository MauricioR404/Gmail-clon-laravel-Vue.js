<?php

namespace Tests\Browser;

use App\User;
use App\Message;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminCanMarkAMessageTest extends DuskTestCase
{
    use DatabaseMigrations;
    /** @test */
    public function admin_can_mark_a_message_as_read_or_unread()
    {
        $user = factory(User::class)->create();
        factory(Message::class)->create();
        
        $this->browse(function (Browser $browser) use($user){
            $browser->loginAs($user)
                    ->visit('/messages')
                    ->mouseover('@hover')
                    ->click('@btn-state')
                    ->waitForText('Se ha marcado el mensaje como leído.')
                    ->assertSee('Se ha marcado el mensaje como leído.')

                    ->mouseover('@hover')
                    ->click('@btn-state')
                    ->waitForText('Se ha marcado el mensaje como no leído.')
                    ->assertSee('Se ha marcado el mensaje como no leído.')
                    ;
        });
    }
}
