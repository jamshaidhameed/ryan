// Capture Picture through Camra
// $(document).on("click", ".btn-capture", function (e) {
//   e.preventDefault();
//   const video = $(this).parent().parent().find("#camera").find("#video"),
//     canvas = $(this).parent().parent().find("#camera").find("#canvas").get(0),
//     imageInput = $(this).parent().parent().find(".captured-images"),
//     photo = $(this).parent().parent().find("#photo"),
//     captureButton = $(this).parent().parent().find("#capture");

//   if (!canvas) {
//     alert("Canvas is not available");
//     return;
//   }

//   // Access the camera
//   navigator.mediaDevices
//     .getUserMedia({ video: true })
//     .then((stream) => {
//       video.srcObject = stream;
//     })
//     .catch((err) => {
//       console.error("Error accessing the camera: ", err);
//     });

//   captureButton.show();

//   captureButton.addEventListener("click", function () {
//     const context = canvas.getContext("2d");
//     context.drawImage(video, 0, 0, 640, 480);
//     const imageData = canvas.toDataURL("image/png"); // Convert to Base64
//     photo.src = imageData;
//     photo.style.display = "block";
//     imageInput.value = imageData; // Store in hidden input
//   });
// });

//Capture Image Function

function capture(parent) {
  const video = parent.querySelector("#video");
  const canvas = parent.querySelector("#canvas");
  const captureButton = parent.querySelector("#capture");
  const photo = parent.querySelector("#photo");
  const imageInput = parent.querySelector("#imageInput");

  // Access the camera
  navigator.mediaDevices
    .getUserMedia({ video: true })
    .then((stream) => {
      video.srcObject = stream;
    })
    .catch((err) => {
      console.error("Error accessing the camera: ", err);
    });

  // Capture the image
  captureButton.addEventListener("click", function () {
    const context = canvas.getContext("2d");
    context.drawImage(video, 0, 0, 640, 480);
    const imageData = canvas.toDataURL("image/png"); // Convert to Base64
    photo.src = imageData;
    photo.style.display = "block";
    imageInput.value = imageData; // Store in hidden input
  });
}
