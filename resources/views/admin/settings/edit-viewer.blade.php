@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ trans('Edit viewer') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::model($viewer, [
                'method' => 'PUT',
                'route' => ['admin.settings.update-viewer', $viewer->id]
            ]) !!}
            @include('admin/settings/form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection