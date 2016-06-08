@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ trans('Add patient') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::open( array( 'route' => ['patients.store'], 'role' => 'form' ) ) !!}
            @include('patients/form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection