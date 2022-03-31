function toggleMobileNav(mobileButton) {
  const scrollbar = document.querySelector(".scrollbar");
  if (scrollbar.classList.contains("menu-open")) {
    scrollbar.classList.add("menu-close");
    setTimeout(() => {
      scrollbar.classList.remove("menu-close");
    }, 750);
  }
  scrollbar.classList.toggle("menu-open");
  const mobileMenu = document.querySelector("#mobile-nav-wrapper");
  mobileMenu.classList.toggle("open");
  document.querySelector("html #main-content").classList.toggle("menu-open");
}

document
  .getElementById("mobile-menu-button")
  .addEventListener("click", function (e) {
    toggleMobileNav(e.target);
  });
