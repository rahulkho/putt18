@extends('oxygen::layouts.master-dashboard')

<?php $pageTitle = 'Invite New Users' ?>

@section('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    @include('oxygen::account.access-permissions-breadcrumbs', ['breadcrumbs' =>
        ['User Invitations', route('access.invitations.index')]
    ])

    {{ lotus()->explainPanel('Invite your team members to join. Select a Group and add email addresses below. If a Group is not listed, add a <a href="/account/groups">User Group</a> first.') }}

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">New Invitation</div>
                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="/account/invitations">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Invite to Group</label>
                            <select class="form-control" name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="invitation_emails">Email Addresses</label>
                            <small id="invitation_emails_help" class="form-text text-muted">Add email addresses below. Separated by commas, or add one per each line.</small>

                            @if (strlen(old('success_emails')) > 0)
                                <div class="alert alert-success">
                                    <strong>Emails will be sent to these emails shortly.</strong>
                                    {{ old('success_emails') }}
                                </div>
                            @endif

                            @if (strlen(old('invitation_emails')) > 0)
                                <div class="alert alert-danger">
                                    <strong>Couldn't send the invites to following addresses. Please check the email addresses and try to send again.</strong>
                                </div>
                            @endif

                            <textarea class="form-control" name="invitation_emails" rows="10">{{ old('invitation_emails') }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn btn-success btn-lg btn-wide ">
                                    <i class="fa fa-envelope-o"></i> Send Invitations
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
