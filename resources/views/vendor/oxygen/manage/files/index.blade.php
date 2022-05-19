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

    <a href="{{ entity_resource_path() . '/create' }}" class="btn btn-success"><em class="fas fa-plus-circle"></em> Add New</a>
@stop

@section('content')
    @include('oxygen::dashboard.partials.table-allItems', [
        'tableHeader' => [
            'ID', 'Key', 'File', 'Size', 'Uploaded', 'Actions', 'Danger Zone|text-right'
        ]
    ])

    @foreach ($allItems as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>
                {{ $item->name }}
                @if ($item->key)
                    <br>
                    <span class="badge badge-primary">{{ $item->key }}</span>
                @endif
                @if ($item->allow_public_access)
                    <span class="badge badge-success">Public</span>
                @endif
            </td>
            <td>
                {{ $item->original_filename }}
            </td>
            <td>
                @if ($item->file_size_bytes)
                    {{ \EMedia\PHPHelpers\Util\ConvertSizes::bytesToHumans($item->file_size_bytes, $precision = 2) }}
                @endif
            </td>
            <td>
                @if ($item->created_at)
                    {{ standard_datetime($item->created_at) }}
                @endif
            </td>
            <td>
                <span class="btn-spaced">
                @if ($item->file_url)
                        <a href="{{ $item->permalink }}" target="_blank" class="btn btn-success"><i class="fas fa-eye"></i> View</a>
                    @endif

                    @if ($item->file_url)
                        <a href="{{ route('manage.files.download', $item->uuid) }}" target="_blank" class="btn btn-success"><i class="fas fa-download"></i> Download</a>
                    @endif

                    <a href="{{ entity_resource_path() . '/' . $item->id . '/edit' }}"
                       class="btn btn-warning js-tooltip"
                       title="Edit"><em class="fa fa-edit"></em> Edit</a>
                </span>
            </td>
            <td class="text-right">

                @if ($item->isDeleteAllowed())
                    <form action="{{ entity_resource_path() . '/' . $item->id }}"
                          method="POST" class="form form-inline js-confirm">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger js-tooltip"
                                title="Delete"><em class="fa fa-times"></em> Delete</button>
                    </form>
                @endif

            </td>
        </tr>
    @endforeach
@stop