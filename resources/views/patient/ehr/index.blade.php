@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Patient EHR</h1>
        </div>

        <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#first">First Diagnostic</a></li>
                <li><a data-toggle="tab" href="#reason">Reason for Investigation</a></li>
                <li><a data-toggle="tab" href="#medical">Medical History</a></li>
                <li><a data-toggle="tab" href="#physical">Physical Exploration</a></li>
                <li><a data-toggle="tab" href="#analysis">Lab Analysis</a></li>
                <li><a data-toggle="tab" href="#imaging">Imaging</a></li>
                <li><a data-toggle="tab" href="#current">Current Treatment</a></li>
            </ul>

            <div class="tab-content">
                <div id="first" class="tab-pane fade in active">
                    <h3>First Diagnostic</h3>
                    <p>Some content.</p>
                </div>
                <div id="reason" class="tab-pane fade">
                    <h3>Reason for Investigation</h3>
                    <p>Some content in menu 1.</p>
                </div>
                <div id="medical" class="tab-pane fade">
                    <h3>Medical History</h3>
                    <p>Some content in menu 2.</p>
                </div>
                <div id="physical" class="tab-pane fade">
                    <h3>Physical Exploration</h3>
                    <p>Some content in menu 2.</p>
                </div>
                <div id="analysis" class="tab-pane fade">
                    <h3>Lab Analysis</h3>
                    <p>Some content in menu 2.</p>
                </div>
                <div id="imaging" class="tab-pane fade">
                    <h3>Imaging</h3>
                    <p>Some content in menu 2.</p>
                </div>
                <div id="current" class="tab-pane fade">
                    <h3>Current Treatment</h3>
                    <p>Some content in menu 2.</p>
                </div>
            </div>
        </div>

    </div>
@endsection