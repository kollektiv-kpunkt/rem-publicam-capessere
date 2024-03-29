import { v4 as uuidv4 } from "uuid";
import Cropper from "cropperjs";
import "cropperjs/dist/cropper.css";
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

const formUUID = uuidv4();

if (document.querySelector(".rpc-actionform-container")) {
  var formData = {};
  formData.uuid = formUUID;
  formData.formID = document
    .querySelector(".rpc-actionform-container")
    .getAttribute("data-formid");
  formData.formTag = document
    .querySelector(".rpc-actionform-container")
    .getAttribute("data-formtag");
  document.querySelectorAll(".rpc-actionform-form").forEach(function (form) {
    form.addEventListener("submit", async function (e) {
      e.preventDefault();
      var form = e.target;
      var formID = form
        .closest(".rpc-actionform-container")
        .getAttribute("data-formid");
      var formTag = form
        .closest(".rpc-actionform-container")
        .getAttribute("data-formtag");
      formData = formSubmission(form, formData);
      const Loader = addLoader();
      var formResponse = await sendFormdata(formData);
      if (formData.img_src) {
        delete formData.img_src;
      }
      console.log(JSON.stringify(formData));
      setTimeout(() => {
        removeLoader(Loader);
        if (formResponse.status != "success") {
          var notyf = new Notyf({
            duration: 9000,
            dismissible: true
          });
          notyf.error(formResponse.message);
        } else {
          nextStep(form, formID, formData);
        }
      }, 500);
    });
  });
  document
    .querySelectorAll(".rpc-actionform-choice")
    .forEach(function (choice) {
      choice.addEventListener("click", function (e) {
        e.preventDefault();
        var choice = e.target;
        var formID = choice
          .closest(".rpc-actionform-container")
          .getAttribute("data-formid");
        var formTag = choice
          .closest(".rpc-actionform-container")
          .getAttribute("data-formtag");
        formData = choiceSelection(choice, formData);
        nextStep(choice, formID, formData);
      });
    });
  document
    .querySelectorAll(".rpc-actionform-img-upload")
    .forEach(function (input) {
      input.addEventListener("change", function (e) {
        uploadImg(e.target, e.target.getAttribute("data-img-crop"));
      });
    });
}

if (document.querySelector("[data-step-type='thanksInterface']")) {
  var thanksInterface = document.querySelector(
    "[data-step-type='thanksInterface']"
  );

  var shareButtons = thanksInterface.querySelectorAll(".rpc-button");
  var shareText = thanksInterface
    .querySelector(".share-buttons")
    .getAttribute("data-shareText");
  shareButtons.forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      var type = button.getAttribute("data-type");
      switch (type) {
        case "facebook":
          window.open(
            "https://www.facebook.com/sharer/sharer.php?u=" +
            encodeURIComponent(window.location.href)
          );
          break;
        case "whatsapp":
          window.open(
            "https://api.whatsapp.com/send?text=" +
            encodeURIComponent(shareText + " " + window.location.href)
          );
          break;
        case "telegram":
          window.open(
            "https://telegram.me/share/url?url=" +
            encodeURIComponent(window.location.href) +
            "&text=" +
            encodeURIComponent(shareText)
          );
          break;
        case "email":
          window.open(
            "mailto:?body=" +
            encodeURIComponent(shareText) +
            "%0D%0A" +
            encodeURIComponent(window.location.href)
          );
          break;
      }
    });
  });
}

function formSubmission(form, formData) {
  form.querySelectorAll("input, textarea").forEach(function (input) {
    formData[input.name] = {
      value: input.value,
      type: input.type,
      merge: input.getAttribute("data-merge") || false,
      mtag: input.getAttribute("data-mtag") || false
    };

    if (input.getAttribute("data-base-config")) {
      if (!formData["base-config"]) {
        formData["base-config"] = {};
      }
      let base_config_value;
      if (input.value == "on" || input.value == "off") {
        base_config_value = input.checked;
      } else {
        base_config_value = input.value;
      }

      formData["base-config"][input.getAttribute("data-base-config")] = base_config_value;

      formData[input.name]["is-base-config"] = true;
      formData[input.name]["base-config-field"] = input.getAttribute("data-base-config");
    }
    if (input.type == "checkbox") {
      formData[input.name].value = input.checked;
    }

    if (input.getAttribute("data-prefill")) {
      let type = input.getAttribute("data-prefill").split("::")[0];
      let value = input.getAttribute("data-prefill").split("::")[1];
      if (type == "text") {
        formData[input.name].value = value;
      } else if (type == "variable") {
        formData[input.name].value = formData[value].value;
      }
    }
  });
  return formData;
}

