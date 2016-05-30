@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Patient EHR</h1>
        </div>

        <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <li class="active"><a  href="#first">First Diagnostic</a></li>
                <li><a  href="#reason">Reason for Investigation</a></li>
                <li><a  href="#medical">Medical History</a></li>
                <li><a  href="#physical">Physical Exploration</a></li>
                <li><a  href="#analysis">Lab Analysis</a></li>
                <li><a  href="#imaging">Imaging</a></li>
                <li><a  href="#current">Current Treatment</a></li>
            </ul>

            <div class="tab-content">
                <div id="first" class="tab-pane fade in active">
                    <h3>First Diagnostic</h3>
                    <div class='col-lg-12'>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Content
                            </div>
                            <div class="panel-body">
                                {!! Form::model($patientData['first_diagnostic'], [
                                    'method' => 'POST',
                                    'route' => ['patient-data.update', $patient_id],
                                    'class' => 'input_form'
                                ]) !!}
                                @include('patient/ehr/form-input', ['label' => 'first_diagnostic'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Documents
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['route' => ['patient-data.upload', $patient_id], 
                                                'class' => 'form', 
                                                'novalidate' => 'novalidate', 
                                                'files' => true]) !!}
                                @include('patient/ehr/form-upload', 
                                    ['label' => 'first_diagnostic_file', 
                                     'files' => $patientData['first_diagnostic_file']
                                     ])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="reason" class="tab-pane fade">
                    <h3>Reason for Investigation</h3>
                    <div class='col-lg-12'>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Content
                            </div>
                            <div class="panel-body">
                                {!! Form::model($patientData['reason_for_investigation'], [
                                    'method' => 'POST',
                                    'route' => ['patient-data.update', $patient_id],
                                    'class' => 'input_form'
                                ]) !!}
                                @include('patient/ehr/form-input', ['label' => 'reason_for_investigation'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Documents
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['route' => ['patient-data.upload', $patient_id], 
                                                'class' => 'form', 
                                                'novalidate' => 'novalidate', 
                                                'files' => true]) !!}
                                @include('patient/ehr/form-upload', 
                                    ['label' => 'reason_for_investigation_file', 
                                     'files' => $patientData['reason_for_investigation_file']
                                     ])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="medical" class="tab-pane fade">
                    <h3>Medical History</h3>
                    <div class='col-lg-12'>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Content
                            </div>
                            <div class="panel-body">
                                {!! Form::model($patientData['medical_history'], [
                                    'method' => 'POST',
                                    'route' => ['patient-data.update', $patient_id],
                                    'class' => 'input_form'
                                ]) !!}
                                @include('patient/ehr/form-input', ['label' => 'medical_history'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Documents
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['route' => ['patient-data.upload', $patient_id], 
                                                'class' => 'form', 
                                                'novalidate' => 'novalidate', 
                                                'files' => true]) !!}
                                @include('patient/ehr/form-upload', 
                                    ['label' => 'medical_history_file', 
                                     'files' => $patientData['medical_history_file']
                                     ])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="physical" class="tab-pane fade">
                    <h3>Physical Exploration</h3>
                    <div class='col-lg-12'>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Content
                            </div>
                            <div class="panel-body">
                                {!! Form::model($patientData['physical_exploration'], [
                                    'method' => 'POST',
                                    'route' => ['patient-data.update', $patient_id],
                                    'class' => 'input_form'
                                ]) !!}
                                @include('patient/ehr/form-input', ['label' => 'physical_exploration'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Documents
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['route' => ['patient-data.upload', $patient_id], 
                                                'class' => 'form', 
                                                'novalidate' => 'novalidate', 
                                                'files' => true]) !!}
                                @include('patient/ehr/form-upload', 
                                    ['label' => 'physical_exploration_file', 
                                     'files' => $patientData['physical_exploration_file']
                                     ])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div id="analysis" class="tab-pane fade">
                    <h3>Lab Analysis</h3>
                    <div class='col-lg-12'>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Content
                            </div>
                            <div class="panel-body">
                                {!! Form::model($patientData['lab_analysis'], [
                                    'method' => 'POST',
                                    'route' => ['patient-data.update', $patient_id],
                                    'class' => 'input_form'
                                ]) !!}
                                @include('patient/ehr/form-input', ['label' => 'lab_analysis'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Documents
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['route' => ['patient-data.upload', $patient_id], 
                                                'class' => 'form', 
                                                'novalidate' => 'novalidate', 
                                                'files' => true]) !!}
                                @include('patient/ehr/form-upload', 
                                    ['label' => 'lab_analysis_file', 
                                     'files' => $patientData['lab_analysis_file']
                                     ])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                    
                <div id="imaging" class="tab-pane fade">
                    <h3>Imaging</h3>
                    <p>?</p>
                </div>
                    
                <div id="current" class="tab-pane fade">
                    <h3>Current Treatment</h3>
                    <div class='col-lg-12'>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Content
                            </div>
                            <div class="panel-body">
                                {!! Form::model($patientData['current_treatment'], [
                                    'method' => 'POST',
                                    'route' => ['patient-data.update', $patient_id],
                                    'class' => 'input_form'
                                ]) !!}
                                @include('patient/ehr/form-input', ['label' => 'current_treatment'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Documents
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['route' => ['patient-data.upload', $patient_id], 
                                                'class' => 'form', 
                                                'novalidate' => 'novalidate', 
                                                'files' => true]) !!}
                                @include('patient/ehr/form-upload', 
                                    ['label' => 'current_treatment_file', 
                                     'files' => $patientData['current_treatment_file']
                                     ])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('footer_js')
<script src="{{ url('/js') }}/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: 'textarea',
  height: 300,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  menubar: false,
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});

$(function(){
  var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');
  
  var new_action = '{{ url('/patients/ehr/' . $patient_id) }}' + hash;
  $('form.input_form').attr('action', new_action);
  
  var new_action = '{{ url('/patients/ehr/upload/' . $patient_id) }}' + hash;
  $('form.form').attr('action', new_action);

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop() || $('html').scrollTop();
    window.location.hash = this.hash;

    var new_action = '{{ url('/patients/ehr/' . $patient_id) }}' + this.hash;
    $('form.input_form').attr('action', new_action);
    
    var new_action = '{{ url('/patients/ehr/upload/' . $patient_id) }}' + this.hash;
    $('form.form').attr('action', new_action);
    
    $('html,body').scrollTop(scrollmem);
  });
});
</script>
@endsection
