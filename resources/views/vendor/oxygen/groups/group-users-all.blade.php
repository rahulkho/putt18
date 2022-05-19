@extends('oxygen::layouts.master-dashboard')

@section('content')
        {{ lotus()->pageHeadline($pageTitle) }}

        @include('oxygen::account.access-permissions-breadcrumbs', ['breadcrumbs' =>
            ['User Groups', '/account/groups']
        ])

        @if ($user->can('add-group-users'))
            <button type="button"
                    class="btn btn-wide btn-success"
                    data-toggle="modal"
                    data-target="#userControlModal"
                    data-role_id="{{ $role['id'] }}"><i class="fa fa-user-plus"></i> Add a New User</button>
            <br/><br/>
        @else
            <br/>
            <p>You don't have permissions to add new users. Please contact a group Admin to add new users.</p>
            <br/>
        @endif

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">Users in this Group</div>
                    <div class="card-body">

                        @if($role->users->isEmpty())
                            {{ lotus()->emptyStatePanel() }}
                        @else

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role->users as $currentUser)
                                    <tr>
                                        <td>
                                            <strong>{{ $currentUser->name }}</strong>
                                            @if ($user->email == $currentUser->email)
                                                <span class="badge badge-success">You</span>
                                            @endif
                                        </td>
                                        <td>{{ $currentUser->email }}</td>
                                        <td>
                                            @if ($role->name === 'super-admin' && count($role->users) === 1)
                                                {{-- Last Super admin can't leave the role --}}
                                                <span class="btn btn-danger disabled" data-toggle="tooltip" title="Cannot Delete Last Super Admin"><i class="fa fa-trash"></i>
                                                    Remove User
                                                </span>
                                            @else
                                                <form class="form-inline" role="form" method="POST" action="/account/groups/{{ $role['id'] }}/users/{{ $currentUser->id }}"
                                                      data-toggle="tooltip" title="Delete">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <input type="hidden" name="_method" value="delete" />
                                                    <button class="btn btn-danger"><i class="fa fa-trash"></i>
                                                        @if ($user->email == $currentUser->email)
                                                            Leave Role
                                                        @else
                                                            Remove User
                                                        @endif
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @endif

                    </div>
                </div>
            </div>
        </div>


    @include('oxygen::groups.add-users-to-group')

@endsection
