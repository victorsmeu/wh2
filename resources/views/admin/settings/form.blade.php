{!! csrf_field() !!}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}

    @if ($errors->has('name'))
    <span class="help-block">
        <strong>{{ $errors->first('name') }}</strong>
    </span>
    @endif
</div>

<div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
    {!! Form::label('link', 'URL:', ['class' => 'control-label']) !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}

    @if ($errors->has('link'))
        <span class="help-block">
        <strong>{{ $errors->first('link') }}</strong>
    </span>
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block">
        <i class="fa fa-btn fa-user"></i> &nbsp; Submit
    </button>
</div>