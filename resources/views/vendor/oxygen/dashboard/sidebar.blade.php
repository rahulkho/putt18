<div class="nav-headline">Menu</div>
<ul class="nav nav-pills nav-wide flex-column">
    <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
</ul>

<div class="nav-headline">Manage</div>
{{--@if ($user->can('view-permissions'))--}}
    <ul class="nav nav-pills nav-wide flex-column">
        <li><a href="{{ route('manage.rankings.index') }}"><i class="fas fa-users"></i> Leaderboard</a></li>
        <li><a href="{{ route('manage.games.index') }}"><i class="fas fa-users"></i> Games</a></li>
        <li><a href="{{ route('manage.faqs.index') }}"><i class="fas fa-users"></i> FAQs</a></li>
        <li><a href="{{ route('manage.push-notifications.index') }}"><i class="fas fa-comment"></i> Push Notifications</a></li>
        @include('oxygen::dashboard.partials.menuBar', ['menuBarType' => 'sidebar.manage'])
        <li><a href="{{ route('manage.users.index') }}"><i class="fas fa-users"></i> Users</a></li>
        <li><a href="{{ route('manage.documentation.index') }}"><i class="fas fa-plug"></i> API</a></li>
        <li><a href="{{ route('manage.files.index') }}"><i class="fas fa-file-upload"></i> Files</a></li>
        <li><a href="{{ route('manage.access.index') }}"><i class="fas fa-user-shield"></i> Access Permissions</a></li>
    </ul>
{{--@endif--}}

{{--
<div class="nav-headline">Your Account</div>
<ul class="nav nav-pills nav-wide flex-column">
    <li><a href="{{ route('account.profile') }}"><i class="fas fa-user"></i> My Profile</a></li>
    <li><a href="{{ route('account.email') }}"><em class="fas fa-envelope"></em> Edit Email</a></li>
    <li><a href="{{ route('account.password') }}"><em class="fas fa-lock"></em> Edit Password</a></li>
    <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
</ul>
--}}
