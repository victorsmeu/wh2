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
                </a> 
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
                                    <a href='{{ url('/reports/' . $report->id) }}' class='btn btn-primary btn-sm'>View Report</a>
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
                    <a href='{{ url('/studies/decline/' . $study->id) }}' class='btn btn-warning  btn-sm'>Decline</a>
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
                    <a href='{{ url('/reports/create/' . $study->id) }}' class='btn btn-primary'>Write Report</a>
                @endif
            @endif
        </div>
        <div class="panel-footer">
            @if ($study->user->id === Auth::user()->id)
            <a class='btn btn-primary' data-placement="top" data-toggle="modal" data-target="#inviteMedic">Invite medic</a>
            &nbsp; 
            @endif
            <a href='{{ url('/studies/view/' . $study->id . '/1') }}' class='btn btn-default btn-circle' data-placement="top" data-toggle="tooltip" title='View with Weasys'>W</a>
            <a href='{{ url('/studies/view/' . $study->id . '/2') }}' class='btn btn-default btn-circle' data-placement="top" data-toggle="tooltip" title='View with Osirix'>O</a>
            <a href='{{ url('/studies/view/' . $study->id . '/3') }}' class='btn btn-default btn-circle' data-placement="top" data-toggle="tooltip" title='View with Oviam'>O</a>
            <a href='{{ url('/studies/view/' . $study->id . '/4') }}' class='btn btn-default btn-circle pull-right' data-placement="top" data-toggle="tooltip" title='Download'><i class='fa fa-download'></i></a>
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