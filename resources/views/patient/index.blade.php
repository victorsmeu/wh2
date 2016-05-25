@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Patients</h1>
        </div>
        @if (count($patients) > 0)
            <div class="col-lg-12">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Pacient Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($patients as $patient)
                        <tr>
                            <td class="table-text">
                                {{ $patient->first_name }} {{ $patient->last_name }}
                            </td>
                            <td>
                                {{ $patient->gender }}
                            </td>
                            <td>
                                {{ $patient->age }}
                            </td>
                            <td style="text-align:right">
                                <a href="{{ url('/patients/' . $patient->id . '/edit') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit fa-fw"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary"  href="{{ url('/patients/create') }}">{{ trans('Add patient') }}</a>
        </div>
    </div>
@endsection