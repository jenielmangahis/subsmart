<?php include viewPath('v2/includes/header'); ?>
<style>
    .roomCodeField {
        height: 36px;
    }

    .joinRoomButton {
        margin-right: 3px;
    }

    .createRoomButton {
        margin-right: 5px;
    }

    .createJoinDiv,
    .roomDiv {
        display: none;
    }

    .roomInfo {
        font-size: 16px;
    }

    .copyRoomId {
        vertical-align: bottom;
    }

    .userScreen {
        /* display: none; */
        width: 100%;
    }

    #local-video {
        border: 2px solid red;
        margin-top: 10px;
    }

    #remote-video {
        border: 2px solid green;
        margin-top: 10px;
    }

    .localScreenText {
        border: 2px solid red;
        padding: 3px;
        color: red;
        background: #ff00001a;
    }

    .remoteScreenText {
        border: 2px solid green;
        padding: 3px;
        color: green;
        background: #00ff7f1a;
    }

    .localVideoContainer,
    .remoteVideoContainer {
        display: none;
    }

    .connectedUsersCard {
        font-weight: 500;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nsm-callout primary">Real-Time User Assistance: Providing Instant Support for Seamless Interaction.</div>
                    </div>
                </div>
                <div class="createJoinDiv">
                    <div class="row">
                        <div class="col-lg-4">
                            <form id="createRoomForm" class="d-inline">
                                <button type="submit" class="nsm-button primary createRoomButton">Create Room</button>
                            </form>
                            <strong>||</strong>
                            <form id="joinRoomForm" class="d-inline position-relative">
                                <button type=submit class="nsm-button joinRoomButton">Join Room</button>
                                <input class="form-control d-inline w-50 roomCodeField" type="text" name="room_id" placeholder="Enter Room Code..." required>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="roomDiv">
                    <div class="row">
                        <div class="col-lg-3 mb-3">
                            <span class="roomInfo"><strong>Host:</strong>&nbsp;&nbsp;<span class="hostNameText"></span></span><br>
                            <span class="roomInfo"><strong>Room:</strong>&nbsp;&nbsp;<span class="roomIdText"></span></span>
                            <button class='btn btn-outline-success btn-sm border-0 copyRoomId'>copy</button><br>
                            <button class='btn btn-primary border-0 mt-2 fw-bold shareScreenButton' onclick="startScreenShare()">Sharescreen</button>
                            <button class='btn btn-outline-danger border-0 mt-2 fw-bold leaveRoomButton'>Leave Room</button>
                            <hr>
                            <div class="mb-2">Connected Users:</div>
                            <div class="card w-50">
                                <ul class="list-group list-group-flush connectedUsersCard"></ul>
                            </div>
                        </div>
                        <div class="col-lg-9 mt-3" style="text-align: -webkit-center;">
                            <div class="localVideoContainer position-relative">
                                <strong class="localScreenText">MY SHARESCREEN</strong>
                                <video id="local-video" class="userScreen" controls></video>
                            </div>
                            <span class="remoteVideoContainer position-relative">
                                <strong class="remoteScreenText">HOST SHARESCREEN</strong>
                                <video id="remote-video" class="userScreen" controls></video>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<audio class="d-none" id="joinNotifPlayer" src="<?php echo base_url('uploads/join_room_notif.wav'); ?>"></audio>
<audio class="d-none" id="leaveNotifPlayer" src="<?php echo base_url('uploads/leave_room_notif.wav'); ?>"></audio>
<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
<script type="text/javascript">
const URL_ORIGIN = window.origin;
var room_id;
var getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
var local_stream;
var screenStream;
var peer = null;
var currentPeer = null;
var screenSharing = false;
var isHost = false;
var isUser = false;

// Check existing room first if available
$(document).ready(function () {
    $.ajax({
        url: URL_ORIGIN + '/SmartZoom/checkExistingRoom',
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            if (response.length == 1) {
                Swal.fire({
                    icon: "info",
                    title: "Fetching Room info!",
                    html: "Please wait while the process is running...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    // showCloseButton: true,
                    didOpen: () => { Swal.showLoading(); },
                });

                window.isHost = true;
                window.room_id = response[0].room;
                window.createRoom(window.room_id);
                $('.connectedUsersCard').append("<li class='list-group-item'>" + response[0].host_name + " <span class='text-muted'>(You)</span></li>");
                $('.hostNameText').text(response[0].host_name);
                $('.roomIdText').text(response[0].room);
                $('.copyRoomId').attr('onclick', 'copyToClipboard(`' + response[0].room + '`)');
            } else {
                $('.createJoinDiv').show();
                $('.roomDiv').hide();
            }
        },
    });
});

