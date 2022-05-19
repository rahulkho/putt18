<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class ResetPassword extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/password/reset';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url())
            ->assertSee('Reset Password')
            ->assertVisible('@submit')
            ->assertSeeIn('@submit', 'Send Password Reset Link');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@email' => '#email',
            '@submit' => 'form button[type="submit"]',
        ];
    }
}
