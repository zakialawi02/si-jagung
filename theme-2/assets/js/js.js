var swiper = new Swiper(".mySwiper", {
  direction: "vertical",
  slidesPerView: 1,
  spaceBetween: 0,
  loop: true,
  mousewheel: false,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const playVideo = function () {
  const glightbox = GLightbox({
    selector: ".glightbox1",
    touchNavigation: true,
    loop: true,
    autoplayVideos: true,
  });
};
playVideo();

window.addEventListener("scroll", function () {
  var navbar = document.getElementById("navbar");
  if (window.pageYOffset > 10) {
    navbar.style.backgroundColor = "rgba(255, 255, 255, 1.0)";
    navbar.classList.add("sticky", "shadow");
  } else {
    navbar.style.backgroundColor = "rgba(255, 255, 255, 0)";
    navbar.classList.remove("sticky", "shadow");
  }
});
