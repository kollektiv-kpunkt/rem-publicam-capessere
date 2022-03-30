const NavbarWrapper = document.querySelector(".NavbarWrapper");
const scrollBar = NavbarWrapper.querySelector(".scrollbar");

if (window.scrollY > 80) {
  scrollBar.classList.add("scroll");
}

document.addEventListener("scroll", () => {
  if (window.scrollY < 0) {
    console.log("Fuck you Safari");
    return;
  }
  if (window.scrollY > this.oldScroll) {
    scrollBar.classList.add("hidescroll");
  } else {
    scrollBar.classList.remove("hidescroll");
  }
  if (window.scrollY > 80) {
    scrollBar.classList.add("scroll");
  } else {
    scrollBar.classList.remove("scroll");
    scrollBar.classList.remove("hidescrolll");
  }
  this.oldScroll = window.scrollY;
});
