<?php

namespace Tests\Browser\Auth;

use App\User;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Dashboard;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserAccountTest extends DuskTestCase
{
    /**
     * I should not show the dropdown menu until its opened.
     *
     * @return void
     */
    public function testAccountDropdownIsWorking()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                ->visit(new Dashboard())
                ->assertDontSeeLink('My Profile')
                ->assertDontSeeLink('Edit Email')
                ->assertDontSeeLink('Edit Password')
                ->click('@user-menu')
                ->assertSeeLink('My Profile')
                ->assertSeeLink('Edit Email')
                ->assertSeeLink('Edit Password');
        });
    }

    /**
     * It should be able to edit password.
     *
     * @return void
     */
    public function testEditingPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                ->visit(new Dashboard())
                ->click('@user-menu')
                ->clickLink('Edit Password')
                ->assertSee('Edit My Password')
                ->assertSee('New Password')
                ->assertSee('Confirm Password')
                ->assertSee('Current Password')
                ->clear('#password')->type('#password', '87654321')
                ->clear('#password_confirmation')->type('#password_confirmation', '87654321')
                ->clear('#current_password')->type('#current_password', '12345678')
                ->click('form button[type="submit"]')
                ->assertPathIs('/account/password/edit')
                ->assertSee('Password successfully updated')
                ->clear('#password')->type('#password', '12345678')
                ->clear('#password_confirmation')->type('#password_confirmation', '12345678')
                ->clear('#current_password')->type('#current_password', '87654321')
                ->click('form button[type="submit"]')
                ->assertPathIs('/account/password/edit')
                ->assertSee('Password successfully updated');
        });
    }

    /**
     * It should be able to edit profile.
     *
     * @return void
     */
    public function testEditingProfile()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(2);
            $name = $user->name;

            $browser->loginAs($user)
                ->visit(new Dashboard())
                ->click('@user-menu')
                ->clickLink('My Profile')
                ->assertSee('My Profile')
                ->assertSee('Edit Profile')
                ->assertInputValue('#name', $name)
                ->clear('#name')->type('#name', 'Test User')
                ->click('form button[type="submit"]')
                ->assertPathIs('/account/profile')
                ->assertSee('Your profile has been updated')
                ->clear('#name')->type('#name', $name)
                ->click('form button[type="submit"]')
                ->assertPathIs('/account/profile')
                ->assertInputValue('#name', $name)
                ->assertSee('Your profile has been updated');
        });
    }

    /**
     * It should be able to edit email.
     *
     * @return void
     */
    public function testEditingEmail()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(2);

            $browser->loginAs($user)
                ->visit(new Dashboard())
                ->click('@user-menu')
                ->clickLink('Edit Email')
                ->assertSee('Edit Email')
                ->assertInputValue('input[name="email"]', $user->email)
                ->clear('input[name="email"]')->type('input[name="email"]', 'test@example.com')
                ->clear('#password')->type('#password', '12345678')
                ->click('form button[type="submit"]')
                ->assertPathIs('/account/email/edit')
                ->assertSee('Your email has been updated')
                ->assertInputValue('input[name="email"]', 'test@example.com')
                ->clear('input[name="email"]')->type('input[name="email"]', $user->email)
                ->clear('#password')->type('#password', '12345678')
                ->click('form button[type="submit"]')
                ->assertPathIs('/account/email/edit')
                ->assertSee('Your email has been updated');
        });
    }
}
