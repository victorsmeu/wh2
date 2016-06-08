@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add New Study</h1>
    </div>
    <div class="col-lg-12">
        <script type="text/javascript" src="https://webhippocrates.com/js/xdomain.min.js" slave="https://upload.webhippocrates.com/proxy.html"></script>
        <script type="text/javascript" src="https://webhippocrates.com/js/dicomParser.js"></script>
        <script src="https://webhippocrates.com/upload/lib/sweet-alert.min.js"></script>
        <script src="{{ url('/js') }}/modernizr.js"></script>
        <link rel="stylesheet" type="text/css" href="https://webhippocrates.com/upload/lib/sweet-alert.css">
        <style>
            .ui-page-theme-a a, html .ui-bar-a a, html .ui-body-a a, html body .ui-group-theme-a a {font-weight:inherit;}
            .ui-overlay-a, .ui-page-theme-a, .ui-page-theme-a .ui-panel-wrapper {text-shadow:none;}
            progress {
                color: #0063a6;
                font-size: .6em;
                line-height: 1.5em;
                text-indent: .5em;
                width: 80em;
                height: 1.8em;
                border: 1px solid #0063a6;
                background: #fff;
            }
            #fileOutput {height:180px; overflow-y: scroll;}
        </style>
        <script type="text/javascript">
            window.onload = function () {

                var
                        jsObj = {},
                        indexor,
                        files,
                        file,
                        binStr,
                        j,
                        extension = [],
                        input = document.getElementById("fileURL"),
                        output = document.getElementById("fileOutput"),
                        holder = document.getElementById("fileHolder");
                progressBar = document.querySelector('progress');
                id_dicom = false;
                var i = 0;

                input.addEventListener("change", function (e)
                {
                    files = e.target.files;

                    output.innerHTML = "";

                    progressBar.max = files.length;

                    for (var i = 0, len = files.length; i < len; i++)
                    {

                        file = files[i];
                        var reader = new FileReader();
                        reader.readAsArrayBuffer(file);
                        reader.onload = (function (theFile)
                        {
                            var fileName = theFile.name;
                            return function (e)
                            {
                                if (ab2str(e.target.result.slice(128, 132)) === "DICM")
                                {
                                    var xhr = new XMLHttpRequest();
                                    //xhr.addEventListener("progress", updateProgress, false);
                                    xhr.addEventListener("load", onreadystatechange, false);
                                    xhr.open('POST', 'https://webhippocrates.com/upload/web/instances/', true);
                                    xhr.send(e.target.result);
                                    output.innerHTML += "<li class='type-DICM'>" + fileName + "</li>";
                                    function onreadystatechange(evt) {
                                        if (xhr.readyState == 4) {
                                            progressBar.value = progressBar.value + 1;
                                            if (progressBar.value == files.length)
                                            {
                                                swal({title: "Success!",
                                                    text: "You have uploaded your study",
                                                    type: "warning",
                                                    confirmButtonText: "Ok"
                                                });
                                                if (id_dicom === false) {
                                                    id_dicom = $('#sopInstanceUid').text();
                                                    if (id_dicom == "") {
                                                        swal({title: "Fail!",
                                                            text: "Study upload failed. No DICOM key generated",
                                                            type: "warning",
                                                            confirmButtonText: "Ok"
                                                        });
                                                    } else {
                                                        $.post("https://webhippocrates.com/en/pacient/studies/sync-information/id_study_dicom/" + id_dicom, function (data) {});
                                                    }
                                                }
                                                console.log(id_dicom);
                                            }
                                        }
                                    }
                                    ;
                                    if ($('#sopInstanceUid').text() == "")
                                    {
                                        var arrayBuffer = e.target.result;
                                        var byteArray = new Uint8Array(arrayBuffer);
                                        parseByteArray(byteArray);
                                    }
                                } else
                                {
                                    progressBar.value = progressBar.value + 1;
                                }
                            };
                        }
                        )(file);
                    }
                }, false);



        // This event is fired as the mouse is moved over an element when a drag is occuring
                input.addEventListener("dragover", function (e) {
                    holder.classList.add("highlightOver");
                });

        // This event is fired when the mouse leaves an element while a drag is occuring
                input.addEventListener("dragleave", function (e) {
                    holder.classList.remove("highlightOver");
                });

        // Fires when the user releases the mouse button while dragging an object.
                input.addEventListener("dragend", function (e) {
                    holder.classList.remove("highlightOver");
                });

        // The drop event is fired on the element where the drop was occured at the end of the drag operation
                input.addEventListener("drop", function (e) {
                    holder.classList.remove("highlightOver");
                });



            }
            var has_post = 0;
            function parseByteArray(byteArray)
            {
                try {
                    var dataSet = dicomParser.parseDicom(byteArray);
                    var sopInstanceUid = dataSet.string('x0020000d');
                    var patient_id = $("#patient_id").val();
                    $('#sopInstanceUid').text(sopInstanceUid);
                    if (has_post == 0 && sopInstanceUid != "") {
                        $.post("https://webhippocrates.com/en/default/index/update-study-status", {study_id: sopInstanceUid, user_id: "{{ Auth->user()->id }}", patient_id: patient_id}, function (data) {
                            if (data != 'false') {
                                has_post = 1;
                            }
                        });
                    }
                } catch (err)
                {
                    $('#parseError').text(err);
                }
            }
            function ab2str(buf) {

                return String.fromCharCode.apply(null, new Uint8Array(buf));
            }

            var add = (function () {
                var counter = 0;
                return function () {
                    return counter += 1;
                }
            })();

            function isInputDirSupported() {
                var tmpInput = document.createElement('input');
                if ('webkitdirectory' in tmpInput
                        || 'mozdirectory' in tmpInput
                        || 'odirectory' in tmpInput
                        || 'msdirectory' in tmpInput
                        || 'directory' in tmpInput)
                    return true;

                return false;
            }

            $(document).ready(function () {
                if (isInputDirSupported()) {
                    $(".directory_capable").show();
                    $(".directory_incapable").hide();
                } else {
                    $(".directory_incapable").show();
                    $(".directory_capable").hide();
                }
            });
        </script>
        <div class="patients_content">
            <div class="directory_capable" style="display: none;">
                <div class="page-header">
                    <h2>Select patient</h2>
                </div>
                
                <div class="form-group">
                    <select class="form-control" name="patient_id" id="patient_id">
                    @foreach($patients as $patient)
                    <option value='{{ $patient->id }}'>{{ $patient->first_name }} {{ $patient->last_name }} </option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class='btn btn-primary' id='add_patient' data-target="#myModal" data-toggle="modal"><i class='fa fa-plus-square'></i>&nbsp; Add New Patient</button>
                </div>
                
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
                                <h4 id="myModalLabel" class="modal-title">Add New Patient</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-lg-12">
                                    {!! Form::open( array( 'route' => ['patients.store'], 'role' => 'form' ) ) !!}
                                    @include('patients/form')
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                
                <div class="page-header">
                    <h2>Push <strong>Choose files</strong> to start uploading files</h2>
                </div>

                
                <div id="fileHolder">
                    <input type="file" multiple="" webkitdirectory="" id="fileURL">
                </div>
                <br />

                <progress min="0" max="100" value="0">0% complete</progress>
                <h4>Files to upload:</h4>
                <div id="counter"></div>
                <ul id="sopInstanceUid"></ul>
                <ul id="fileOutput"></ul>
                <ul id="parseError"></ul>
                    
            </div>
            <div class="directory_incapable" style="display: block;">
                <h1>Your current browser doesn't support directory upload.</h1>
                <p><a href="https://www.google.com/chrome/browser/desktop/">Download Google Chrome</a> in order to upload medical studies</p>
            </div>
        </div>
        <div>
            <div class="sweet-overlay" tabindex="-1"></div>
            <div class="sweet-alert" tabindex="-1">
                <div class="icon error">
                    <span class="x-mark">
                        <span class="line left"></span>
                        <span class="line right"></span>
                    </span>
                </div>

                <div class="icon warning"> 
                    <span class="body"></span> 
                    <span class="dot"></span> 
                </div> 

                <div class="icon info"></div> 

                <div class="icon success"> 
                    <span class="line tip"></span> 
                    <span class="line long"></span> 
                    <div class="placeholder"></div> 
                    <div class="fix"></div> 
                </div> 
                <div class="icon custom"></div> 
                <h2>Title</h2>
                <p>Text</p>
                <button class="cancel" tabindex="2">Cancel</button>
                <button class="confirm" tabindex="1">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection