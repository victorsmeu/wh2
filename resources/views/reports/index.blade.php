@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Reports</h1>
        </div>
        @if (count($reports) > 0)
            <div class="col-lg-12">
                <div id='no-more-tables'>
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>User</th>
                            <th>Patient</th>
                            <th>Medic</th>
                            <th class="text-center">Published</th>
                            <th class="text-center">Viewed</th>
                            <th>&nbsp;</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td class="table-text" data-title='User'>
                                    {{ $report->user->first_name }} {{ $report->user->last_name }}
                                </td>
                                <td class="table-text" data-title='Patient'>
                                    {{ $report->study->patient->first_name }} {{ $report->study->patient->last_name }}
                                </td>
                                <td class="table-text" data-title='Medic'>
                                    {{ $report->user->first_name }} {{ $report->user->last_name }}
                                </td>
                                <td class="text-center" data-title='Published'>
                                    @if($report->active == 1) <i class='fa fa-check'></i> @else <i class='fa fa-times'></i> @endif <br />
                                    @if($report->active == 1) <small>{{ $report->published_at }}</small> @endif
                                </td>
                                <td class="text-center" data-title='Viewed'>
                                    @if($report->viewed == 1) <i class='fa fa-check'></i> @else <i class='fa fa-times'></i> @endif <br />
                                    @if($report->viewed == 1) <small>{{ $report->viewed_at }}</small> @endif
                                </td>
                                <td style="text-align:right">
                                    <a class='btn btn-primary' href='{{ url('/reports/' . $report->id) }}'>View Report</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection