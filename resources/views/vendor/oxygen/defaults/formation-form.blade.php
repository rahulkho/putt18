@extends('oxygen::layouts.master-dashboard')

@section ('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    <form action="{{ entity_resource_path() }}" method="post" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

        @if ($entity->id)
            {{ method_field('put') }}
            <input type="hidden" name="id" value="{{ $entity->id }}" />
        @endif

        {!! $form->render() !!}
        {!! $form->renderSubmit() !!}
    </form>
@stop