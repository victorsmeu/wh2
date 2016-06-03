@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit CV</h1>
        </div>
        
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Upload CV
                </div>
                <div class="panel-body">
                    <div class='cv_edit_container'>
                        @if(isset($medicData['cv_file']['info']))
                        <a href='{{ url('/get-medic-file/' . $medicData['cv_file']['user_id'] . '/' . $medicData['cv_file']['id']) }}'>
                            <i class='fa fa-file-pdf-o'></i>
                        </a>
                        @else 
                        <i class='fa fa-minus-square-o'></i>
                        @endif
                    </div>
                    {!! Form::model($medicData['cv_file'], [
                        'method' => 'POST',
                        'route' => ['medics.update', $user_id],
                        'files' => true
                    ]) !!}
                    {!! Form::hidden('type', 'cv_file') !!}
                    {!! Form::label('cv_file', 'Upload CV:') !!}
                    {!! Form::file('cv_file', null) !!}
                    @if ($errors->has('cv_file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cv_file') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Upload Photo
                </div>
                <div class="panel-body">
                    <div class='cv_edit_container'>
                        @if(isset($medicData['image']['info']))
                        <img src='{{ url('/get-medic-image/' . $medicData['image']['user_id'] . '/' . $medicData['image']['id']) }}' />
                        @else 
                        <i class='fa fa-minus-square-o'></i>
                        @endif
                    </div>
                    {!! Form::model($medicData['image'], [
                        'method' => 'POST',
                        'route' => ['medics.update', $user_id],
                        'files' => true
                    ]) !!}
                    {!! Form::hidden('type', 'image') !!}
                    {!! Form::label('image', 'Upload your Photo:') !!}
                    {!! Form::file('image', null) !!}
                    @if ($errors->has('image'))
                        <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Upload Signature
                </div>
                <div class="panel-body">
                    <div class='cv_edit_container'>
                        @if(isset($medicData['signature']['info']))
                        <img src='{{ url('/get-medic-image/' . $medicData['signature']['user_id'] . '/' . $medicData['signature']['id']) }}' />
                        @else 
                        <i class='fa fa-minus-square-o'></i>
                        @endif
                    </div>
                    {!! Form::model($medicData['signature'], [
                        'method' => 'POST',
                        'route' => ['medics.update', $user_id],
                        'files' => true
                    ]) !!}
                    {!! Form::hidden('type', 'signature') !!}
                    {!! Form::label('signature', 'Upload signature:') !!}
                    {!! Form::file('signature', null) !!}
                    @if ($errors->has('signature'))
                        <span class="help-block">
                            <strong>{{ $errors->first('signature') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection