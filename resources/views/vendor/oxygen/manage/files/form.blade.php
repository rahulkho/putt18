@extends('oxygen::layouts.master-dashboard')

@section ('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Manage Files', route('manage.files.index')],
        [$pageTitle, null, true]
    ]) }}

    <div class="card">
        <div class="card-header">
            Upload File
            @if ($entity->original_filename)
                - <strong>{{ $entity->original_filename }}</strong>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ entity_resource_path() }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

                @if ($entity->id)
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="{{ $entity->id }}" />
                @else
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-right">File Type</label>
                        <div class="col-sm-10">
                            {{ Form::select('key', $fileKeys, $selectedKey, ['class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-right">Custom Key</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="custom_key" name="custom_key" value="{{ $entity->custom_key }}">
                            <small id="currentPasswordHelpBlock" class="form-text text-muted">
                                (Optional) Add a custom, unique key if not selecting a pre-defined file type. Leave empty to auto-generate.
                            </small>
                        </div>
                    </div>
                @endif

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-right">File</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="file" name="file">
                        <small id="currentPasswordHelpBlock" class="form-text text-muted">
                            Select a file to upload
                        </small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="allow_public_access" class="col-sm-2 col-form-label text-right">Public Access</label>
                    <div class="col-sm-10">
                        {{ Form::checkbox('allow_public_access', 'true', $entity->allow_public_access) }}
                        <small id="allow_public_access" class="form-text text-muted">
                            Should this file have public access?
                        </small>
                    </div>
                </div>

                <hr>
                <div class="form-group row">
                    <div class="col-sm-10 offset-2">
                        <button type="submit" class="btn btn btn-success btn-lg btn-wide ">
                            Upload
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
