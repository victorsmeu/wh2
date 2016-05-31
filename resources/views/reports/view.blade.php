@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">View Report</h1>
        </div>
        <div class="col-lg-12">
            
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Patient: {{ $report->study->patient['first_name'] }} {{ $report->study->patient['last_name'] }}
                    </div>
                    <div class="panel-body">
                        <dl  class="dl-horizontal">                   
                            <dt>Gender</dt>
                            <dd>{{ $report->study->sex }}</dd>
                            <dt>Age</dt>
                            <dd>{{ $report->study->age }}</dd>
                        </dl>
                        <dl  class="dl-horizontal">
                            <dt>Institution</dt>
                            <dd>{{ $report->study->institution }}</dd>
                            <dt>Modality</dt>
                            <dd>{{ $report->study->modality }}</dd>
                            <dt>Body Part</dt>
                            <dd>{{ $report->study->bodyPart }}</dd>
                            <dt>Creation date</dt>
                            <dd>{{ $report->study->creationDate }}</dd>
                        </dl>
                        <hr />
                        <dl>                
                            <dt>Description</dt>
                            <dd>{{ $report->study->description }}</dd>
                        </dl>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            
            <div class='col-lg-8'>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Report
                    </div>
                    <div class="panel-body">
                        <div class="well well-sm">
                            <h5>Written By: {{ $report->user['first_name'] }} {{ $report->user['last_name'] }}</h5>
                            <p>Date added: {{ $report->published_at }}
                        </div>
                        {{ $report->content }}
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
    </div>
@endsection