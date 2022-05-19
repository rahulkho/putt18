@extends('oxygen::layouts.master-frontend-internal')

@push('meta')
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">

    @if (config('features.security.recaptcha_enabled'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
@endpush

@section('internal-page-contents')
    <div id="report-issue" class="content-page">

        <div class="container page-container">

            @include('oxygen::partials.flash')

            <div class="text-center">
                <div>If you have a question or want to contact us, fill the form below and send us a message.</div>
                <br><br>
            </div>

            <div class="row">
                <div class="col-md-9 offset-3">
                    {{ Form::open(['url' => '/contact-us', 'method' => 'post', 'class' => 'form-horizontal']) }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Your name</label>
                        <div class="control-group col-md-9">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Your email</label>
                        <div class="control-group col-md-9">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label col-md-3">Phone</label>
                        <div class="control-group col-md-9">
                            <input type="phone" name="phone" class="form-control" value="{{ old('phone') }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="userMessage" class="control-label col-md-3">Your Message</label>
                        <div class="control-group col-md-9">
                            {{ Form::textarea('userMessage', '', ['class' => 'form-control']) }}
                        </div>
                    </div>

                    @if (config('features.security.recaptcha_enabled'))
                        <div class="form-group">
                            <div class="control-group col-md-9 col-md-offset-3">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="control-group col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-success btn-primary">Send Message</button>
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
@stop