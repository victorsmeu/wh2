@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Welcome to WebHippocrates
                    </div>
                    <div class="panel-body">
                        <h2>Getting started</h2>
                        <p>What are the next steps after your account has been created?</p>
                        <br />
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading" data-target="#addingPatient" data-toggle="modal" style='cursor:pointer;'>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user-plus fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Step 1</div>
                                            <div>Add a new patient</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ url('/patients/create') }}">
                                    <div class="panel-footer">
                                        <span class="pull-left">Click to add patient</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                            <div id='addingPatient' class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
                                            <h4 id="myModalLabel" class="modal-title">Adding patients</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Whenever you want to upload a study, it must be linked with a patient.</p>
                                <p>In order for a medic to better understand the study, the patient should have as many information
                                    attached to his or her EHR</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading" data-target="#addingStudy" data-toggle="modal" style='cursor:pointer;'>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-heartbeat fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Step 2</div>
                                            <div>Upload study</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ url('/patients/create') }}">
                                    <div class="panel-footer">
                                        <span class="pull-left">Click to upload a study</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                            <div id='addingStudy' class="modal fade" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
                                            <h4 id="myModalLabel" class="modal-title">Adding studies</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>To add a study, you will be asked to select the patient for which the study has been made.</p>
                                            <p>Put the DVD or stick containing the study in it's drive and select the folder containing the files.
                                                This will only work with Chrome browser.</p>
                                            <p>The study contains some additional data about the patient and will be shown in the study details</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Events
                    </div>
                    <div class="panel-body">
                        <p>No new events.</p>
                    </div>
                </div>
            </div>
    </div>
@endsection
