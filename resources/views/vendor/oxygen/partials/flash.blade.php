@if (Session::has('alert'))
    <div class="container alert-container">
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <span>{{ Session::get('alert') }}</span>
        </div>
    </div>
@endif

@if (Session::has('success'))
    <div class="container alert-container">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <span><strong>Success</strong> {{ Session::get('success') }}</span>
        </div>
    </div>
@endif

@if (Session::has('status'))
    <div class="container alert-container">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <span>{{ Session::get('status') }} </span>
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="container alert-container">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <strong>Whoops!</strong> There were some problems.<br>
            @if (is_array(Session::get('error')))
                <span>{{ implode(' ', Session::get('error')) }}</span>
            @else
                <span>{{ Session::get('error') }}</span>
            @endif
        </div>
    </div>
@endif

@if (is_countable($errors) && count($errors) > 0)
    <div class="container alert-container">
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
