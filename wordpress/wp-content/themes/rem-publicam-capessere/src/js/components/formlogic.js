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
  let url = form.getAttribute("data-endpoint");
  (async () => {
    const rawResponse = await fetch(url, {
      method: "POST",
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
  })();
}

function form2JSON(form) {
  let formData = new FormData(form);
  var obj = {};
  formData.forEach(function (value, key) {
    obj[key] = value;
  });
  return obj;
}
