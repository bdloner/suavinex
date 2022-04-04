// SCROLL FX

function isInViewport(el) {
  const rect = el.getBoundingClientRect();
  return rect.top <= (window.innerHeight || document.documentElement.clientHeight);
}

const elms = document.querySelectorAll("body.scroll-fx-auto .entry-content > *, body.scroll-fx-auto .gb-grid-column, body.scroll-fx-auto :not(.slider) > .content-item, body.scroll-fx-class .s-fx");

function scroll_fx() {
  elms.forEach(function (elm) {
    if (isInViewport(elm)) {
      elm.classList.add("-sh");
    } else {
      elm.classList.remove("-sh");
    }
  });
}
document.addEventListener("DOMContentLoaded", scroll_fx);
window.addEventListener("scroll", scroll_fx, { passive: true });
window.addEventListener("resize", scroll_fx, true);