$(document).on("submit", "#createRoomForm", function (e) {
    e.preventDefault();
    $.ajax({
        url: URL_ORIGIN + '/SmartZoom/createRoom',
        type: 'POST', 
        dataType: 'json',
        beforeSend: function() {
            Swal.fire({
                icon: "warning",
                title: "Creating Room!",
                html: "Please wait while the process is running...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                // showCloseButton: true,
                didOpen: () => { Swal.showLoading(); },
            });
        },
        success: function(response) {
            window.room_id = response;
            Swal.fire({
                icon: "success",
                title: "Room created!",
                html: "Your room id:&nbsp;<span>"+window.room_id+"</span>&nbsp;<button onclick='copyToClipboard(`"+window.room_id+"`)' class='btn btn-outline-success btn-sm border-0'>copy</button>",
                allowOutsideClick: false,
                allowEscapeKey: false,
                showCancelButton: false,
                confirmButtonText: 'Go to created Room',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: URL_ORIGIN + '/SmartZoom/checkExistingRoom',
                        type: 'POST',
                        dataType: 'json',
                        success: function (response) {
                            if (response.length == 1) {
                                window.room_id = response[0].room;
                                window.createRoom(window.room_id);
                                $('.createJoinDiv').hide();
                                $('.roomDiv').show();
                                $('.connectedUsersCard').append("<li class='list-group-item'>" + response[0].host_name + " <span class='text-muted'>(You)</span></li>");
                                $('.hostNameText').text(response[0].host_name);
                                $('.roomIdText').text(response[0].room);
                                $('.copyRoomId').attr('onclick', 'copyToClipboard(`' + response[0].room + '`)');
                            } else {
                                $('.createJoinDiv').show();
                                $('.roomDiv').hide();
                            }
                        },
                    });
                }
            });
        },
    });
});

$(document).on("submit", "#joinRoomForm", function (e) {
    e.preventDefault();
    const form = $(this);
    $.ajax({
        url: URL_ORIGIN + '/SmartZoom/joinRoom',
        type: 'POST', 
        dataType: 'json',
        data: form.serialize(),
        beforeSend: function() {
            Swal.fire({
                icon: "info",
                title: "Joining Room!",
                html: "Please wait while the process is running...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                // showCloseButton: true,
                didOpen: () => { Swal.showLoading(); },
            });
        },
        success: function(response) {
            if (response.length == 1) {
                if (response[0].host == response[0].user) {
                // for Host 
                    console.log('Host connected');
                } else {
                // for user
                    console.log('User Connected');
                    window.isUser = true;
                    $('.shareScreenButton').remove();
                    $('.connectedUsersCard').append("<li class='list-group-item'>" + response[0].host_name + " <span class='text-muted'>(Host)</span></li>");
                    $('.hostNameText').text(response[0].host_name);
                    $('.roomIdText').text(response[0].room);
                    $('.copyRoomId').attr('onclick', 'copyToClipboard(`' + response[0].room + '`)');
                    window.joinRoom(response[0].room, response[0].user_name);
                }
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Unable to join!",
                    html: "Room ID not found, please input correct room ID.",
                    allowOutsideClick: true,
                    allowEscapeKey: true,
                    showCloseButton: true,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
            console.log(response);
        },
    });
});

$(document).on("click", ".leaveRoomButton", function (e) {
    if (window.isHost == true && window.isUser == false) {
        Swal.fire({
            icon: "warning",
            title: "Leave Room",
            html: "Are you sure you want to leave the room?<br><small class='text-muted'>(The room will be remove if you are the host)</small>",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonText: 'Proceed',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: "info",
                    title: "Leaving Room!",
                    html: "Please wait while the process is running...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    // showCloseButton: true,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
                $.ajax({
                    url: URL_ORIGIN + '/SmartZoom/deleteRoom',
                    type: 'POST',
                    dataType: 'json',
                    data: 'room_id=' + window.room_id,
                    success: function (response) {
                        window.playLeaveNotifSound();
                        setTimeout(() => {
                            window.location.reload(true);
                        }, 2000);
                    },
                });
            }
        });
    } else if (window.isHost == false && window.isUser == true) {
        Swal.fire({
            icon: "warning",
            title: "Leave Room",
            html: "Are you sure you want to leave the room?",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonText: 'Proceed',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: "info",
                    title: "Leaving Room!",
                    html: "Please wait while the process is running...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
                window.playLeaveNotifSound();
                setTimeout(() => {
                    window.location.reload(true);
                }, 2000);
            }
        });
    }
});

