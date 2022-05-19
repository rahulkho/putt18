@extends('oxygen::layouts.master-dashboard')

@section('breadcrumbs')
    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        [$pageTitle, null, true]
    ]) }}
@stop

@section('pageMainActions')
    @include('oxygen::dashboard.partials.searchField')

    {{--<a href="{{ entity_resource_path() . '/create' }}" class="btn btn-success"><em class="fas fa-plus-circle"></em> Add New</a>--}}
@stop

@section('content')
    @include('oxygen::dashboard.partials.table-allItems', [
        'tableHeader' => [
            'ID', 'Name', 'Email', 'Created', 'Actions', 'Security', 'Danger Zone'
        ]
    ])

    @foreach ($allItems as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                {{ $item->full_name }}
            </td>
            <td>
                {{ $item->email }}
                @if ($item->isDisabled())
                    <span class="badge badge-danger">DISABLED</span>
                @endif
            </td>
            <td>
                @if ($item->created_at)
                    {{ standard_datetime($item->created_at) }}
                @endif
            </td>
            <td>
                @if ($item->isMySelf())
                    <span class="badge badge-success js-tooltip" title="Go to Your Profile to Edit Your Account">You</span>
                @else
                    <a href="{{ entity_resource_path() . '/' . $item->id . '/edit' }}"
                       class="btn btn-info js-tooltip"
                       title="Edit Account"><em class="fa fa-edit"></em> Edit</a>
                @endif
            </td>
            <td>
                @if ($item->isMySelf())
                    <span class="badge badge-success js-tooltip" title="Go to Your Profile to Edit Your Password">You</span>
                @else
                    <div class="btn-spaced">
                        <a href="{{ entity_resource_path() . '/' . $item->id . '/edit-password' }}"
                           class="btn btn-warning"><em class="fa fa-edit"></em> Edit Password</a>

                        <form action="{{ entity_resource_path() . '/' . $item->id . '/update-disabled' }}"
                              method="POST" class="form form-inline">
                            @csrf
                            {{ method_field('put') }}
                            @if ($item->isEnabled())
                                <button class="btn btn-warning js-tooltip"
                                        name="action" value="disable"
                                        title="Click to Disable"><em class="fa fa-ban"></em> Disable</button>
                            @else
                                <button class="btn btn-warning js-tooltip"
                                        name="action" value="enable"
                                        title="Account Disabled. Click to Enable."><em class="fa fa-check"></em> Enable</button>
                            @endif
                        </form>
                    </div>
                @endif
            </td>
            <td>
                @if (!$item->isMySelf())
                    <form action="{{ entity_resource_path() . '/' . $item->id }}"
                          method="POST" class="form form-inline js-confirm">
                        {{ method_field('delete') }}
                        @csrf
                        <button class="btn btn-danger js-tooltip"
                                title="PERMANENTLY DELETE. THIS CANNOT BE REVERSED!"><em class="fa fa-times"></em> Delete</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
@stop