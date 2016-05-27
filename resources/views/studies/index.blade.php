@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Studies</h1>
        </div>
        @if (count($studies) > 0)
            <div class="col-lg-12">
                @foreach ($studies as $study)
                <div class='col-md-4'>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            {{ $study->study_name }} 
                            @if (!empty($study->specialty->term)) 
                               /  {{ $study->specialty->term }}
                            @endif
                        </div>
                        <div class="panel-body">
                            <p><b>Added by:</b> {{ $study->user->first_name }} {{ $study->user->last_name }} [{{ $study->user->role->name }}]</p>
                            <p><b>At:</b> {{ $study->user->created_at }}</p>
                            <p><b>Patient:</b> {{ $study->patient->first_name }} {{ $study->patient->last_name }}</p>
                            <p><b>Upload Status:</b> {{ $study->upload_status }}</p>
                            <hr />
                            <p><b>Study data</b></p>
                            <p>Institution: {{ $study->institution }}, Body Part: {{ $study->bodyPart }}, Created: {{ $study->creationDate }}</p>
                            <hr />
                            <p>{{ $study->description }}</p>
                        </div>
                        <div class="panel-footer">
                            <a class='btn btn-default btn-circle' data-placement="top" data-toggle="tooltip" title='View with Weasys'>W</a>
                            <a class='btn btn-default btn-circle' data-placement="top" data-toggle="tooltip" title='View with Osirix'>O</a>
                            <a class='btn btn-default btn-circle' data-placement="top" data-toggle="tooltip" title='View with Oviam'>O</a>
                            <a class='btn btn-default btn-circle pull-right' data-placement="top" data-toggle="tooltip" title='Download'><i class='fa fa-download'></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection