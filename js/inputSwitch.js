const inputSwitch = document.querySelectorAll('.input-switch')

inputSwitch.forEach((box) => {
  const checkbox = box.querySelector('input[type=checkbox]')
  const [label1, label2] = box.querySelectorAll('label')

  checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
      label1.classList.remove('selected')
      label2.classList.add('selected')
    } else {
      label1.classList.add('selected')
      label2.classList.remove('selected')
    }
  })
})
