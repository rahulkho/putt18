@section('pageMainActions')
    <form action="">
        <div class="row">
            <div class="col-md-8">
                @parent
            </div>
            <div class="col-md-4 input-fields--medium">

                {{--<div class="input-group mb-3">--}}
                    {{--<input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">--}}
                    {{--<div class="input-group-append">--}}
                        {{--<span class="input-group-text" id="basic-addon2">@example.com</span>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search" value="{{ request('q') }}">
                    <span class="input-group-append">
                        <button class="btn btn-success" type="submit">Search</button>
                    </span>
                </div>
            </div>
        </div>
    </form>
@stop