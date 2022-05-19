@extends('oxygen::layouts.master-dashboard')

<?php $pageTitle = 'Create a New Group' ?>

@section('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    @include('oxygen::account.access-permissions-breadcrumbs', ['breadcrumbs' =>
        ['User Groups', '/account/groups']
    ])

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Group Details</div>
                <div class="card-body">
                    @include('oxygen::groups.groups-form')
                </div>
            </div>
        </div>
    </div>
@endsection
