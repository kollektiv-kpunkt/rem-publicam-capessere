import whenInViewport from "when-in-viewport";

window.addEventListener("load", function () {
  var elements = Array.prototype.slice.call(
    document.querySelectorAll(".scrollAnimation")
  );

  elements.forEach(function (element) {
    new whenInViewport(element, function (elementInViewport) {
      let delay = parseInt(element.getAttribute("data-delay")) || 0;
      setTimeout(() => {
        elementInViewport.classList.add("inViewport");
      }, delay);
    });
  });
});
