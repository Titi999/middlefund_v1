console.log('hello maltiti')

const dropdown = document.querySelector(`#avatar-dropdown`)
const dropdownbtn = document.querySelector(`#avatar-dropdown-btn`)

dropdownbtn.addEventListener('click', () => {
  if (dropdown.style.display === 'none') {
    dropdown.style.display = 'block'
  } else {
    dropdown.style.display = 'none'
  }
})
