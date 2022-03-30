import { v4 as uuidv4 } from "uuid";

let formData = {
  uuid: uuidv4(),
  firstname: "",
  plz: "",
  email: "",
  optin: false,
  support: false,
  donate: false,
};

document
  .querySelector("#cta-form-wrapper form")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    let step = parseInt(
      this.querySelector(".CtAStep:not([hidden])")
        .getAttribute("data-step-id")
        .split("form-step")[1]
    );
    console.log(step);
    let nextStep = step + 1;
    console.log(nextStep);
    if (step === 1) {
      formData.firstname = this.querySelector("#firstname").value;
      formData.plz = this.querySelector("#plz").value;
      formData.email = this.querySelector("#email").value;
      formData.optin = this.querySelector("#optin").checked;
    } else if (step === 2) {
      formData.support = this.querySelector("#support").checked;
      formData.donate = this.querySelector("#donate").checked;
    }
    (async () => {
      const rawResponse = await fetch(
        `/wp-content/themes/rem-publicam-capessere/api/v1/cta/step${step}.php`,
        {
          method: "POST",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
          },
          body: JSON.stringify(formData),
        }
      );
      const content = await rawResponse.json();
      console.log(content);
    })();
    this.querySelector(
      `.CtAStep[data-step-id='form-step${step}']`
    ).setAttribute("hidden", true);
    this.querySelector(
      `.CtAStep[data-step-id='form-step${nextStep}']`
    ).removeAttribute("hidden");
  });
