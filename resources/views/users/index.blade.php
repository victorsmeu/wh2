@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users</h1>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Filter <a class="btn btn-link btn-xs" href='{{ url('/users/') }}'>Reset filters</a></div>
                <div class="panel-body">
                    {!! Form::model($filters, array( 'route' => ['users.index'], 'role' => 'form', 'method' => 'GET' ) ) !!}
                    <div class='col-lg-6 col-xs-12'>
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search by Name/Email']) !!}
                    </div>
                    <div class='col-lg-1 col-xs-3 form-control-static' style='text-align:right'>
                        {!! Form::label('role_id', 'Role:') !!}
                    </div>
                    <div class='col-lg-3 col-xs-9'>
                        {!! Form::select('role_id', ['' => '', 1 => 'Root', 2 => 'Admin', 3 => 'Medic', 4 => 'Patient'], null, ['class' => 'form-control']) !!}
                    </div>
                    <div class='col-lg-2 col-xs-12'>
                        <div class="form-group pull-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> &nbsp; Submit
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        
        @if (count($users) > 0)
            <div class="col-lg-12">
                <div id='no-more-tables'>
                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Active</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td data-title='User Name'>
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </td>
                                <td data-title='Email'>
                                    {{ $user->email }}
                                </td>
                                <td data-title='Role'>
                                    {!! isset($user->role) ?  $user->role->name : '<i class="fa fa-times"></i>' !!}
                                </td>
                                <td data-title='Active'>
                                    {!! $user->active ?  '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}
                                </td>
                                <td data-title='Created'>
                                    {{ $user->created_at }}
                                </td>
                                <td data-title='Updated'>
                                    {{ $user->updated_at }}
                                </td>
                                <td style="text-align:right">
                                    <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit fa-fw"></i> Edit
                                    </a>
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
            <a class="btn btn-primary"  href="{{ url('/users/create') }}">{{ trans('Add User') }}</a>
        </div>
    </div>
@endsection