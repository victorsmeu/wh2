@extends('layouts.app')

@section('content')
<style>
    #menu {display:none;}
    #content1 {top:0;}
    .videoContainer {
        position: relative;
        width: 200px;
        height: 150px;
        float:left;
    }
    .videoContainer video {
        width: 100%;
        height: 100%;
    }
    .volume_bar {
        position: absolute;
        width: 5px;
        height: 0px;
        right: 0px;
        bottom: 0px;
        background-color: #12acef;
    }
    #remotes {height:600px;}
    #remotes video {cursor:pointer;}
    #page_title{display:none!important;}
    .subTitle {margin-bottom:30px;}
</style>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Conference</h1>
    </div>
    
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create conference room
            </div>
            <div class="panel-body">
                <div id="subTitle" style="display: none;">
                    <p></p>
                    <a class="opener" data-target="#study-dialog" data-toggle="modal" style="font-size:10px; line-height:auto;" href="#"></a>
                </div>
                <div id="subTitle_link" style="display: none;"></div>
                <form id="createRoom">
                    <div class="form-group">
                        <label for="sessionInput"></label>
                        <input type="text" id="sessionInput" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Create room"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="videoContainer">
            <video id="localVideo" style="height: 150px;" oncontextmenu="return false;"></video>
            <div id="localVolume" class="volume_bar"></div>
        </div>
        <div id="remotes"></div>
    </div>
    
    <script src="{{ url('/js') }}/socket.io.js"></script>
    <script src="{{ url('/js') }}/simplewebrtc.bundle.js"></script>
    <script src="{{ url('/js') }}/getScreenId.js"></script>
    <script>

        // grab the room from the URL
        var room = location.search && location.search.split('?')[1];

        // create our webrtc connection
        var webrtc = new SimpleWebRTC({
            // the id/element dom element that will hold "our" video
            localVideoEl: 'localVideo',
            // the id/element dom element that will hold remote videos
            remoteVideosEl: '',
            // immediately ask for camera access
            autoRequestMedia: true,
            debug: false,
            detectSpeakingEvents: true,
            autoAdjustMic: false
        });

        // when it's ready, join if we got a room from the URL
        webrtc.on('readyToCall', function () {
            // you can name it anything
            if (room)
                webrtc.joinRoom(room);
        });

        function showVolume(el, volume) {
            if (!el)
                return;
            if (volume < -45) { // vary between -45 and -20
                el.style.height = '0px';
            } else if (volume > -20) {
                el.style.height = '100%';
            } else {
                el.style.height = '' + Math.floor((volume + 100) * 100 / 25 - 220) + '%';
            }
        }
        webrtc.on('channelMessage', function (peer, label, data) {
            if (data.type == 'volume') {
                showVolume(document.getElementById('volume_' + peer.id), data.volume);
            }
        });
        webrtc.on('videoAdded', function (video, peer) {
            console.log('video added', peer);
            var remotes = document.getElementById('remotes');
            if (remotes) {
                var d = document.createElement('div');
                d.className = 'videoContainer';
                d.id = 'container_' + webrtc.getDomId(peer);
                d.appendChild(video);
                var vol = document.createElement('div');
                vol.id = 'volume_' + peer.id;
                vol.className = 'volume_bar';
                video.onclick = function () {
                    if (video.style.width == '' || video.style.width == "200px") {
                        video.style.width = video.videoWidth + 'px';
                        video.style.height = video.videoHeight + 'px';
                    } else {
                        video.style.width = 200 + 'px';
                        video.style.height = 150 + 'px';
                    }

                };
                d.appendChild(vol);
                remotes.appendChild(d);
            }
        });
        webrtc.on('videoRemoved', function (video, peer) {
            console.log('video removed ', peer);
            var remotes = document.getElementById('remotes');
            var el = document.getElementById('container_' + webrtc.getDomId(peer));
            if (remotes && el) {
                remotes.removeChild(el);
            }
        });
        webrtc.on('volumeChange', function (volume, treshold) {
            //console.log('own volume', volume);
            showVolume(document.getElementById('localVolume'), volume);
        });

        // Since we use this twice we put it here
        function setRoom(name) {
            $('form#createRoom').remove();
            $('h1').text("Conference room: " + name);
            $("#subTitle").show();
            $('#subTitle p').text('Send this link to join conversation:');
            $('#subTitle a').html( location.href );
            $('#subTitle_link').html(location.href);
            $('body').addClass('active');
        }

        if (room) {
            setRoom(room);
        } else {
            $('form#createRoom').submit(function () {
                var val = $('#sessionInput').val().toLowerCase().replace(/\s/g, '-').replace(/[^A-Za-z0-9_\-]/g, '');
                webrtc.createRoom(val, function (err, name) {
                    console.log(' create room cb', arguments);

                    var newUrl = location.pathname + '?' + name;
                    if (!err) {
                        history.replaceState({foo: 'bar'}, null, newUrl);
                        setRoom(name);
                    } else {
                        console.log(err);
                    }
                });
                return false;
            });
        }

        var button = $('#screenShareButton'),
                setButton = function (bool) {
                    button.text(bool ? 'share screen' : 'stop sharing');
                };
        webrtc.on('localScreenStopped', function () {
            setButton(true);
        });

        setButton(true);

        button.click(function () {
            if (webrtc.getLocalScreen()) {
                webrtc.stopScreenShare();
                setButton(true);
            } else {
                webrtc.shareScreen(function (err) {
                    if (err) {
                        setButton(true);
                    } else {
                        setButton(false);
                    }
                });

            }
        });

    </script>

    <div id="study-dialog" class="modal fade in" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" aria-hidden="true" data-dismiss="modal" type="button">X</button>
                    <h4 id="study-dialogLabel" class="modal-title">Invite user</h4>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="input_zone">
                            <span id="id_user-label"><label class="required" for="id_user">Send to email address</label></span>
                            <input type="email" name="email" class="form-control"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit"/>
                </div>
            </div>
        </div>
    </div>

    <button id="screenShareButton" class="btn btn-default btn-lg">Share Screen</button>
</div>
@endsection