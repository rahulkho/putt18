<footer>
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col col-md-3">
                    <div class="headline">Account</div>
                    <ul>
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        @endguest
                    </ul>
                </div>

                <div class="col col-md-3">
                    {{--<div class="headline">About</div>--}}
                    {{--<ul>--}}
                    {{--<li><a href="/faqs">Frequently Asked Questions</a></li>--}}
                    {{--<li><a href="/contact-us">Contact Us</a></li>--}}
                    {{--</ul>--}}
                </div>

                <div class="col col-md-3">
                    {{--<div class="headline">Policy Information</div>--}}
                    {{--<ul>--}}
                    {{--<li><a href="/privacy-policy">Privacy Policy</a></li>--}}
                    {{--<li><a href="/terms-conditions">Terms & Conditions</a></li>--}}
                    {{--</ul>--}}
                </div>

                <div class="col col-md-3">
                    <span class="text">
                        Licenced to {{ config('app.name') }}
                        <br>
                        &copy; {{ date('Y') }} Elegant Media
                    </span>
                    <br>
                    <span class="text">{{-- Made with Love --}}</span>
                </div>
            </div>
        </div>
    </div>
</footer>