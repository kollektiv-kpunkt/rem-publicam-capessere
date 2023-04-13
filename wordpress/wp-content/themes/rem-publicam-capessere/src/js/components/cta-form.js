if (document.querySelector(".rpc-cta-form")) {
  let webhookForms = document.querySelectorAll(".rpc-cta-form");

  webhookForms.forEach((form) => {
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      const loader = addLoader();
      let formId = form.dataset.formId;
      let contentElement = document.querySelector("#content-" + formId);
      let content = JSON.parse(contentElement.innerHTML);
      let formData = new FormData(form);
      formData.forEach((value, key) => {
        content[key] = value;
      });

      // Send data to webhook async
      let response = await fetch(form.action, {
        method: "POST",
        body: JSON.stringify(content),
        headers: {
          "Content-Type": "application/json",
        },
      }).catch((error) => {
        console.error("Error:", error);
      });
      let data = await response.json();
      if (!data.next) {
        data.next = form.nextElementSibling.dataset.stepId
      }

      form.classList.add("hidden");

      let nextStep = document.querySelector(
        ".rpc-cta-step[data-step-id='" + data.next + "']"
      );
      console.log(data.next);
      nextStep.classList.remove("hidden");


      contentElement.innerHTML = JSON.stringify(content);
      removeLoader(loader);
    });
  });
}


function addLoader() {
  let loader = document.createElement("div");
  loader.classList.add("rpc-form-loader");
  loader.innerHTML = `
    <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    `;
  document.body.appendChild(loader);
  setTimeout(() => {
    loader.style.opacity = 1;
  }, 100);
  return loader;
}


function removeLoader(loader) {
  loader.style.opacity = 0;
  setTimeout(() => {
    loader.remove();
  }, 500);
}


if (document.querySelector(".share-buttons .rpc-button")) {
  let shareButtons = document.querySelectorAll(".share-buttons .rpc-button");
  shareButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      let type = button.dataset.type;
      let url = window.location.href;
      let shareText = button.closest(".share-buttons").dataset.sharetext;
      let shareUrl = "";
      switch (type) {
        case "facebook":
          shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
          break;
        case "whatsapp":
          shareUrl = `https://api.whatsapp.com/send?text=${shareText} ${url}`;
          break;
        case "telegram":
          shareUrl = `https://t.me/share/url?url=${url}&text=${shareText}`;
          break;
        case "email":
          shareUrl = `mailto:?subject=${shareText}&body=${url}`;
          break;
        default:
          break;
      }
      window.open(shareUrl, "_blank");
    });
  });
}
