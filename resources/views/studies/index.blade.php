@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Studies</h1>
        </div>
        
        <div class="col-lg-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#myStudies" data-toggle="tab">@if(Auth::user()->role_id > 2) My uploaded @endif Studies</a></li>
                @if(Auth::user()->role_id == 3)
                <li><a href="#usersStudies" data-toggle="tab">Studies sent to me</a></li>
                @endif
            </ul>

            <div class="tab-content row">
                <br />
                <div id="myStudies" class="tab-pane fade in active">
                    @if (count($myStudies) > 0) 
                        @include('studies/study-box', ['type' => 'myStudies', 'studies' => $myStudies, 'medics' => $medics])
                    @endif
                </div>
                @if(Auth::user()->role_id == 3)
                <div id="usersStudies" class="tab-pane fade">
                    @if (count($usersStudies) > 0)
                        @include('studies/study-box', ['type' => 'usersStudies', 'studies' => $usersStudies])
                    @endif
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-12">
            <hr />
            <a href='{{ url('/studies/create') }}' class='btn btn-primary'>Upload new Medical Study</a>
        </div>
    </div>
@endsection

@section('footer_js')
<script>
$(function(){
  var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop() || $('html').scrollTop();
    window.location.hash = this.hash;
    
    $('html,body').scrollTop(scrollmem);
  });
});
</script>
@endsection