@extends('oxygen::layouts.master-dashboard')

@section('breadcrumbs')
    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        // ['Change The Resource Name', route('<change here>')],
        [$pageTitle, null, true]
    ]) }}
@stop

@section('pageMainActions')
    @include('oxygen::dashboard.partials.searchField')

{{--    <a href="{{ entity_resource_path() . '/create' }}" class="btn btn-success"><em class="fas fa-plus-circle"></em> Add New</a>--}}
@stop

{{-- DELETE THIS IF NOT USED
@section('pageSummary')
    <div>Content to be inserted at the bottom of the page</div>
@stop
 --}}

@section('content')
    @include('oxygen::dashboard.partials.table-allItems', [
        'tableHeader' => [
            'ID', 'Name', 'Change|text-right', 'Actions|text-right'
        ]
    ])

    @foreach ($allItems as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                @if ($player = $item->player)
                    @if ($player->user)
                        {{ $player->user->full_name }}
                    @else
                        {{ $player->guest_name }} [GUEST]
                    @endif
                @endif
            </td>
            <td class="text-right">
                {{ $item->movement }}
            </td>
            <td>
                @if ($item->created_at)
                    {{ standard_datetime($item->created_at) }}
                @endif
            </td>
            <td class="text-right">
                <div class="btn-spaced">
                    {{--<a href="{{ entity_resource_path() . '/' . $item->id . '/edit' }}"--}}
                    {{--   class="btn btn-warning js-tooltip"--}}
                    {{--   title="Edit"><em class="fa fa-edit"></em> Edit</a>--}}

                    {{--
                    <form action="{{ entity_resource_path() . '/' . $item->id }}"
                          method="POST" class="form form-inline">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="is_completed" value="{{ $item->is_completed }}" />
                        @if ($item->is_completed)
                            <button class="btn btn-info js-tooltip"
                                    title="Mark as Pending"><em class="fa fa-hourglass-half"></em></button>
                        @else
                            <button class="btn btn-success js-tooltip"
                                    title="Mark as Complete"><em class="fa fa-check"></em></button>
                        @endif
                    </form>
                    --}}

                    @if (isset($isDestroyingEntityAllowed) && $isDestroyingEntityAllowed === true)
                        <form action="{{ entity_resource_path() . '/' . $item->id }}"
                              method="POST" class="form form-inline js-confirm">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger js-tooltip"
                                    title="Delete"><em class="fa fa-times"></em> Delete</button>
                        </form>
                    @endif

                </div>
            </td>
        </tr>
    @endforeach
@stop
