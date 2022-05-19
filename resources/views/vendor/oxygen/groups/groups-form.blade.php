@if ($mode === 'edit')
<form class="form-horizontal" role="form" method="POST" action="/account/groups/{{ $role->id }}">
    <input type="hidden" name="_method" value="put" />
@else
<form class="form-horizontal" role="form" method="POST" action="/account/groups">
@endif

    {{ csrf_field() }}

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">User Group Name</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="title"
                   value="{{ old('title', $role->title) }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Group Description</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="description"
                   value="{{ old('description', $role->description) }}" placeholder="(optional)">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10 offset-2">
            <button type="submit" class="btn btn btn-success btn-lg btn-wide">
                @if ($mode === 'edit')
                    Update Group
                @else
                    Save Group
                @endif
            </button>
        </div>
    </div>

</form>