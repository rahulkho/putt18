@extends('oxygen::layouts.master-auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @include('oxygen::partials.flash')

            <div class="col-md-8">

                <div id="accordion">

                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                                <div class="btn btn-light" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Register and Join the Team
                                </div>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse @if (!$plausibleUser) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('register.store') }}">
                                    @csrf
                                    <input type="hidden" name="invitation_code" value="{{ $invite->invitation_code }}">

                                    <div class="form-group row text-center">
                                        <div class="col-md-12">
                                            <h3>You've been invited to join a team.</h3>

                                            <div class="copy">
                                                <p>Complete registration and see what's inside.</p>
                                            </div>
                                        </div>
                                    </div>

                                    @include('oxygen::auth.register_form_fields')

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Accept the Invitation
                                            </button>
                                        </div>
                                    </div>

                                    <hr/>
                                    <div class="form-group">
                                        <div class="col-md-8 offset-md-4">
                                            Already have an account?
                                            <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" data-target="#collapseTwo">Login</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <div class="btn btn-light collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Already have an account? Login Here
                                </div>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse @if ($plausibleUser) show @endif" data-parent="#accordion" aria-labelledby="headingTwo">
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST" action="/login">
                                    @csrf
                                    <input type="hidden" name="invitation_code" value="{{ $invite->invitation_code }}">

                                    @include('oxygen::auth.login_form_fields')

                                    <hr/>

                                    <div class="form-group">
                                        <div class="col-md-8 offset-md-4">
                                            Don't have an account?
                                            <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" data-target="#collapseOne">Signup for a New Account</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
