@extends('oxygen::layouts.master-dashboard')

<?php $pageTitle = 'Permission Groups' ?>

@section('content')

        {{ lotus()->pageHeadline($pageTitle) }}

        {{ lotus()->breadcrumbs([
            ['Dashboard', route('dashboard')],
            ['Access Permissions', route('manage.access.index')],
            [$pageTitle, null, true]
        ]) }}

        <div class="alert alert-danger">
            <div class="font-weight-bold">Notice</div>
            <div>This section is only for knowledge of system administrators. Don't edit the values here if you don't know what they do.</div>
        </div>

        {{--<a href="/account/permission-categories/new"--}}
           {{--class="btn btn-wide btn-success"><i class="fa fa-user-plus"></i> Add New Group</a>--}}

        {{--<br/><br />--}}

        @if (is_countable($allItems) && count($allItems))
            <table class="table table-hover">

                {{ lotus()->tableHeader('Permission Category', 'Permissions') }}

                <tbody>
                @foreach($allItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>
                            @foreach($item->abilities as $ability)
                                <span class="badge badge-success">{{ $ability->title }}</span>
                            @endforeach
                        </td>
                        <td>
                            {{--
                            <div class="btn-spaced">
                            @if ($user->can('edit-permissions'))
                                <a href="/account/permission-categories/{{ $item['id'] }}/edit"
                                   class="btn btn-info inline"
                                   data-toggle="tooltip"
                                   title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @if (true)
                                    <form class="form-inline" role="form" method="POST" action="/account/permission-categories/{{ $item['id'] }}"
                                          data-toggle="tooltip" title="Delete">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="_method" value="delete" />
                                        <div class="form-group">
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                        </div>
                                    </form>
                                @endif
                            @endif
                            </div>
                            --}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            {{ lotus()->emptyStatePanel() }}
        @endif

        {{ lotus()->pageNumbers($allItems) }}

@endsection
