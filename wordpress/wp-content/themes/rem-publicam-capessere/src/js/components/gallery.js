import Flickity from "flickity";

if (document.querySelector(".rpc-gallery-inner")) {
  document.querySelectorAll(".rpc-gallery-inner").forEach((gallery) => {
    let flck = new Flickity(gallery, {
      cellAlign: "left",
      contain: true,
      wrapAround: true,
    });
  });
}
