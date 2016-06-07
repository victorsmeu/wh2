@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Settings</h1>
        </div>
        @if (count($viewers) > 0)
            <div class="col-lg-12">
                <h3>Viewers</h3>
                <div id='no-more-tables'>
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>Name</th>
                            <th>Label</th>
                            <th>URL</th>
                            <th>Access</th>
                            <th>&nbsp;</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($viewers as $viewer)
                            <tr>
                                <td class="table-text" data-title='Name'>
                                    {{ $viewer->name }}
                                </td>
                                <td class="table-text" data-title='Label'>
                                    {{ $viewer->label }}
                                </td>
                                <td class="table-text" data-title='URL'>
                                    {{ $viewer->link }}
                                </td>
                                <td class="table-text" data-title='access'>
                                    {{ $viewer->access }}
                                </td>
                                
                                <td style="text-align:right">
                                    <a class='btn btn-primary' href='{{ url('/admin/settings/edit-viewer/' . $viewer->id) }}'>Edit</a>
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