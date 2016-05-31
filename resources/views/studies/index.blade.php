@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Studies</h1>
        </div>
        
        <div class="row">
            @if (count($studies) > 0)
                <div class="col-lg-12 col-sm-12">
                    @foreach ($studies as $study)
                    <div class='col-md-4 col-sm-6'>
                        <div class="panel @if(!$study->accepted && $study->user_id != Auth::user()->id) panel-green @else panel-info @endif">
                            <div class="panel-heading">
                                {{ $study->study_name }} 
                                @if (!empty($study->specialty->term)) 
                                   /  {{ $study->specialty->term }}
                                @endif
                                @if(!$study->accepted && $study->user_id != Auth::user()->id)
                                <a href='' class='btn btn-primary  btn-xs pull-right'>Accept</a>
                                @endif
                            </div>
                            <div class="panel-body">
                                <p><b>Added by:</b> {{ $study->user->first_name }} {{ $study->user->last_name }} [{{ $study->user->role->name }}]</p>
                                <p><b>At:</b> {{ $study->user->created_at }}</p>
                                <p><b>Patient:</b> {{ $study->patient->first_name }} {{ $study->patient->last_name }}</p>
                                <p><a href='{{ url('/patients/ehr/' . $study->patient_id) }}' class='btn btn-default'>View patient EHR</a></p>
                                <hr />
                                <p><b>Study data</b></p>
                                <p>Institution: {{ $study->institution }}, Body Part: {{ $study->bodyPart }}, Created: {{ $study->creationDate }}</p>
                                <hr />
                                <p>{{ $study->description }}</p>
                            </div>
                            <div class="panel-footer">
                                @if ($study->user->id === Auth::user()->id)
                                <a class='btn btn-primary' data-placement="top" data-toggle="modal" data-target="#inviteMedic">Invite medic</a>
                                &nbsp; 
                                @endif
                                <a class='btn btn-default btn-circle' data-placement="top" data-toggle="tooltip" title='View with Weasys'>W</a>
                                <a class='btn btn-default btn-circle' data-placement="top" data-toggle="tooltip" title='View with Osirix'>O</a>
                                <a class='btn btn-default btn-circle' data-placement="top" data-toggle="tooltip" title='View with Oviam'>O</a>
                                <a class='btn btn-default btn-circle pull-right' data-placement="top" data-toggle="tooltip" title='Download'><i class='fa fa-download'></i></a>
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
                </div>
            </div>
            <div class="col-lg-12"><hr /></div>
            @endif
        </div>
        <div class='row'>
            <div class="col-lg-12">
                <a href='{{ url('/studies/create') }}' class='btn btn-primary'>Upload new Medical Study</a>
            </div>
        </div>
    </div>
@endsection