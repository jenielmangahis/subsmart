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
                <div class="row">
                    <div class="col-lg-4">
                        <form id="createRoomForm" class="d-inline">
                            <button type="submit" class="nsm-button primary createRoomButton">Create Room</button>
                        </form>
                        <strong>||</strong>
                        <form id="joinRoomForm" class="d-inline position-relative">
                            <button type=submit class="nsm-button joinRoomButton">Join Room</button>
                            <input class="form-control d-inline w-50 roomCodeField" type="text" placeholder="Enter Room Code..." required>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 <!-- <h1 class="title">Sample Meet</h1>
                        <p id="notification" hidden></p>
                        <div class="entry-modal" id="entry-modal">
                            <p>Create or Join Meeting</p>
                            <input id="room-input" class="room-input" placeholder="Enter Room ID">
                            <div>
                                <button onclick="createRoom()">Create Room</button>
                                <button onclick="joinRoom()">Join Room</button>
                            </div>
                        </div>
                        <div class="meet-area">
                            <video id="remote-video" controls controlsList="nofullscreen nodownload noremoteplayback noplaybackrate"></video>

                            <video id="local-video" controls controlsList="nofullscreen nodownload noremoteplayback noplaybackrate"></video>
                            <div class="meet-controls-bar">
                                <button onclick="startScreenShare()">Screen Share</button>
                            </div>
                        </div> -->

<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
<script type="text/javascript">
var room_id;
var getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
var local_stream;
var screenStream;
var peer = null;
var currentPeer = null
var screenSharing = false

function generateMeetingCode() {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const codeLength = 14;
    const hyphenPositions = [4, 9];
    let meetingCode = '';

    for (let i = 0; i < codeLength; i++) {
        if (hyphenPositions.includes(i)) {
            meetingCode += '-';
        } else {
            const randomIndex = Math.floor(Math.random() * characters.length);
            meetingCode += characters[randomIndex];
        }
    }

    return meetingCode;
}

// const meetingCode = generateMeetingCode();
// console.log("Generated Meeting Code:", meetingCode);

$(document).on("submit", "#createRoomForm", function (e) {
    e.preventDefault();
    const form = $(this);
    Swal.fire({
        icon: "warning",
        title: "Creating Room!",
        html: "Please wait while the process is running...",
        allowOutsideClick: false,
        allowEscapeKey: false,
        // showCloseButton: true,
        didOpen: () => { Swal.showLoading(); },
    });
});

$(document).on("submit", "#joinRoomForm", function (e) {
    e.preventDefault();
    const form = $(this);
    Swal.fire({
        icon: "info",
        title: "Joining Room!",
        html: "Please wait while the process is running...",
        allowOutsideClick: false,
        allowEscapeKey: false,
        // showCloseButton: true,
        didOpen: () => { Swal.showLoading(); },
    });
});


function createRoom() {
    console.log("Creating Room")
    let room = document.getElementById("room-input").value;
    if (room == " " || room == "") {
        alert("Please enter room number")
        return;
    }
    room_id = room;
    peer = new Peer(room_id)
    peer.on('open', (id) => {
        console.log("Peer Connected with ID: ", id)
        hideModal()
        getUserMedia({ video: true, audio: true }, (stream) => {
            local_stream = stream;
            setLocalStream(local_stream)
        }, (err) => {
            console.log(err)
        })
        notify("Waiting for peer to join.")
    })
    peer.on('call', (call) => {
        call.answer(local_stream);
        call.on('stream', (stream) => {
            setRemoteStream(stream)
        })
        currentPeer = call;
    })
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

function hideModal() {
    document.getElementById("entry-modal").hidden = true
}

function notify(msg) {
    let notification = document.getElementById("notification")
    notification.innerHTML = msg
    notification.hidden = false
    setTimeout(() => {
        notification.hidden = true;
    }, 3000)
}

function joinRoom() {
    console.log("Joining Room")
    let room = document.getElementById("room-input").value;
    if (room == " " || room == "") {
        alert("Please enter room number")
        return;
    }
    room_id = room;
    hideModal()
    peer = new Peer()
    peer.on('open', (id) => {
        console.log("Connected with Id: " + id)
        getUserMedia({ video: true, audio: true }, (stream) => {
            local_stream = stream;
            setLocalStream(local_stream)
            notify("Joining peer")
            let call = peer.call(room_id, stream)
            call.on('stream', (stream) => {
                setRemoteStream(stream);
            })
            currentPeer = call;
        }, (err) => {
            console.log(err)
        })

    })
}

function startScreenShare() {
    if (screenSharing) {
        stopScreenSharing()
    }
    navigator.mediaDevices.getDisplayMedia({ video: true }).then((stream) => {
        screenStream = stream;
        let videoTrack = screenStream.getVideoTracks()[0];
        videoTrack.onended = () => {
            stopScreenSharing()
        }
        if (peer) {
            let sender = currentPeer.peerConnection.getSenders().find(function (s) {
                return s.track.kind == videoTrack.kind;
            })
            sender.replaceTrack(videoTrack)
            screenSharing = true
        }
        console.log(screenStream)
    })
}

function stopScreenSharing() {
    if (!screenSharing) return;
    let videoTrack = local_stream.getVideoTracks()[0];
    if (peer) {
        let sender = currentPeer.peerConnection.getSenders().find(function (s) {
            return s.track.kind == videoTrack.kind;
        })
        sender.replaceTrack(videoTrack)
    }
    screenStream.getTracks().forEach(function (track) {
        track.stop();
    });
    screenSharing = false
}
</script>
<?php include viewPath('v2/includes/footer'); ?>