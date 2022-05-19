@extends('oxygen::layouts.master-dashboard')

@section('content')
    {{ lotus()->pageHeadline('Dashboard') }}


    {{ lotus()->emptyStatePanel('Welcome to ' . config('app.name'), 'Today is ' . now()->format(config('oxygen.dateFormat'))) }}

    @if ($metrics->count())
        <div class="row mt-4">
            @foreach ($metrics as $metric)
                <div class="col">
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">{{ $metric['title'] }}</h5>
                            <h3>{{ number_format($metric['count']) }}</h3>
                            <p class="card-text">{{ $metric['description'] }}</p>
                            @if (!empty($metric['route']))
                                <a href="{{ route($metric['route']) }}" class="card-link">View Details</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@stop
