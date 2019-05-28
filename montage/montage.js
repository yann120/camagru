(function () {

    var streaming = false,
        video = document.querySelector('#webcam'),
        cover = document.querySelector('#cover'),
        canvas = document.querySelector('#canvas'),
        photo = document.querySelector('#photo'),
        startbutton = document.querySelector('#snap-btn'),
        live_mask = document.querySelector('.live-mask'),
        mask_selection = document.querySelectorAll('.mask-choice'),
        width = 600,
        height = 337.5;

    navigator.getMedia = (navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);

    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then((stream) => {
            video.srcObject = stream;
            video.play();
        })
        .catch((err) => {
            console.log("An error occured! " + err);
        });

    video.addEventListener('canplay', function (ev) {
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth / width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);

    function takepicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        const data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
    }

    startbutton.addEventListener('click', function (ev) {
        takepicture();
        ev.preventDefault();
    }, false);

    function changeMask(mask_id) {
        console.log
        live_mask.src = "../img/montage/" + mask_id + ".png";
        live_mask.id = mask_id;
    }

    console.log(mask_selection);
    mask_selection.forEach( function(mask){
        mask.addEventListener('click', function () {
        changeMask(mask.id);
        })
    })
    // mask_selection.addEventListener('click', function () {
    //     console.log("ok");
    // })
})();