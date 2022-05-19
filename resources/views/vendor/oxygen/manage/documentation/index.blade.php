@extends('oxygen::layouts.master-dashboard')

@section('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        [$pageTitle, null, true]
    ]) }}

    @if (!env('API_ACTIVE', false))
        <div class="mb-3">
            {{ lotus()->emptyStatePanel('API is disabled for this environment.') }}
        </div>
    @else
        @if (empty($paths))
            {{ lotus()->emptyStatePanel('No content defined. Ensure API files exists to see content.') }}
        @else
            <table class="table table-hover">
                <tbody>
                @foreach ($apiKeys as $apiKey)
                    <tr>
                        <td>API KEY</td>
                        <td class="text-right">
                            <code>{{ $apiKey }}</code>
                        </td>
                    </tr>
                @endforeach
                @foreach ($paths as $path)
                    <tr>
                        <td>
                            <div class="row-title">{{ $path['name'] }}</div>
                            @if (!empty($path['description']))
                                <span class="muted">{{ $path['description'] }}</span>
                            @endif
                        </td>
                        <td width="20%">
                            <a class="btn btn-primary btn-block" href="{{ $path['file_path'] }}?rev={{ mt_rand(500, 50000) }}" target="_blank">
                                <i class="fas fa-external-link-alt"></i> View
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    @endif

@stop