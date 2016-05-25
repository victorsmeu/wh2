@extends('layouts.app')

@section('content')
    <script>
    $(document).ready(function() {
        if($(".set_button").length) {
            $(".set_button").click(function(e) {
                e.preventDefault();
                if($("#password").attr("disabled")) {
                    $("#password").removeAttr("disabled");
                    $(".set_button").text("block");
                } else {
                    $("#password").attr("disabled", "disabled");
                    $(".set_button").text("set");
                }
            });
        }  
    });
    </script>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ trans('Edit patient') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::model($user, [
                'method' => 'PUT',
                'route' => ['users.update', $user->id]
            ]) !!}
            @include('user/form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection