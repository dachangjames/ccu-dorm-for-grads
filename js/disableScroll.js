// get DOM element
const menu = document.querySelector("#nav-toggle")

menu.addEventListener("change", () => {
  // disable scrolling if the menu is open
  document.body.style.overflow = menu.checked ? "hidden" : "auto"
})