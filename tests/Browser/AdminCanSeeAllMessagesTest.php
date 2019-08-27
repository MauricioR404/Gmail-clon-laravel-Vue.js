<?php

namespace Tests\Browser;

use App\User;
use App\Message;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminCanSeeAllMessagesTest extends DuskTestCase
{
    use DatabaseMigrations;
    /** @test */
    public function admin_can_see_all_messages()
    {
        $user = factory(User::class)->create();
        /** Arreglar para despues, acuerdate que el mensaje no es igual por el STR_LIMIT($this->body, 150) */
        $messages = factory(Message::class, 3)->create(['created_at' => now()->subDays()]);

        $this->browse(function (Browser $browser) use($messages, $user) {
            $browser->loginAs($user)
                    ->visit('/messages');
                foreach($messages as $message){
                    $browser->assertSee(str_limit($message->body, 100));
                }
        });
    }
}
