@extends('oxygen::layouts.master-backend')

@section ('pageTitle', (empty($pageTitle))? 'Admin Dashboard': $pageTitle)

@section('page-container')
    <div id="page-container" class="admin-page-container">
        <div id="page-container-wrapper" class="row">
            <div id="sidebar" class="dark-container">
                @include('oxygen::dashboard.sidebar')
            </div>
            <div id="page-contents" class="main-page-contents">
                @include('oxygen::partials.flash')

                <div class="container-content">
                    @yield('content')
                </div>

                {{-- Load the page level scripts here if this is a PJAX type request, otherwise load these in the footer --}}
                @if (request()->header('X-PJAX'))
                    @stack('scripts')
                @endif
            </div>
        </div>
    </div>
@stop