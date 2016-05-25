@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users</h1>
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
                                    {{ $user->role->name }}
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
            <a class="btn btn-primary"  href="{{ url('/users/create') }}">{{ trans('Add user') }}</a>
        </div>
    </div>
@endsection