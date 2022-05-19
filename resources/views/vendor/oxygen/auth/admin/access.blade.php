@extends('oxygen::layouts.master-dashboard')

<?php $viewedItemCount = 0; ?>

@section('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        [$pageTitle, null, true]
    ]) }}

    <table class="table table-hover">
        <tbody>
        @if ($user->can('view-groups'))
			<?php $viewedItemCount++ ?>
            <tr>
                <td>
                    <div class="row-title">Groups & Permissions</div>
                    <span class="muted">Create and manage groups who can use the application.</span>
                </td>
                <td width="20%">
                    <a class="btn btn-primary btn-block" href="{{ route('access.groups.index') }}">Manage Groups</a>
                </td>
            </tr>
        @endif
        @if ($user->can('view-permissions'))
			<?php $viewedItemCount++ ?>
            <tr>
                <td>
                    <div class="row-title">Permissions Categories</div>
                    <span class="muted">Assign permissions to categories for more granular control.</span>
                </td>
                <td>
                    <a class="btn btn-primary btn-block" href="{{ route('access.abilities.index') }}">Manage Permission Categories</a>
                </td>
            </tr>
        @endif
        @if ($user->can('invite-group-users'))
			<?php $viewedItemCount++ ?>
            <tr>
                <td>
                    <div class="row-title">Invite Users</div>
                    <span class="muted">Send invitations to users to join groups.</span>
                </td>
                <td>
                    <a class="btn btn-primary btn-block" href="{{ route('access.invitations.index') }}">Invite Users</a>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    @if (!$viewedItemCount)
        {{ lotus()->emptyStatePanel("You don't have permissions to see some content on this page.") }}
    @endif
@stop