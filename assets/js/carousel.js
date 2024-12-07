const track = document.querySelector(".carousel-track");
const slides = Array.from(track.children);
const nextButton = document.querySelector(".carousel-button.next");
const prevButton = document.querySelector(".carousel-button.prev");

let currentIndex = 0;
let slideWidth = slides[0].getBoundingClientRect().width; // Calculate slide width

// Function to update slide position
function updateSlidePosition() {
  track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

// Move to next slide
function moveToNextSlide() {
  currentIndex = (currentIndex + 1) % slides.length; // Loop back to first slide
  updateSlidePosition();
}

// Move to previous slide
function moveToPrevSlide() {
  currentIndex = (currentIndex - 1 + slides.length) % slides.length; // Loop back to last slide
  updateSlidePosition();
}

// Attach event listeners to buttons
nextButton.addEventListener("click", moveToNextSlide);
prevButton.addEventListener("click", moveToPrevSlide);

// Auto-play every 3 seconds
let autoplay = setInterval(moveToNextSlide, 5000);

// Pause autoplay on user interaction
[nextButton, prevButton].forEach(button => {
  button.addEventListener("click", () => {
    clearInterval(autoplay);
    autoplay = setInterval(moveToNextSlide, 5000); // Restart autoplay after interaction
  });
});

