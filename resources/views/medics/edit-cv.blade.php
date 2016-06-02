@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit CV</h1>
        </div>

        <div class="col-lg-12">
            {!! Form::model($medicData, [
                'method' => 'PUT',
                'route' => ['medics.update', $user_id],
                'files' => true
            ]) !!}

            <div class="form-group col-lg-12">
                <div class='col-md-2{{ $errors->has('cv_file') ? ' has-error' : '' }}'>
                    {!! Form::label('cv_file', 'Upload CV:') !!}
                    {!! Form::file('cv_file', null) !!}
                    @if ($errors->has('cv_file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cv_file') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group col-lg-12">
                <div class='col-md-2{{ $errors->has('image') ? ' has-error' : '' }}'>
                    {!! Form::label('image', 'Upload photo:') !!}
                    {!! Form::file('image', null) !!}
                    @if ($errors->has('image'))
                        <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group col-lg-12">
                <div class='col-md-2{{ $errors->has('signature') ? ' has-error' : '' }}'>
                    {!! Form::label('signature', 'Upload signature:') !!}
                    {!! Form::file('signature', null) !!}
                    @if ($errors->has('signature'))
                        <span class="help-block">
                            <strong>{{ $errors->first('signature') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group col-lg-12">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>

            {!! Form::close() !!}
        </div>

    </div>
@endsection