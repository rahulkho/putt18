<!-- Fixed navbar -->
<!-- Docs master nav -->
<header class="navbar navbar-static-top bs-docs-nav site-header" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../" class="navbar-brand">
                <img src="/images/assets/logo.png" alt=""/>
            </a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/dashboard">Dashboard</a></li>
                @if (Auth::user())
                    <li><a href="/dashboard">Admin</a></li>
                    <li><a href="/users/logout">Logout</a></li>
                @else
                    <li><a href="/users/register">Register</a></li>
                    {{--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">
                            For Job Seekers <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="/users/register">Register</a></li>
                            <li><a tabindex="-1" href="/users/login">Login</a></li>
                        </ul>
                    </li>
                    --}}
                @endif
            </ul>
        </nav>
    </div>
</header>