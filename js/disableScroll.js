// get DOM element
const menu = document.querySelector('#nav-toggle')
const body = document.body

menu.addEventListener('change', () => {
  // disable scrolling if the menu is open
  body.style.overflow = menu.checked ? 'hidden' : 'auto'
})
