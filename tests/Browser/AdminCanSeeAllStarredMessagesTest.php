<?php

namespace Tests\Browser;

use App\User;
use App\Message;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminCanSeeAllStarredMessagesTest extends DuskTestCase
{
    use DatabaseMigrations;
    /** @test */
    public function admin_can_see_all_starred_messages()
    {
        $user = factory(User::class)->create(['email' => 'admin@gamil.com']);
        $message1 = factory(Message::class)->create(['category_id' => 1]);
        $message2 = factory(Message::class)->create(['category_id' => 0]);
        $this->browse(function (Browser $browser) use($user, $message1){
            $browser->loginAs($user)
                    ->visit('/messages')
                    ->click('@aside-starred')
                    ->waitForText(str_limit($message1->body, 100))
                    ->assertSee(str_limit($message1->body, 100))
                ;
        });
    }
}
