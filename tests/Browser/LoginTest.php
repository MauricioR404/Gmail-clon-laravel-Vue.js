<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /** @test*/
    public function only_admin_can_login()
    {
        factory(User::class)->create(['email' => 'admin@gmail.com']);
        
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'admin@gmail.com')
                    ->type('password', 'password')
                    ->press('@btn-login')
                    ->assertPathIs('/messages')
                    ->assertAuthenticated()        
            ;
        });
    }
}
