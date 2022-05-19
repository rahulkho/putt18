<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class Login extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
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
            ->assertSee('Login')
            ->assertVisible('@email')
            ->assertVisible('@password')
            ->assertVisible('@remember')
            ->assertVisible('@submit')
            ->assertSeeIn('@submit', 'Login')
            ->assertSeeLink('Forgot Your Password?');
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
            '@password' => '#password',
            '@remember' => '#remember',
            '@submit' => 'form button[type="submit"]',
        ];
    }
}
