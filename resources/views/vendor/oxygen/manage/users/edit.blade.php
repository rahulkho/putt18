@extends('oxygen::layouts.master-dashboard')

@section ('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Manage Users', route('manage.users.index')],
        [$pageTitle, null, true]
    ]) }}

    <form action="{{ entity_resource_path() }}" method="post" class="form-horizontal">
        @csrf

        @if ($entity->id)
            {{ method_field('put') }}
            <input type="hidden" name="id" value="{{ $entity->id }}" />
        @endif

        {!! $form->render() !!}
        {!! $form->renderSubmit() !!}
    </form>
@stop