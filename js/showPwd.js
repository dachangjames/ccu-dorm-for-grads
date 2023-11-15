const inputBox = document.querySelectorAll('.input-box')

inputBox.forEach((box) => {
  const pwd = box.querySelector('input[type=password]')

  if (pwd) {
    const show = box.querySelector('.bx-show')
    const hide = box.querySelector('.bx-hide')

    show.addEventListener('click', () => {
      show.style.display = 'none'
      hide.style.display = 'flex'
      pwd.type = 'text'
    })

    hide.addEventListener('click', () => {
      hide.style.display = 'none'
      show.style.display = 'flex'
      pwd.type = 'password'
    })
  }
})
