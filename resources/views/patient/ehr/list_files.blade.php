@if($files)
<ul>
@foreach ($files as $file)
<li><a href='{{ url('/secure-download/' . $file['patient_id'] . '/' . $file['id']) }}' target='_blank'>{{ $file['info']->originalName }}</a></li>
@endforeach
</ul>
@endif