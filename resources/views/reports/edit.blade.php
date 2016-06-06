@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ trans('Edit report') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::model($report, [
                'method' => 'POST',
                'route' => ['reports.update', $report->id]
            ]) !!}
            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}

                @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-btn fa-user"></i> &nbsp; Submit
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('footer_js')
@include('layouts/common/tinymce')
@endsection