import { v4 as uuidv4 } from "uuid";
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';
import "./crop-komitee-photo.js";

if (document.querySelector(".rpc-api-form")) {
  document.querySelectorAll(".rpc-api-form").forEach(function (form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      formlogic(form);
    });
  });
}

function formlogic(form) {
  let data = form2JSON(form);
  let validation = manualValidation(form);
  if (!validation.valid) {
    const notyf = new Notyf({
      duration: 5000,
      dismissible: true,
    });
    notyf.error(validation.message);
    return;
  }
  let loadingScreen = createLoader();
  console.log(data);
  let url = form.getAttribute("data-endpoint");
  setTimeout(() => {
    (async () => {
      const rawResponse = await fetch(url, {
        method: form.getAttribute("method") || "POST",
        headers: {
          // Accept: "application/json",
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });
      const content = await rawResponse.json();
      localStorage.setItem(url, JSON.stringify(content.formData));
      console.log(content);
      if (content.status == "success") {
        switch (content.action) {
          case "js":
            eval(content.js);
            break;
        }
      } else {
        console.log(content);
        alert("Something went wrong. Please try again.");
      }
      destroyLoader(loadingScreen);
    })();
  }, 750);
}

function form2JSON(form) {
  let formData = new FormData(form);
  var obj = {};
  formData.forEach(function (value, key) {
    obj[key] = value;
  });
  form.querySelectorAll(".rpc-editable-textarea").forEach(element => {
    obj[element.getAttribute("name")] = element.innerHTML.replace(/(<([^>]+)>)/gi, "");;
  });
  return obj;
}

function createLoader() {
  let id = uuidv4();
  let loader = document.createElement("div");
  loader.classList.add("rpc-form-loader", "h-screen", "w-screen", "fixed", "top-0", "left-0", "z-50", "flex", "justify-center", "items-center", "bg-black", "bg-opacity-70", "text-white", "backdrop-blur-lg", "backdrop-filter", "opacity-0", "transition", "duration-500", "ease-in-out");
  loader.setAttribute("id", id);
  loader.innerHTML = `<p class="text-3xl font-bold">Loading...</p>`;
  document.body.appendChild(loader);
  setTimeout(() => {
    loader.classList.remove("opacity-0");
  }, 100);
  return id;
}

function destroyLoader(id) {
  let loader = document.getElementById(id);
  loader.classList.add("opacity-0");
  setTimeout(() => {
    loader.remove();
  }, 500);
}

function manualValidation(form) {
  let valid = true;
  let message = "";
  form.querySelectorAll(".rpc-editable-textarea").forEach(element => {
    let length = element.innerHTML.replace(/(<([^>]+)>)/gi, "").length;
    let allowed = parseInt(element.getAttribute("data-max-length")) || false;
    if (allowed && length > allowed) {
      valid = false;
      let label = element.previousElementSibling.innerText;
      message = `Das Feld "${label}" darf maximal ${allowed} Zeichen lang sein.`;
    }
  });
  return {
    valid: valid,
    message: message
  }
}