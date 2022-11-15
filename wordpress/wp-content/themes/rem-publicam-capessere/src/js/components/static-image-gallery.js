import Splide from "@splidejs/splide";
import "@splidejs/splide/css";
import "./static-image-gallery.scss";

if (document.querySelector(".rpc-static-image-gallery .splide")) {
  const splideController = new Splide(".rpc-static-image-gallery .splide", {
    type: "loop",
    perPage: 3,
    perMove: 1,
    gap: "1rem",
    arrows: false,
    autoplay: true,
    interval: 8000,
    pauseOnHover: true,
    drag: false,
    focus: "center",
    breakpoints: {
      520: {
        perPage: 1,
      },
      680: {
        perPage: 2,
      },
    },
  }).mount();

  document
    .querySelectorAll(".rpc-static-image-gallery__slide img")
    .forEach((img) => {
      img.addEventListener("click", () => {
        var splide = img.closest(".rpc-static-image-gallery__slide");
        if (splide.classList.contains("is-next")) {
          splideController.go(">");
        } else if (splide.classList.contains("is-prev")) {
          splideController.go("<");
        }
      });
    });
}
