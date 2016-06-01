{!! Form::hidden('label', $label) !!}

@include ('patient/ehr/list_files', ['files' => $files])

<div class="form-group">
    <div class='col-md-2{{ $errors->has('info') ? ' has-error' : '' }}'>
    {!! Form::file('file', null) !!}
    @if ($errors->has('file'))
    <span class="help-block">
        <strong>{{ $errors->first('file') }}</strong>
    </span>
    @endif
    </div>
    <div class='col-md-1'>
        <button type="submit" class="btn btn-primary btn-sm">
            Submit
        </button>
    </div>
</div>
