<?php include('includes/header.inc.php'); 
include('includes/dbh.inc.php');
?>
<?php
if(isset($_POST['nav-search-btn'])){
  $pretraga = mysqli_real_escape_string($conn, $_POST['pretraga']);
  $sql = "SELECT * FROM proizvodi WHERE nazivP LIKE '%$pretraga%' or opisP LIKE '%$pretraga%'";
  $rezultat = mysqli_query($conn, $sql);
  $rezPretrage = mysqli_num_rows($rezultat);
  
  if($rezPretrage > 0){
    echo "<p class='rez-pretrage'>Nadjeno: $rezPretrage. proizvoda.</p>";
    echo '<div class="product-wrapper">';
    while($red = mysqli_fetch_assoc($rezultat)){
      $sifra = $red['sifraP'];
      $naziv = $red['nazivP'];
      $cena = $red['cenaP'];
      $opis = $red['opisP'];
      $kategorija = $red['kategorijaP'];
      $stanje = $red['stanjeP'];
      $slika = $red['slikaP'];
      $cena = number_format($cena, 2,',','.');
      
      
      echo "<div class=\"main-product\">";
      
      echo "<a href=\"detalji.php?detalji=$sifra\">";
      echo "<img src=\"$slika\" alt=\"$naziv | MojKompjuter\">";
      echo "<p class=\"ime_proizvoda\">$naziv</p>";
      echo "<p class=\"cena_proizvoda\">$cena RSD</p>";
      echo "
      <div class=\"class_dodaj_proizvod\">
      <a href=\"#\"><button class=\"dodaj_proizvod\">
      <i class=\"fas fa-shopping-cart\"></i>
      </a>
      </div>";
      echo '</a></div>';
      
    }
  }else {
    echo "<p class='rez-pretrage'>Nadjeno: $rezPretrage. proizvoda.</p>";
  }
  echo  '</div></div>';
}
else{
  header("Location: ./index.php");
}
?>
<?php include('includes/footer.inc.php'); ?>