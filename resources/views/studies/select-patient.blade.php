@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Select Patient</h1>
        </div>
        @if (count($medics) > 0)
            @foreach ($medics as $medic)
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-4">
                                    @if(isset($medic->data['image']))
                                    <img class='avatar' src='{{ url('/get-medic-image/' . $medic->data['image']['user_id'] . '/' . $medic->data['image']['id']) }}' />
                                    @else
                                    <i class="fa fa-user-md fa-5x"></i>
                                    @endif
                                </div>
                                <div class="col-xs-8 text-right">
                                    <h4>{{ $medic->first_name }} {{ $medic->last_name }}</h4>
                                    <div>
                                        @foreach($medic->medicSpecialties as $specialty)
                                        <small>{{ $specialty->specialty->term }}</small>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ url('/medic/view-cv/' . $medic->id) }}">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection