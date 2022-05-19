@extends('oxygen::layouts.master-dashboard')

@section('content')
    <div class="container-fluid">
        {{ lotus()->pageHeadline($pageTitle) }}

        {{ lotus()->breadcrumbs([
            ['Dashboard', route('dashboard')],
            ['Access Permissions', route('manage.access.index')],
            [$pageTitle, null, true]
        ]) }}


        @if ($user->can('add-groups'))
            <a href="/account/groups/new" class="btn btn-wide btn-success"><i class="fa fa-plus-circle"></i> Add a New
                Group</a>
            <br/><br/>
        @else
            <br/>
            <p>Only account owners and administrators can add users. Please contact a group Admin to add new users.</p>
            <br/>
        @endif

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        Current User Groups
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Group</th>
                                <th>View Users</th>
                                <th>Add Users</th>
                                <th>Edit Permissions</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rolesData as $role)
                                <tr>
                                    <td>
                                        <div class="row-title">{{ $role['title'] }}</div>
                                        {{ $role['description'] }}
                                    </td>
                                    <td>
                                        <a href="/account/groups/{{ $role['id'] }}/users"
                                           class="btn btn-info"
                                           data-toggle="tooltip"
                                           title="View Users">
                                            <i class="fas fa-eye"></i> View Users
                                        </a>
                                    </td>
                                    <td>
                                        @if ($user->can('edit-group-users'))
                                            <span data-toggle="modal" data-target="#userControlModal"
                                                  data-role_id="{{ $role['id'] }}">
                                                <button
                                                        class="btn btn-warning"
                                                        data-toggle="tooltip"
                                                        title="Add a User to {{ $role['title'] }}">
                                                    <i class="fas fa-user-plus"></i> Add Users
                                                </button>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->can('edit-group-permissions'))
                                            <a href="/account/groups/{{ $role['id'] }}/permissions"
                                               class="btn btn-warning"
                                               data-toggle="tooltip"
                                               title="View Permissions">
                                                <i class="fa fa-edit"></i> Permissions
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-spaced">
                                            @if ($user->can('edit-groups'))
                                                <a href="/account/groups/{{ $role['id'] }}/edit"
                                                   class="btn btn-info"
                                                   data-toggle="tooltip"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i> Edit Role
                                                </a>
                                            @endif

                                            @if ($user->can('delete-groups') && $role['allow_to_be_deleted'])
                                                <form class="form-inline" role="form" method="POST"
                                                      action="/account/groups/{{ $role['id'] }}"
                                                      data-toggle="tooltip" title="Delete">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button class="btn btn-danger"><i class="fas fa-times"></i> Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('oxygen::groups.add-users-to-group')


@endsection
