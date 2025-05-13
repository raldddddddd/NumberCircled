$(document).ready(function () {
    const $carousel = $('#carousel');
    const $wrapper = $('.carousel-track-wrapper');
    const cardWidth = 210; // 200px + 10px gap
    const scrollStep = cardWidth * 3;
    let scrollAmount = 0;

    $('#nextBtn').click(function () {
      const maxScroll = $carousel[0].scrollWidth - $wrapper.width();
      scrollAmount = Math.min(scrollAmount + scrollStep, maxScroll);
      $carousel.animate({ scrollLeft: scrollAmount }, 400);
    });

    $('#prevBtn').click(function () {
      scrollAmount = Math.max(scrollAmount - scrollStep, 0);
      $carousel.animate({ scrollLeft: scrollAmount }, 400);
    });
  });