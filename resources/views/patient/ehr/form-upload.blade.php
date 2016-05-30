{!! Form::hidden('label', $label) !!}

@if($files)
<ul>
@foreach ($files as $file)
<li><a href='{{ url('/secure-download/' . $file['patient_id'] . '/' . $file['id']) }}' target='_blank'>{{ $file['info']->originalName }}</a></li>
@endforeach
</ul>
@endif

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
