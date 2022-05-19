@extends('oxygen::layouts.master-dashboard')

@section ('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Games', route('manage.games.index')],
        ['Game', null, true]
    ]) }}

    <h2>{{ $game->game_type_name }}</h2>

    <div class="row mb-5">
        <div class="col">
            @if ($game->starts_at)
                {{ standard_datetime($game->starts_at) }}
            @endif
            {{ $game->formatted_address }}
        </div>
        <div class="col text-right">
            @if ($game->status_name)
                Game Status: {{ $game->status_name }}
            @endif
        </div>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Team</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    In progress...
                {{-- Update the table --}}
                </td>
            </tr>
        </tbody>
    </table>
@stop
