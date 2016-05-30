{!! Form::hidden('label', $label) !!}

<div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
    {!! Form::textarea('info', null, ['class' => 'form-control']) !!}

    @if ($errors->has('info'))
    <span class="help-block">
        <strong>{{ $errors->first('info') }}</strong>
    </span>
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block">
        <i class="fa fa-btn fa-user"></i> &nbsp; Submit
    </button>
</div>