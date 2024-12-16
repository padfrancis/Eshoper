window.addEventListener("resize", () => {
  slideWidth = slides[0].getBoundingClientRect().width;
  updateSlidePosition();
});

const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");

hamburger.addEventListener("click", () => {
  navLinks.classList.toggle("active");
});
  