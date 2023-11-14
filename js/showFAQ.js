const questions = document.querySelectorAll('.pg_faq > ul > li:nth-child(2n + 1)')
const answers = document.querySelectorAll('.pg_faq > ul > li:nth-child(2n)')

answers.forEach((ans) => {
  ans.style.display = 'none'
})

questions.forEach((qus) => {
  qus.classList.add('link')
  qus.style.cursor = 'pointer'

  qus.addEventListener('click', () => {
    const ans = qus.nextElementSibling
    if (ans.style.display === 'none') {
      ans.style.display = 'block'
    } else {
      ans.style.display = 'none'
    }
  })
})
