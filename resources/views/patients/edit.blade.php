@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ trans('Edit patient') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::model($patient, [
                'method' => 'PUT',
                'route' => ['patients.update', $patient->id]
            ]) !!}
            @include('patients/form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection