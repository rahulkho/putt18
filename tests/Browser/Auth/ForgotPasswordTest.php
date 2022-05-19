<?php

namespace Tests\Browser\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Tests\DuskTestCase;
use Tests\Browser\Pages\ResetPassword;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ForgotPasswordTest extends DuskTestCase
{

	/**
	 * It should not allow sending password reset email for invalid email.
	 *
	 * @return void
	 */
	public function testNotSendingForInvalidEmails()
	{
		$this->browse(function (Browser $browser) {
			$browser->visit(new ResetPassword())
				->type('@email', 'johndoe.com')
				->click('@submit')
				->assertPathIs('/password/reset');
		});
	}

	/**
	 * It should not allow sending password reset email for non-existing email.
	 *
	 * @return void
	 */
	public function testNotSendingForNonExistingEmails()
	{
		$this->browse(function (Browser $browser) {
			$browser->visit(new ResetPassword())
				->type('@email', 'xyz@nonexisting.com')
				->click('@submit')
				->assertPathIs('/password/reset')
				->assertSee(trans('passwords.user'));
		});
	}

	/**
	 * It should send password reset email to existing email.
	 *
	 * @return void
	 */
	public function testSendingForExistingEmails()
	{
		$this->browse(function (Browser $browser) {
			$browser->visit(new ResetPassword())
				->type('@email', 'apps+user@elegantmedia.com.au')
				->click('@submit')
				->assertPathIs('/password/reset')
				->assertSee(trans('passwords.sent'));
		});
	}

	/**
	 *
	 * Reset the changes
	 *
	 */
	protected function tearDown() : void
	{
		\DB::table('password_resets')->where('email', 'apps+user@elegantmedia.com.au')->delete();
	}
}
