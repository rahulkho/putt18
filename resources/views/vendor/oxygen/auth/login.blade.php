@extends('oxygen::layouts.master-auth')

@section('content')
	<div class="container">
		@include('oxygen::partials.flash')
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{ __('Login') }}</div>

					<div class="card-body">
						<form method="POST" action="{{ route('login') }}">
							@csrf

							@include('oxygen::auth.login_form_fields')
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
