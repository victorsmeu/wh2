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

<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
    {!! Form::label('gender', 'Gender:', ['class' => 'control-label']) !!}
    <div class="radio">
        <label>{!! Form::radio('gender', 'M', null) !!} M </label>
    </div>
    <div class="radio">
        <label>{!! Form::radio('gender', 'F', null) !!} F </label>
    </div>
    @if ($errors->has('gender'))
        <span class="help-block">
            <strong>{{ $errors->first('gender') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('year_of_birth') ? ' has-error' : '' }}">
    {!! Form::label('year_of_birth', 'Year of birth:', ['class' => 'control-label']) !!}
    {!! Form::text('year_of_birth', null, ['class' => 'form-control']) !!}

    @if ($errors->has('year_of_birth'))
        <span class="help-block">
        <strong>{{ $errors->first('year_of_birth') }}</strong>
    </span>
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block">
        <i class="fa fa-btn fa-user"></i> &nbsp; Submit
    </button>
</div>