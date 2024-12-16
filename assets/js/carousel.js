const track = document.querySelector(".carousel-track");
const slides = Array.from(track.children);
const nextButton = document.querySelector(".carousel-button.next");
const prevButton = document.querySelector(".carousel-button.prev");

let currentIndex = 1;
let slideWidth = slides[0].getBoundingClientRect().width;

const firstClone = slides[0].cloneNode(true);
const lastClone = slides[slides.length - 1].cloneNode(true);

track.appendChild(firstClone);
track.insertBefore(lastClone, slides[0]);

function updateSlidePosition() 
{
  track.style.transition = 'transform 0.5s ease-in-out';
  track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

function moveToNextSlide() 
{
  currentIndex++;
  updateSlidePosition();
  if (currentIndex === slides.length + 1) 
  {
    setTimeout(() => 
    {
      track.style.transition = 'none';
      currentIndex = 1;
      track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }, 500);
  }
}

function moveToPrevSlide() 
{
  currentIndex--;
  updateSlidePosition();
  if (currentIndex === 0) 
    {
    setTimeout(() => 
    {
      track.style.transition = 'none';
      currentIndex = slides.length;
      track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    }, 500);
  }
}

nextButton.addEventListener("click", moveToNextSlide);
prevButton.addEventListener("click", moveToPrevSlide);

let autoplay = setInterval(moveToNextSlide, 3000);

[nextButton, prevButton].forEach(button => {
  button.addEventListener("click", () => {
    clearInterval(autoplay);
    autoplay = setInterval(moveToNextSlide, 3000);
  });
});

track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
