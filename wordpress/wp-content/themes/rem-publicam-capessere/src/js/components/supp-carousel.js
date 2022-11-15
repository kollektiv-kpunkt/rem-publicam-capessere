import Splide from "@splidejs/splide";
import "@splidejs/splide/css";
import "./supp-carousel.scss";

if (document.querySelector(".rpc-supp-quotes .splide")) {
  const splideController = new Splide(".rpc-supp-quotes .splide", {
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

  document.querySelectorAll(".rpc-supp-testimonial-img").forEach((img) => {
    img.addEventListener("click", () => {
      var splide = img.closest(".rpc-supp-testimonial ");
      if (splide.classList.contains("is-next")) {
        splideController.go(">");
      } else if (splide.classList.contains("is-prev")) {
        splideController.go("<");
      }
    });
  });
}
