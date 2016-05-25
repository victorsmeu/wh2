@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ trans('Add user') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::open( array( 'route' => ['users.store'], 'role' => 'form' ) ) !!}
            @include('user/form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection