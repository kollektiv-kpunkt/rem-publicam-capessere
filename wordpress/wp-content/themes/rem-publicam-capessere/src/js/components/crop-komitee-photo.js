import "cropperjs/dist/cropper.min.css";
import Cropper from "cropperjs";

if (document.querySelector("input#rpc-komitee-portrait")) {
  document
    .querySelector("#rpc-komitee-portrait")
    .addEventListener("change", function (e) {
      e.preventDefault();
      var imageFile = e.target.files[0];
      var reader = new FileReader();
      reader.readAsDataURL(imageFile);
      reader.addEventListener("load", function () {
        let cropperImg = document.querySelector("#rpc-testimonial-cropper");
        cropperImg.src = reader.result;
        document.querySelector(
          ".rpc-testimonial-cropper-wrapper"
        ).style.display = "block";
        e.target.parentElement.style.display = "none";
        const cropper = new Cropper(cropperImg, {
          aspectRatio: 1 / 1,
          autoCrop: true,
          autoCropArea: 1,
          viewMode: 1,
        });
        setTimeout(() => {
          document
            .querySelector(".rpc-testimonial-cropper-wrapper")
            .scrollIntoView();
        }, 500);
        document
          .querySelector("#rpc-testimonial-crop")
          .addEventListener("click", function (e) {
            e.preventDefault();
            const croppedImage = cropper.getCroppedCanvas().toDataURL();
            var currData = JSON.parse(
              localStorage.getItem("/api/v1/komitee/step1")
            );
            var formData = {
              image: croppedImage,
              post_id: currData.post_id,
              postData: currData,
            };
            (async () => {
              const response = await fetch("/api/v1/komitee/step2", {
                method: "POST",
                headers: {
                  // Accept: "application/json",
                  "Content-Type": "application/json",
                },
                body: JSON.stringify(formData),
              });
              const data = await response.json();
              console.log(data);
              if (data.status == "success") {
                switch (data.action) {
                  case "js":
                    eval(data.js);
                    break;
                }
              } else {
                console.log(data);
                alert("Something went wrong. Please try again.");
              }
            })();
          });
      });
    });
}