function copyToClipboard(value) {
    const tempInput = document.createElement('input');
    tempInput.value = value;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
}

function createRoom(roomID) {
    peer = new Peer(roomID);
    peer.on('open', (id) => {
        // Enable Capture realtime audio with dummy video to prevent capturing camera from opening...
        startScreenShare();
        $('.createJoinDiv').hide();
        $('.roomDiv').show();
        $('.localVideoContainer').show();
        console.log("Room " + id + " was created successfully!");
        window.isHost = true;
        Swal.close();
        window.playJoinNotifSound();
        $('#remote-video').css({ 'width': "0% ", 'height': "0% ", });
    });

    // When User connected to the created room
    peer.on('call', (call) => {
        call.answer(local_stream);
        call.on('stream', (stream) => {
            setRemoteStream(stream);
            
        });
        currentPeer = call;;
        if ($('.connectedUsersCard > li:contains("'+ call.metadata.user1 +'")').length == 0) {
            $('.connectedUsersCard').append("<li class='list-group-item'>" + call.metadata.user1 + "</li>");
        }
        window.playJoinNotifSound();
    });

    // Event handler for WebSocket errors
    peer.on('error', (error) => {
        // console.error('WebSocket error:', error);
        console.log('Failed to create room due to websocket error. Retrying...');
        // Retry creating room every 3 seconds
        setTimeout(() => {
            createRoom(roomID);
        }, 2000);
    });
}

function joinRoom(roomID, username) {
    peer = new Peer();
    peer.on('open', (id) => {
        console.log("Joined to room " + id + " successfully!");
        getUserMedia({ video: true, audio: true }, (stream) => {
            local_stream = stream;
            let call = peer.call(roomID, stream, { metadata: { user1: username } });
            call.on('stream', (stream) => {
                console.log(stream);
                setRemoteStream(stream);
                $('.remoteVideoContainer').show();
                $('.createJoinDiv').hide();
                $('.roomDiv').show();
                Swal.close();
                console.log('Connected');
            });
            currentPeer = call;
            $('.connectedUsersCard').append("<li class='list-group-item'>" + username + "</li>");
            window.playJoinNotifSound();
            $('#local-video').css({ 'width': "0% ", 'height': "0% ", });
        }, (err) => {
            console.log(err);
            alert('Unable to connect due to no access');
        });
    });

    // Event handler for WebSocket errors
    peer.on('error', (error) => {
        // console.error('WebSocket error:', error);
        console.log('Failed to join room due to websocket error. Retrying...');
        // Retry joining room every 3 seconds
        setTimeout(() => {
            joinRoom(roomID, username);
        }, 2000);
    });
}

function playJoinNotifSound() {
    setTimeout(() => {
        $('#joinNotifPlayer')[0].currentTime = 0; 
        $('#joinNotifPlayer')[0].play();
    }, 1000);
}

function playLeaveNotifSound() {
    setTimeout(() => {
        $('#leaveNotifPlayer')[0].currentTime = 0; 
        $('#leaveNotifPlayer')[0].play();
    }, 1000);
}

