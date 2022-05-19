@extends('oxygen::layouts.master-dashboard')

@section('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Manage Users', route('manage.users.index')],
        [$pageTitle, null, true]
    ]) }}

    @include('oxygen::account.password-form')
@endsection
