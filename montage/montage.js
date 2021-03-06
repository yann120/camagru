(function () {
  var streaming = false,
      video = document.querySelector('#webcam'),
      videodiv = document.querySelector('#video'),
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
      height = 450;

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
        //   console.log("An error occured! " + err);
      });

  video.addEventListener('canplay', function (ev) {
      if (!streaming) {
          height = video.videoHeight / (video.videoWidth / width);
          video.setAttribute('width', width);
          video.setAttribute('height', height);
          canvas.setAttribute('width', width);
          canvas.setAttribute('height', height);
          videodiv.removeAttribute("hidden");
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
      startbutton.removeAttribute("disabled");
      live_mask[0].removeAttribute("hidden");
      });
  };


  function isImage(file) {
    filename = file.name + '';
    parts = filename.split('.');
    extension = parts[parts.length - 1];
    extension = extension.toLowerCase();
    if (extension == "jpg" || extension == "jpeg" || extension == "png")
    {
        return (true);
    }
    else
    {
        return (false);
    }
  };
  mask_selection.forEach( function(mask){
      mask.addEventListener('click', function () {
      changeMask(mask.id);
      })
  });

  uploadButton.addEventListener('click', function (ev) {
    uploadedFile = image_to_upload.files[0];
      if (uploadedFile && isImage(uploadedFile))
      {
          fileReader = new FileReader();
          fileReader.onload = (fileLoadedEvent) => {
              photo.src = fileLoadedEvent.target.result;
              document.upload_image.picture.value = fileLoadedEvent.target.result;
              photo.removeAttribute("hidden");
              videodiv.remove();
              startbutton.remove();
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