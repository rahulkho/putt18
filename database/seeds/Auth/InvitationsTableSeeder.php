<?php


use EMedia\Oxygen\Entities\Invitations\Invitation;

class InvitationsTableSeeder extends \Illuminate\Database\Seeder
{

	public function run()
	{
		if (!app()->environment('production')) {
			$this->seedInvitations();
		}
	}

	protected function seedInvitations()
	{
		$faker = Faker\Factory::create('en_AU');
		$roles = \App\Entities\Auth\Role::all();

		/** @var \EMedia\Oxygen\Entities\Invitations\InvitationRepository $invitationsRepo */
		$invitationsRepo = app(\EMedia\Oxygen\Entities\Invitations\InvitationRepository::class);

		for ($i = 0, $iMax = 10; $i < $iMax; $i++) {
			$invitation = new Invitation([
				'email' => $faker->email,
			]);
			$invitation->role_id = $roles->random(1)->first()->id;
			$invitation->invitation_code = $invitationsRepo->generateUniqueInvitationCode();
			$invitation->sent_at = now();

			if (random_int(0, 10) > 7) {
				$invitation->claimed_at = now();
			}

			$invitation->save();
		}
	}

}