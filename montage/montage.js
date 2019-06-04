(function () {

    var streaming = false,
        video = document.querySelector('#webcam'),
        cover = document.querySelector('#cover'),
        canvas = document.querySelector('#canvas'),
        photo = document.querySelector('#photo'),
        startbutton = document.querySelector('#snap-btn'),
        live_mask = document.querySelectorAll('.live-mask'),
        mask_selection = document.querySelectorAll('.mask-choice'),
        final_mask = document.querySelector('#maskChoice'),
        image_to_upload = document.querySelector('#image_to_upload'),
        image_to_post= document.querySelector('#image_to_post'),
        uploadButton = document.querySelector('#uploadButton'),
        postButton = document.querySelector('#postButton'),
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
        document.upload_image.picture.value = data;
        live_mask[1].removeAttribute("hidden");
        live_mask[1].removeAttribute("hidden");
        postButton.removeAttribute("hidden");

        console.log(data);
        changeMask(live_mask[0].id);
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
        final_mask.value = mask_id;
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
                document.upload_image.picture.value = fileLoadedEvent.target.result;
                console.log(fileLoadedEvent.target.result);
                // image_to_post.src = ;
                photo.removeAttribute("hidden");
                live_mask[1].removeAttribute("hidden");
                postButton.removeAttribute("hidden");
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

// upload_form.picture.src = data;
// upload_form.submit();