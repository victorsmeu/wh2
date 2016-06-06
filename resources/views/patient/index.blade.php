@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Patients</h1>
        </div>
        @if (count($patients) > 0)
            <div class="col-lg-12">
                <div id='no-more-tables'>
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>Pacient Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th width="40%">&nbsp;</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($patients as $patient)
                            <tr>
                                <td class="table-text"  data-title='Pacient Name'>
                                    {{ $patient->first_name }} {{ $patient->last_name }}
                                </td>
                                <td  data-title='Gender'>
                                    {{ $patient->gender }}
                                </td>
                                <td  data-title='Age'>
                                    {{ $patient->age }}
                                </td>
                                <td style="text-align:right; padding: 8px;">
                                    <a href="{{ url('/patients/ehr/' . $patient->id) }}" class="btn btn-default btn-sm">
                                        <i class="fa fa-eye fa-fw"></i> View EHR
                                    </a>
                                    <a href="{{ url('/patients/' . $patient->id . '/edit') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit fa-fw"></i> Edit
                                    </a>
                                    {!! Form::open(array('route' => array('patients.destroy', $patient->id), 'method' => 'delete', 'style' => 'display:inline-block;')) !!}
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary"  href="{{ url('/patients/create') }}">{{ trans('Add patient') }}</a>
        </div>
    </div>
@endsection