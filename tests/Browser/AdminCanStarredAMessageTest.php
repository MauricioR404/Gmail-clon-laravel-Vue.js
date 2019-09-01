<?php

namespace Tests\Browser;

use App\User;
use App\Message;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminCanStarredAMessageTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function the_admin_can_starred_a_message_or_not()
    {
        $user = factory(User::class)->create(['email' => 'admin@gmail.com']);
        factory(Message::class)->create();

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                    ->visit('/messages')
                    ->click('@btn-starred')
                    ->waitUntilMissing('@unCheck')
                    ->assertMissing('@unCheck')

                    ->click('@btn-starred')
                    ->waitUntilMissing('@check')
                    ->assertMissing('@check')
            ;
        });
    }
}
