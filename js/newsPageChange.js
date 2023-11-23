const prev = document.getElementById('prevPage')
const next = document.getElementById('nextPage')
const first = document.getElementById('firstPage')
const last = document.getElementById('lastPage')
const nav = document.getElementById('pageNav')
const news = document.querySelectorAll('.news')

const newsCount = news.length
let currentPage = 1
let newsPerPage = 2
const pageCount = Math.ceil(newsCount / newsPerPage)

const resetPage = (currentPage) => {
  nav.textContent = `第 ${currentPage} 頁 / 共 ${pageCount} 頁`

  news.forEach((ann, index) => {
    if (index >= currentPage * newsPerPage || index < (currentPage - 1) * newsPerPage) {
      ann.style.display = 'none'
    } else {
      ann.style.display = ''
    }
  })
}

resetPage(currentPage)

prev.addEventListener('click', () => {
  if (currentPage > 1) {
    currentPage -= 1
    resetPage(currentPage)
  }
})

next.addEventListener('click', () => {
  if (currentPage < pageCount) {
    currentPage += 1
    resetPage(currentPage)
  }
})

first.addEventListener('click', () => {
  if (currentPage != 1) {
    currentPage = 1
    resetPage(currentPage)
  }
})

last.addEventListener('click', () => {
  if (currentPage != pageCount) {
    currentPage = pageCount
    resetPage(currentPage)
  }
})