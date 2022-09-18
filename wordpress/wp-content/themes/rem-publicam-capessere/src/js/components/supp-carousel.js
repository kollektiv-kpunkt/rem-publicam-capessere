import Splide from "@splidejs/splide";
import "@splidejs/splide/css";
import "./supp-carousel.scss";

if (document.querySelector(".splide")) {
  new Splide(".splide", {
    type: "loop",
    perPage: 3,
    perMove: 1,
    gap: "1rem",
    arrows: false,
    autoplay: true,
    interval: 8000,
    pauseOnHover: true,
    focus: "center",
    breakpoints: {
      520: {
        perPage: 1,
      },
      1080: {
        perPage: 2,
      },
    },
  }).mount();
}
