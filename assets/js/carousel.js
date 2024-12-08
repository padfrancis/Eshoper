const track = document.querySelector(".carousel-track");
const slides = Array.from(track.children);
const nextButton = document.querySelector(".carousel-button.next");
const prevButton = document.querySelector(".carousel-button.prev");

let currentIndex = 1; // Start from the first cloned slide
let slideWidth = slides[0].getBoundingClientRect().width; // Calculate slide width

// Clone first and last slides
const firstClone = slides[0].cloneNode(true);
const lastClone = slides[slides.length - 1].cloneNode(true);

track.appendChild(firstClone);
track.insertBefore(lastClone, slides[0]);

// Function to update slide position
function updateSlidePosition() {
  track.style.transition = 'transform 0.5s ease-in-out';
  track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

// Move to next slide
function moveToNextSlide() {
  currentIndex++;
  updateSlidePosition();
  if (currentIndex === slides.length + 1) {
    setTimeout(() => {
      track.style.transition = 'none';
      currentIndex = 1;
      track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }, 500);
  }
}

// Move to previous slide
function moveToPrevSlide() {
  currentIndex--;
  updateSlidePosition();
  if (currentIndex === 0) {
    setTimeout(() => {
      track.style.transition = 'none';
      currentIndex = slides.length;
      track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }, 500);
  }
}

// Attach event listeners to buttons
nextButton.addEventListener("click", moveToNextSlide);
prevButton.addEventListener("click", moveToPrevSlide);

// Auto-play every 5 seconds
let autoplay = setInterval(moveToNextSlide, 3000);

// Pause autoplay on user interaction
[nextButton, prevButton].forEach(button => {
  button.addEventListener("click", () => {
    clearInterval(autoplay);
    autoplay = setInterval(moveToNextSlide, 3000); // Restart autoplay after interaction
  });
});

// Initial position
track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
