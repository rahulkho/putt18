<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{

	public function privacyPolicy()
	{
		return view('oxygen::pages.privacy', ['pageTitle' => 'Privacy Policy']);
	}

	public function termsConditions()
	{
		return view('oxygen::pages.terms', ['pageTitle' => 'Terms & Conditions']);
	}

	public function faqs()
	{
		return view('oxygen::pages.faqs', ['pageTitle' => 'Frequently Asked Questions']);
	}

	/**
	 *
	 * Show Contact Us Page
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function contactUs()
	{
		return view('oxygen::pages.contact-us', ['pageTitle' => 'Contact Us']);
	}

	/**
	 *
	 * Submit Contact Us Page
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postContactUs(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'userMessage' => 'required'
		]);
		$data = $request->only('name', 'email', 'phone', 'userMessage');

		// recaptcha validation
		if (config('features.security.recaptcha_enabled')) {
			$secret = env('RECAPTCHA_SECRET_KEY');
			$recaptcha = new \ReCaptcha\ReCaptcha($secret);
			$response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());
			if ($response->isSuccess()) {
				// Verified!
				// do nothing, proceed forward
			} else {
				$errors = $response->getErrorCodes();

				if (count($errors)) {
					return redirect()->route('contact-us')
									 ->with('error', 'Captcha validation failed. Try again or email us for support.')
									 ->withInput($data);
				}
			}
		}

		$data['timestamp'] = Carbon::now()->format('d/m/Y h:i:sA');
		$data['userIp']    = request()->ip();
		$data['sender_email'] = $request->get('email');

		$webmaster = env('WEBMASTER_EMAIL');
		if (empty($webmaster)) throw new \InvalidArgumentException("Email receiver email has not been set.");
		$receiverEmails = [$webmaster];

		Mail::send(['text' => 'oxygen::emails.text.contact-us'], $data, function($mailMessage) use ($data, $receiverEmails)
		{
			$mailMessage->to($receiverEmails)
						->replyTo($data['sender_email'])
						->subject(config('app.name') . ' - Contact Us - Message Received');
		});

		return redirect()->back()->with('success', 'Your message has been sent.');
	}
}