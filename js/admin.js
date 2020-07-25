let adminbtnk = document.querySelector('.admin-korisnici');
let korisniciP = document.querySelector('.korisnici-panel');
adminbtnk.addEventListener('click', () => {
  if (korisniciP.style.display === 'none') {
    korisniciP.style.display = 'grid';
  } else korisniciP.style.display = 'none';
});

let adminbtnp = document.querySelector('.admin-proizvodi');
let proizvodiP = document.querySelector('.proizvodi-panel');
adminbtnp.addEventListener('click', () => {
  if (proizvodiP.style.display === 'none') {
    proizvodiP.style.display = 'grid';
  } else proizvodiP.style.display = 'none';
});
