import { v4 as uuidv4 } from "uuid";

const formUUID = uuidv4();

function legacyFormLogic(form) {
  form.addEventListener("submit", function (e) {
    let formData = {
      uuid: uuidv4(),
      firstname: "",
      plz: "",
      email: "",
      optin: false,
      support: false,
      donate: false,
    };
    e.preventDefault();
    let step = parseInt(
      this.querySelector(".CtAStep:not([hidden])")
        .getAttribute("data-step-id")
        .split("form-step")[1]
    );
    let nextStep = step + 1;
    if (step === 1) {
      formData.firstname = this.querySelector("#firstname").value;
      formData.plz = this.querySelector("#plz").value;
      formData.email = this.querySelector("#email").value;
      formData.optin = this.querySelector(".optin").checked;
    } else if (step === 2) {
      formData.firstname = this.querySelector("#firstname").value;
      formData.plz = this.querySelector("#plz").value;
      formData.email = this.querySelector("#email").value;
      formData.optin = this.querySelector(".optin").checked;
      formData.support = this.querySelector(".support").checked;
      formData.donate = this.querySelector(".donate").checked;
    }
    (async () => {
      const rawResponse = await fetch(`/api/v1/cta/step${step}`, {
        method: "POST",
        headers: {
          // Accept: "application/json",
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });
      const content = await rawResponse.json();
      if (content.success) {
        if (nextStep === 3 && formData.donate == true) {
          window.location.href = "/spenden";
        } else {
          this.querySelector(
            `.CtAStep[data-step-id='form-step${step}']`
          ).setAttribute("hidden", true);
          this.querySelector(
            `.CtAStep[data-step-id='form-step${nextStep}']`
          ).removeAttribute("hidden");
        }
      } else {
        console.log(content);
        alert("Something went wrong. Please try again.");
      }
    })();
  });
}

function formLogic(form) {
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    let step = parseInt(
      this.querySelector(".CtAStep:not([hidden])")
        .getAttribute("data-step-id")
        .split("form-step")[1]
    );
    let endpoint = this.getAttribute("data-endpoint");
    let nextStep = step + 1;
    var formData = {};
    for (const pair of new FormData(form).entries()) {
      formData[pair[0]] = pair[1];
    }
    formData.uuid = formUUID;
    (async () => {
      const rawResponse = await fetch(`${endpoint}step${step}`, {
        method: "POST",
        headers: {
          // Accept: "application/json",
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });
      const content = await rawResponse.json();
      console.log(content);
      if (content.success) {
        if (content.action == "nextStep") {
          if (content.nextStep) {
            nextStep = content.nextStep;
          }
          this.querySelector(
            `.CtAStep[data-step-id='form-step${step}']`
          ).setAttribute("hidden", true);
          this.querySelector(
            `.CtAStep[data-step-id='form-step${nextStep}']`
          ).removeAttribute("hidden");
        } else if (content.action == "redirect") {
          window.location.href = content.redirect;
        }
      } else {
        console.log(content);
        alert("Something went wrong. Please try again.");
      }
    })();
  });
}

if (document.querySelector(".cta-form-wrapper form")) {
  document.querySelectorAll(".cta-form-wrapper form").forEach((form) => {
    if (form.classList.contains("actionform")) {
      formLogic(form);
    } else {
      legacyFormLogic(form);
    }
  });
}

document
  .querySelectorAll(".share-buttons .rpc-button")
  .forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      let mobimsg = document
        .querySelector(".share-buttons")
        .getAttribute("data-sharetext");
      let url = window.location.href.split("#")[0];
      let button = e.target;
      let type = button.getAttribute("data-type");
      if (type == "whatsapp") {
        window.open(
          `https://api.whatsapp.com/send/?text=${encodeURIComponent(
            mobimsg
          )}%0A${encodeURIComponent(url)}`
        );
      } else if (type == "telegram") {
        window.open(
          `https://t.me/share/url?url=${encodeURIComponent(
            url
          )}&text=${encodeURIComponent(mobimsg)}`
        );
      } else if (type == "facebook") {
        window.open(
          `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
            url
          )}`
        );
      } else if (type == "email") {
        window.open(
          `mailto:?body=${encodeURIComponent(mobimsg)}%0A${encodeURIComponent(
            url
          )}`
        );
      }
    });
  });
