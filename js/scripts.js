let btn = document.querySelector('.dropBtn');
let dropdown = document.querySelector('.dropdown-content');
function toggleMenu() {
  if (dropdown.style.display === 'none') {
    dropdown.style.display = 'flex';
  } else {
    dropdown.style.display = 'none';
  }
};
