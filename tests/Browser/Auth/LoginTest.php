<?php

namespace Tests\Browser\Auth;

use Auth;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Login;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * It should be able to login successfully with valid credentials.
     *
     * @return void
     */
    public function testLoginWithValidCredentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login())
                ->type('@email', 'apps+user@elegantmedia.com.au')
                ->type('@password', '12345678')
                ->click('@submit')
                ->assertPathIs('/')
                ->assertSeeLink('Logout')
                ->clickLink('Logout')
                ->assertPathIs('/');
        });
    }

    /**
     * It should not be able to login with empty fields.
     *
     * @return void
     */
    public function testLoginWithEmptyFields()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login())
                ->clear('@email')
                ->clear('@password')
                ->click('@submit')
                ->assertPathIs('/login');
        });
    }

    /**
     * It should not be able to login with invalid email.
     *
     * @return void
     */
    public function testLoginWithNonExistingEmail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login())
                ->type('@email', 'xyz@elegantmedia.com.au')
                ->type('@password', '12345678')
                ->click('@submit')
                ->assertPathIs('/login')
                ->assertSee('These credentials do not match our records');
        });
    }

    /**
     * It should not be able to login with invalid password.
     *
     * @return void
     */
    public function testLoginWithInvalidPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login())
                ->type('@email', 'apps+uesr@elegantmedia.com.au')
                ->type('@password', '222222')
                ->click('@submit')
                ->assertPathIs('/login')
                ->assertSee('These credentials do not match our records');
        });
    }

    /**
     * It should not be able to login with invalid password.
     *
     * @return void
     */
    public function testLoginWithRememberMeEnabled()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login())
                ->type('@email', 'apps+user@elegantmedia.com.au')
                ->type('@password', '12345678')
                ->check('@remember')
                ->click('@submit')
                ->assertPathIs('/')
                ->assertHasCookie(Auth::guard()->getRecallerName())
                ->clickLink('Logout');
        });
    }

    /**
     * It should redirect to dashboard when login as admin.
     *
     * @return void
     */
    public function testRedirectToDashboardForAdmin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login())
                ->type('@email', 'apps+admin@elegantmedia.com.au')
                ->type('@password', '12345678')
                ->click('@submit')
                ->assertPathIs('/dashboard')
                ->assertSee('Dashboard')
                ->assertPresent('#sidebar')
                ->assertPresent('#navbarDropdown')
                ->click('#navbarDropdown')
                ->assertSeeLink('Logout')
                ->clickLink('Logout')
                ->assertPathIs('/');
        });
    }

    /**
     * It should redirect to dashboard when login as super-admin.
     *
     * @return void
     */
    public function testRedirectToDashboardForSuperAdmin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login())
                ->type('@email', 'apps@elegantmedia.com.au')
                ->type('@password', '12345678')
                ->click('@submit')
                ->assertPathIs('/dashboard')
                ->assertSee('Dashboard')
                ->assertPresent('#sidebar')
                ->assertPresent('#navbarDropdown')
                ->click('#navbarDropdown')
                ->assertSeeLink('Logout')
                ->clickLink('Logout')
                ->assertPathIs('/');
        });
    }

    /**
     * It should be able to get password recovery form login page.
     *
     * @return void
     */
    public function testForgotPasswordLinkWOrks()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login())
                ->clickLink('Forgot Your Password?')
                ->assertPathIs('/password/reset');
        });
    }
}
