@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ trans('Add report') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::open([
                'method' => 'POST',
                'route' => ['reports.store']
            ]) !!}
            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                {!! Form::hidden('study_id', $study_id) !!}
                @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default" name='submit' value='draft'>
                    Save Draft
                </button>
                &nbsp;
                <button type="submit" class="btn btn-primary" name='submit' value='publish' onclick='return confirm("Are you sure you want to publish?")'>
                    Publish
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('footer_js')
@include('layouts/common/tinymce')
@endsection