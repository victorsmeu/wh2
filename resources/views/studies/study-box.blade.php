@foreach ($studies as $study)
<div class='col-lg-4 col-md-6 col-sm-6'>
    <div class="panel panel-info">
        <div class="panel-heading">
            {{ $study->study_name }} 
            @if (!empty($study->specialty->term)) 
               /  {{ $study->specialty->term }}
            @endif
        </div>
        <div class="panel-body">
            <p>
                <b>Patient:</b> 
                <a href='{{ url('/patients/ehr/' . $study->patient_id . '/view') }}' data-placement='top' data-toggle='tooltip' title='View patient EHR'>
                    {{ $study->patient->first_name }}  {{ $study->patient->last_name }}
                </a> &nbsp;
                @if($study->accepted != 1) 
                <button class='btn btn-default btn-xs' id='add_patient' data-target="#myModal" data-toggle="modal">Change Patient</button>
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" 
                     class="modal fade 
                     @if ($errors->has('patient_id')) in" style="display: block;"
                     @else " style="display: none;"
                     @endif
                     >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
                                <h4 id="myModalLabel" class="modal-title">Change Patient</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-lg-12">
                                    {!! Form::open( array( 'route' => ['studies.update', $study->id], 'role' => 'form' ) ) !!}
                                    <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : '' }}">
                                        {!! Form::label('patient_id', 'Patient:', ['class' => 'control-label']) !!}
                                        {!! Form::select('patient_id', $arrayPatients, null, ['class' => 'form-control']) !!}

                                        @if ($errors->has('patient_id'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('patient_id') }}</strong>
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
                                <div class="clear"></div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                @endif
            </p>
            <hr />
            <p><b>Study data</b></p>
            <p>Institution: {{ $study->institution }}, Body Part: {{ $study->bodyPart }}, Created: {{ $study->creationDate }}</p>
            <p>{{ $study->description }}</p>
            <hr />
            <p><b>Invitations/Reports:</b></p>
            @if($type == 'myStudies')
                @if(isset($study->study_users) && count($study->study_users) > 0)
                    @foreach($study->study_users as $user)
                    <p>
                        {{ $user->user->first_name }} {{ $user->user->last_name }} <small>({{ $user->invited_at }})</small>
                        @if($user->accepted === 1) 
                        <span class="text-success">Accepted</span><br />
                        @if(isset($study->reports) && count($study->reports) > 0)
                            @foreach($study->reports as $report)
                                @if($report->user_id == $user->user_id)
                                    <a href='{{ url('/reports/' . $report->id) }}' class='btn btn-default btn-sm'>View Report</a>
                                @endif
                            @endforeach
                        @endif
                        @else
                        <span class='text-warning'>Not yet accepted</span>
                        @endif
                    </p>
                    @endforeach
                @else
                <p>No invitations sent yet</p>
                @endif
            @else
            <p><b>Status: </b>
                @if($study->accepted === 1) 
                    <span class="text-success">Accepted</span>
                @elseif(!isset($study->accepted)) 
                    <a href='{{ url('/studies/accept/' . $study->id) }}' class='btn btn-primary  btn-sm'>Accept</a>
                    <a href='{{ url('/studies/decline/' . $study->id) }}' class='btn btn-danger  btn-sm'>Decline</a>
                @else
                    <span class='text-warning'>Declined</span>
                    <a href='{{ url('/studies/accept/' . $study->id) }}' class='btn btn-primary  btn-sm pull-right'>Accept</a>
                @endif
            </p>
                @if(isset($study->reports) && count($study->reports) > 0)
                    @foreach($study->reports as $report)
                        @if($report->user_id == Auth::user()->id)
                            <a href='{{ url('/reports/' . $report->id) }}' class='btn btn-primary btn-sm'>View Report</a>
                        @endif
                    @endforeach
                @else
                    <a href='{{ url('/reports/create/id/' . $study->patient_id . '/study/' . $study->id) }}' class='btn btn-success'>Write Report</a>
                @endif
            @endif
        </div>
        <div class="panel-footer">
            @if ($study->user->id === Auth::user()->id)
            <a class='btn btn-primary' data-placement="top" data-toggle="modal" data-target="#inviteMedic">Invite medic</a>
            &nbsp; 
            @endif
            View: 
            @foreach($viewers as $viewer)
            @if($viewer->id != 4)
            <a href='{{ url('/studies/view/' . $study->id . '/' . $viewer->id) }}' class='btn btn-default btn-circle' data-placement="top" data-toggle="tooltip" title='View with {{ $viewer->label }}'><i class='fa fa-television'></i></a>
            @else
            <a href='{{ url('/studies/view/' . $study->id . '/4') }}' class='btn btn-default btn-circle pull-right' data-placement="top" data-toggle="tooltip" title='Download'><i class='fa fa-download'></i></a>
            @endif
            @endforeach
        </div>
    </div>
</div>
<div id="inviteMedic" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Invite medic to view study</h4>
            </div>
            <div class="modal-body">
                {!! Form::open( array( 'route' => ['studies.invite'], 'role' => 'form' ) ) !!}
                <input type='hidden' name="study_id" value="{{ $study->id }}" />
                <div class="form-group">
                    <label>Select a medic</label>
                    <select class="form-control" name="user_id">
                        <option value=''>- select -</option>
                        @foreach ($medics[$study->specialty_id] as $medic)
                            @if ($medic->id !== Auth::user()->id)
                            <option value='{{ $medic->id }}'>{{ $medic->first_name }} {{ $medic->last_name }} </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Send invitation</button>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach