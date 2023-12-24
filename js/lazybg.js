const img = body.querySelector('#background')

const loaded = () => {
  body.classList.add('loaded')
}

if (img.complete) {
  loaded()
} else {
  img.addEventListener('load', loaded)
}
