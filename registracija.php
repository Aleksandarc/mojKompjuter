<?php
include("./includes/header.inc.php");
?>

<main>
  <div class="wrapper-register">
    <h1>Registracija</h1>
    <?php
    if (isset($_GET['greska'])) {
      if ($_GET['greska'] == 'praznaPolja') {
        echo '<p class="prijavagreska">Popunite sva polja!</p>';
      }
      // ^^ Proverava da li su polja prazna, i ako jesu izbacuje text ako jesu
      elseif ($_GET['greska'] == 'losemailkorisnickoime') {
        echo '<p class="prijavagreska">Unešeni email i korisnicko ime nisu dobri!</p>';
      }
      elseif ($_GET['greska'] == 'losemail') {
        echo '<p class="prijavagreska">Unešen email nije dobar!</p>';
      }
      elseif ($_GET['greska'] == 'losekorisnickoime') {
        echo '<p class="prijavagreska">Unešeno korisničko ime nije dobro!</p>';
      }
      elseif ($_GET['greska'] == 'passwordProvera') {
        echo '<p class="prijavagreska">Passwordi se ne poklapaju!</p>';
      }
      elseif ($_GET['greska'] == 'korisnickoZauzeto') {
        echo '<p class="prijavagreska">Korisničko ime zauzeto!</p>';
      }
      
    }
    elseif (isset($_GET['registracija'])) {
      if($_GET['registracija'] == 'uspesna'){
        echo '<p class="prijavauspesna">Uspešno ste se prijavili!</p>';
      }
    }
    ?>
    <form action="./includes/registracija.inc.php" method="POST" class="form-registracija">
      <input type="text" name="uid" placeholder="Korisničko ime">
      <input type="email" name="mail" placeholder="Vaša email adresa">
      <input type="password" name="pwd" placeholder="Lozinka">
      <input type="password" name="pwd2" placeholder="Ponovite lozinku">
      <button type="submit" name="registracija-submit">Registruj se</button>
    </form>
  </div>
</main>

<?php
include("./includes/footer.inc.php");
?>