@extends('oxygen::layouts.master-dashboard')

@section('content')
    <div class="container-fluid">
        <div class="title-container">
            <div class="page-title">
                <h1>
                    @if ($item->id)
                        Edit Permission Group - {{ $item->name }}
                    @else
                        Add Permission Group
                    @endif
                </h1>
            </div>
        </div>

        <div class="panel panel-default" id="app">
            <div class="panel-heading">
                {{ ($item->id)? 'Edit': 'Add' }} Permission
            </div>
            <div class="panel-body">
                <form action="{{ entity_resource_path() }}" method="POST" class="form form-horizontal">
                    {{ csrf_field() }}
                    @if ($item->id)
                        {{ method_field('put') }}
                    @endif

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Group Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"
                                   name="name"
                                   value="{{ $item->name }}">
                        </div>
                    </div>

                    {{-- // TODO: EFF: can this block for entity be extracted? --}}

                    {{-- Edit default_categories JSON --}}
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Default Abilities</label>
                        <div class="col-sm-10">
                            <json-list-editor v-bind:json-string="'{{ $item->default_abilities }}'"
                                         :name="'default_abilities'"></json-list-editor>
                        </div>
                    </div>

                    {{-- Edit existing categories --}}
                    <div class="form-group">
                    	<label for="" class="col-sm-2 control-label">Existing Permissions</label>
                    	<div class="col-sm-10">
                            <json-key-value-editor v-bind:json-string="'{{ $item->abilities }}'"
                                             :key-name="'name'"
                                             :value-name="'title'"
                                             :id-field-name="'permission::id'"
                                             :key-field-name="'permission::name'"
                                             :value-field-name="'permission::title'"
                            ></json-key-value-editor>
                    	</div>
                    </div>

                    @include('oxygen::partials.loading.angular-loading')

                    @push('scripts')
                        <script>
                            var pageFunctions = function () {
                                var app = new Vue({ el: '#app' });
                            };
                            $(document).ready(pageFunctions);
                        </script>
                    @endpush

                    <hr>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-lg btn-wide btn-success">Save</button>
                            <a href="{{ url()->previous() }}" class="btn btn-lg btn-wide btn-default pull-right">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection


