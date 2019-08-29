<?php

namespace Tests\Browser;

use App\User;
use App\Message;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class adminCanDeleteAMessageTest extends DuskTestCase
{
    use DatabaseMigrations;
    /** @test */
    public function the_can_delete_a_message()
    {
        $admin = factory(User::class)->create(['email' => 'admin@gmail.com']);
        factory(Message::class)->create();
        $this->browse(function (Browser $browser) use($admin) {
            $browser->loginAs($admin)
                    ->visit('/messages')
                    ->mouseover('@hover')
                    ->click('@btn-delete')
                    ->waitUntilMissing('@btn-delete')
                    ->waitForText('El mensaje se elimino correctamente')
                    ->assertSee('El mensaje se elimino correctamente')
                    ;
        });
    }
}
