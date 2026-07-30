document.addEventListener("DOMContentLoaded", function () {
  const counters = document.querySelectorAll(".counter-number");

  const options = {
    root: null,
    rootMargin: "0px",
    threshold: 0.4
  };

  const startCounter = (counter) => {
    const target = +counter.dataset.target;
    const suffix = counter.dataset.suffix || "";
    let count = 0;
    const increment = Math.ceil(target / 100); // speed adjustment
    const step = () => {
      count += increment;
      if (count < target) {
        counter.innerText = count + suffix;
        requestAnimationFrame(step);
      } else {
        counter.innerText = target + suffix;
      }
    };
    step();
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        startCounter(entry.target);
        observer.unobserve(entry.target); 
      }
    });
  }, options);

  counters.forEach(counter => {
    observer.observe(counter);
  });
});

  /* ===============================
     VIDEO CAROUSEL RESET
  =============================== */

  const vidCarousel = document.getElementById("videoCarouselExample");

  if (vidCarousel) {
    vidCarousel.addEventListener("slide.bs.carousel", function () {
      const videos = vidCarousel.querySelectorAll("video");
      videos.forEach(video => {
        video.pause();
        video.currentTime = 0;
      });
    });
  }

  /* ===============================
     FOOTER YEAR AUTO UPDATE
  =============================== */

  const yearElement = document.getElementById("year");
  if (yearElement) {
    yearElement.textContent = new Date().getFullYear();
  }

  /* ===============================
     PAGINATION ACTIVE (FIXED)
  =============================== */

  document.addEventListener("DOMContentLoaded", function () {

  const pagination = document.querySelector(".custom-pagination");
  if (!pagination) return;

  let pages = Array.from(pagination.querySelectorAll("li:not(.prev):not(.next) a"));
  let prevBtn = pagination.querySelector(".prev a");
  let nextBtn = pagination.querySelector(".next a");

  let currentPage = window.location.pathname.split("/").pop();

  // default to first page if root
  if (currentPage === "" || currentPage === "/") {
    currentPage = "blog.html";
  }

  let currentIndex = pages.findIndex(link => link.getAttribute("href") === currentPage);

  // Highlight current page
  pages.forEach((link, index) => {
    link.parentElement.classList.remove("active");
    if (index === currentIndex) {
      link.parentElement.classList.add("active");
    }
  });

  // Set Prev button
  if (prevBtn) {
    if (currentIndex > 0) {
      prevBtn.setAttribute("href", pages[currentIndex - 1].getAttribute("href"));
    } else {
      prevBtn.parentElement.classList.add("disabled");
      prevBtn.setAttribute("href", "#");
    }
  }

  // Set Next button
  if (nextBtn) {
    if (currentIndex < pages.length - 1) {
      nextBtn.setAttribute("href", pages[currentIndex + 1].getAttribute("href"));
    } else {
      nextBtn.parentElement.classList.add("disabled");
      nextBtn.setAttribute("href", "#");
    }
  }

});




