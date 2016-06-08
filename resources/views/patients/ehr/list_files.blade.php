@if($files)
<ul class='list_files'>
@foreach ($files as $file)
<li title='{{ $file['info']->originalName }}' data-placement="top" data-toggle="tooltip">
    <a href='{{ url('/secure-download/' . $file['patient_id'] . '/' . $file['id']) }}' target='_blank'>
        <i class='fa fa-file-o'></i>
        <small>{{ $file['info']->originalName }}</small>
    </a>
</li>
@endforeach
</ul>
@endif