function setDummyVideoCapture() {
    const canvas = document.createElement('canvas');
    canvas.width = 1;
    canvas.height = 1;
    // ===========
    const context = canvas.getContext('2d');
    context.fillStyle = 'black';
    context.fillRect(0, 0, canvas.width, canvas.height); 
    // ===========
    const videoTrack = canvas.captureStream().getVideoTracks()[0];
    const stream = new MediaStream();
    stream.addTrack(videoTrack);
    // ===========
    navigator.mediaDevices.getUserMedia({ audio: true }).then((audioStream) => {
        const audioTracks = audioStream.getAudioTracks();
        audioTracks.forEach(track => stream.addTrack(track)); 
        local_stream = stream;
        setLocalStream(local_stream);
    }).catch((err) => {
        console.log(err);
    });
}

function startScreenShare() {
    if (screenSharing) {
        window.stopScreenSharing();
        window.setDummyVideoCapture();
    }
    // ===========
    navigator.mediaDevices.getUserMedia({ audio: true }).then((audioStream) => {
        navigator.mediaDevices.getDisplayMedia({ video: true }).then((screenStream) => {
            // ===========
            let mergedStream = new MediaStream([...screenStream.getVideoTracks(), ...audioStream.getAudioTracks()]);
            local_stream = mergedStream;
            setLocalStream(local_stream);
            $('#local-video').show();
            $('.shareScreenButton').removeClass('btn-primary').removeAttr('onclick').addClass('btn-success').text('Currently sharing screen');
            // ===========
            let videoTrack = screenStream.getVideoTracks()[0];
            videoTrack.onended = () => {
                window.stopScreenSharing();
                window.setDummyVideoCapture();
            }
            // ===========
            if (peer) {
                let sender = currentPeer.peerConnection.getSenders().find(function(s) {
                    return s.track.kind == videoTrack.kind;
                });
                sender.replaceTrack(videoTrack);
                screenSharing = true;
            }
            // ===========
        }).catch((error) => {
            console.error('Error accessing screen:', error);
        });
    }).catch((error) => {
        console.error('Error accessing audio:', error);
    });
}

function stopScreenSharing() {
    $('.shareScreenButton').removeClass('btn-success').attr('onclick', 'startScreenShare()').addClass('btn-primary').text('Sharescreen');
    // ===========
    if (!screenSharing) return;
    // ===========
    if (local_stream && local_stream.getVideoTracks().length > 0) {
        let videoTrack = local_stream.getVideoTracks()[0];
        if (peer) {
            let sender = currentPeer.peerConnection.getSenders().find(function(s) {
                return s.track.kind == videoTrack.kind;
            });
            if (sender) {
                sender.replaceTrack(videoTrack);
            }
        }
    }
    // ===========  
    if (screenStream && screenStream.getTracks().length > 0) {
        screenStream.getTracks().forEach(function(track) {
            track.stop();
        });
    }
    // ===========
    screenSharing = false;
}

function setLocalStream(stream) {
    let video = document.getElementById("local-video");
    video.srcObject = stream;
    video.muted = true;
    video.play();
}

function setRemoteStream(stream) {
    let video = document.getElementById("remote-video");
    video.srcObject = stream;
    video.play();
}

// For future development...
// function toggleFullscreen(videoId) {
//     var elem = document.getElementById(videoId);
//     if (!document.fullscreenElement) {
//         elem.requestFullscreen().catch(err => {
//             alert(`Error attempting to enable full-screen mode: ${err.message} (${err.name})`);
//         });
//     } else {
//         document.exitFullscreen();
//     }
// }

// function detectAudioActivity(stream) {
//     const audioContext = new AudioContext();
//     const analyser = audioContext.createAnalyser();
//     const source = audioContext.createMediaStreamSource(stream);
//     source.connect(analyser);
    
//     analyser.fftSize = 2048;
//     const bufferLength = analyser.frequencyBinCount;
//     const dataArray = new Uint8Array(bufferLength);

//     function checkAudioActivity() {
//         analyser.getByteFrequencyData(dataArray);
//         const average = dataArray.reduce((acc, val) => acc + val, 0) / bufferLength;
//         if (average > 10) { // Adjust this threshold based on your requirements
//             console.log("User is speaking");
//             // Send a message to the other user indicating that this user is speaking
//         }
//         requestAnimationFrame(checkAudioActivity);
//     }

//     checkAudioActivity();
// }
</script>
<?php include viewPath('v2/includes/footer'); ?>