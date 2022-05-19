@extends('oxygen::layouts.master-dashboard')

<?php $pageTitle = 'Edit My Password' ?>

@section('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    @include('oxygen::account.password-form')
@endsection
