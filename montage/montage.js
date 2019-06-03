(function () {

    var streaming = false,
        video = document.querySelector('#webcam'),
        cover = document.querySelector('#cover'),
        canvas = document.querySelector('#canvas'),
        photo = document.querySelector('#photo'),
        startbutton = document.querySelector('#snap-btn'),
        live_mask = document.querySelectorAll('.live-mask'),
        mask_selection = document.querySelectorAll('.mask-choice'),
        image_to_upload = document.querySelector('#image_to_upload'),
        uploadButton = document.querySelector('#uploadButton'),
        upload_form = document.upload_image,
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
        image_to_upload.setAttribute('src', data);
        console.log(data);
        console.log("live mask id " + live_mask[0].id);
        changeMask(live_mask[0].id);
        // doesnt work yet
        // upload_form.picture.src = data;
        // upload_form.submit();
    }

    startbutton.addEventListener('click', function (ev) {

        takepicture();
        photo.removeAttribute("hidden");
        ev.preventDefault();
    }, false);

    function changeMask(mask_id) {
        live_mask.forEach(function (mask) {
        mask.src = "../img/montage/" + mask_id + ".png";
        mask.id = mask_id;
        });
    };

    mask_selection.forEach( function(mask){
        mask.addEventListener('click', function () {
        changeMask(mask.id);
        })
    });

    uploadButton.addEventListener('click', function (ev) {
        // console.log(image_to_upload.files[0]);
        if (uploadedFile = image_to_upload.files[0])
        {
            fileReader = new FileReader();
            fileReader.onload = (fileLoadedEvent) => {
                photo.src = fileLoadedEvent.target.result;
                photo.removeAttribute("hidden");
                changeMask(live_mask[0].id);
            }
            fileReader.readAsDataURL(uploadedFile);

        }
        else
        {
            alert("Erreur de fichier. Seul les images jpg, jpeg et PNG sont autorises")
        }
    }, false);
})();