@extends('layouts.frontend')

@section('content')
<div class="col-md-10 col-md-offset-1">
    <br />
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('welcome.Welcome') }}</div>

        <div class="panel-body">
            {{ trans('welcome.Landing page') }}
        </div>
    </div>
</div>
@endsection
