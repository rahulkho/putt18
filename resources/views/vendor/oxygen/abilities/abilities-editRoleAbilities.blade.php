@extends('oxygen::layouts.master-dashboard')

<?php $pageTitle = "User Permissions for '{$role->title}'" ?>

@section('content')
        {{ lotus()->pageHeadline($pageTitle) }}

        @include('oxygen::account.access-permissions-breadcrumbs', ['breadcrumbs' =>
            ['User Groups', '/account/groups']
        ])

        <form action="{{ request()->url('') }}" method="POST" class="form">
            {{ method_field('put') }}
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">

                    @foreach ($abilityCategories as $category)
                        <div class="card mb-3">
                            <div class="card-header">{{ $category->name }}</div>
                            <div class="card-body">
                                @foreach($category->abilities as $ability)
                                    <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('abilities[]', $ability->name, in_array($ability->name, $currentAbilities), []) }}
                                            {{ $ability->title }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <button type="submit" class="btn btn-lg btn-wide btn-success">Update</button>

        </form>

@endsection
