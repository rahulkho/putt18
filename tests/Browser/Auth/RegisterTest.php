<?php

namespace Tests\Browser\Auth;

use Tests\DuskTestCase;
use Tests\Browser\Pages\Register;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    /**
     * It should be able to login successfully with valid credentials.
     *
     * @return void
     */
    public function testLoginWithValidCredentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Register())
                ->assertDontSee('@email');
        });
    }
}
