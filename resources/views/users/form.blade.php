{!! csrf_field() !!}

<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    {!! Form::label('first_name', 'First name:', ['class' => 'control-label']) !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}

    @if ($errors->has('first_name'))
    <span class="help-block">
        <strong>{{ $errors->first('first_name') }}</strong>
    </span>
    @endif
</div>

<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    {!! Form::label('last_name', 'Last name:', ['class' => 'control-label']) !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}

    @if ($errors->has('last_name'))
        <span class="help-block">
        <strong>{{ $errors->first('last_name') }}</strong>
    </span>
    @endif
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!! Form::label('email', 'Email:', ['class' => 'control-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}

    @if ($errors->has('email'))
        <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
    @if ($block_password === true)
    <div class="form-group input-group">
        {!! Form::password('password', ['class' => 'form-control', 'disabled' => 'true']) !!}
        <span class="input-group-addon"><button class='set_button'>set</button></span>
    </div>
    @else
    {!! Form::password('password', ['class' => 'form-control']) !!}
    @endif
    
    @if ($errors->has('password'))
        <span class="help-block">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
    @endif
</div>

@if($user->id != Auth::user()->id)
<div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
    {!! Form::label('role_id', 'Role:', ['class' => 'control-label']) !!}
    {!! Form::select('role_id', [2 => 'Admin', 3 => 'Medic', 4 => 'Patient'], null, ['class' => 'form-control']) !!}

    @if ($errors->has('role_id'))
        <span class="help-block">
        <strong>{{ $errors->first('role_id') }}</strong>
    </span>
    @endif
</div>

<div class="form-group">
    <div class="checkbox">
        <label>
            {!! Form::checkbox('active', 1, null) !!} Active
        </label>
    </div>
</div>
@endif

<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block">
        <i class="fa fa-btn fa-user"></i> &nbsp; Submit
    </button>
</div>