function uploadImg(input, type) {
  switch (type) {
    case "modal":
      var element = input.nextElementSibling;
      break;
  }
  var file = input.files[0];
  var reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onloadend = function () {
    setDataURL(reader.result, element);
    input.remove();
  };
}

function setDataURL(dataURL, element) {
  element.removeAttribute("hidden");
  var img = element.querySelector("img.rpc-img-upload-modal-img");
  img.src = dataURL;
  const cropper = new Cropper(img, {
    aspectRatio: 1 / 1,
    autoCrop: true,
    autoCropArea: 1,
    viewMode: 1,
  });

  var cancelButton = element.querySelector(".rpc-img-upload-modal-cancel");
  var cropButton = element.querySelector(".rpc-img-upload-modal-crop");

  cancelButton.addEventListener("click", function (e) {
    e.preventDefault();
    window.location.reload();
  });

  cropButton.addEventListener("click", function (e) {
    e.preventDefault();
    var canvas = cropper.getCroppedCanvas();
    var dataURL = canvas.toDataURL();
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "img_src");
    input.setAttribute("value", dataURL);
    input.setAttribute("data-merge", "JUSTWP");
    var fileInput = element.closest(".input-wrapper.file");
    element.closest("form").append(input);
    fileInput.innerText = "Bild hochgeladen";
    element.remove();
  });
}

function choiceSelection(choice, formData) {
  var id = choice
    .closest(".rpc-actionform-selection")
    .getAttribute("data-selection-id");
  formData[id] = {
    value: choice.getAttribute("data-value"),
    type: "choice",
    mmerge: choice.getAttribute("data-mmerge") || false,
    mtag: choice.getAttribute("data-mtag") || false,
    "is-optin": choice.getAttribute("data-is-optin") || false,
    "is-address": choice.getAttribute("data-is-address") || false,
    "address-field": choice.getAttribute("data-address-field") || false,
  };
  return formData;
}

function nextStep(element, formID, formData) {
  console.log(formData);
  if (element.getAttribute("data-next")) {
    var next = JSON.parse(element.getAttribute("data-next"));
  } else {
    var next = JSON.parse(
      element.querySelector("button[type=submit]").getAttribute("data-next")
    );
  }
  if (typeof next != "string") {
    switch (typeof next) {
      case "object":
        var lookup = next.lookup;
        next = next[formData[lookup].value];
        console.log(next);
        break;
    }
  }
  var nextStepElement = document.querySelector(
    `.rpc-actionform-container[data-formid="${formID}"] .rpc-actionform-step[data-step-id="${next}"]`
  );
  nextStepElement.removeAttribute("hidden");
  if (nextStepElement.getAttribute("data-step-type") == "redirect") {
    var redirectElement = nextStepElement.querySelector(
      ".rpc-actionform-redirect"
    );
    var urlParams = JSON.parse(redirectElement.getAttribute("data-url-params"));
    var url = redirectElement.getAttribute("data-url");
    let i = 0;
    Object.entries(urlParams).forEach((param) => {
      var [key, value] = param;
      if (value.split("::")[0] == "variable") {
        value = formData[value.split("::")[1]].value;
      } else if (value.split("::")[0] == "text") {
        value = value.split("::")[1];
      }
      if (i == 0) {
        url += "?";
      } else {
        url += "&";
      }
      url += `${key}=${value}`;
      i++;
    });

    window.open(url);

    setTimeout(() => {
      nextStep(redirectElement, formID);
    }, 1000);
  }
  element.closest(".rpc-actionform-step").setAttribute("hidden", true);
}

async function sendFormdata(formData) {
  const rawResponse = await fetch(`/api/v1/af-v2`, {
    method: "POST",
    headers: {
      // Accept: "application/json",
      "Content-Type": "application/json",
    },
    body: JSON.stringify(formData),
  });
  const content = await rawResponse.json();
  return content;
};


function addLoader() {
  let ID = uuidv4();
  var loader = document.createElement("div");
  loader.setAttribute("id", ID);
  loader.classList.add("loader");
  loader.style = "position: fixed; top: 0; width: 100vw; height: 100vh; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 2rem; -webkit-backdrop-filter: blur(20px); backdrop-filter: blur(20px); background: rgba(0,0,0,0.5); z-index: 9999; opacity: 0; transition: opacity 0.3s ease-in-out;";
  loader.innerHTML = `<p>Bitte warten...</p>`;
  document.body.append(loader);
  setTimeout(() => {
    loader.style.opacity = 1;
  }, 100);
  return ID;
}

function removeLoader(ID) {
  var loader = document.getElementById(ID);
  loader.style.opacity = 0;
  setTimeout(() => {
    loader.remove();
  }, 300);
}