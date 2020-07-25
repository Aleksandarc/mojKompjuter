<?php
include('includes/header.inc.php');
?>
<div class="category-nav">
  <ul class="side-category-nav">
    <?php 
    require './includes/dbh.inc.php'; 
    if($conn->error){
      die("Greska: " . $mysqli->error);
    }     
    $kategorija = '';
    
    $sql = 'SELECT DISTINCT kategorijaP FROM proizvodi';
    $rez = $conn->query($sql);
    $resultCheck = mysqli_num_rows($rez);
    
    if($resultCheck>0){
      while($red = mysqli_fetch_assoc($rez)){
        $kategorija = $red['kategorijaP'];
        echo "<a href=\"./kategorije.php?kategorija=$kategorija\"><li>$kategorija</li></a>";
      }}
      else echo '<p>Baza je prazna trenutno!</p>';;
      ?>
  </ul>
</div>

<div class="main-wrapper">

  <h2 class="category-title">Proizvodi u ponudi</h2>

  <div class="product-wrapper product-wrapper-svi">

    <?php 
    require './includes/dbh.inc.php'; 
    if($conn->error){
      die("Greska: " . $mysqli->error);
    }
    $sifra = '';
    $naziv = '';
    $cena = '';
    $opis = '';
    $kategorija = '';
    $stanje = '';
    $slika = '';
    
    $sql = 'SELECT * FROM proizvodi';
    $rez = $conn->query($sql);
    $resultCheck = mysqli_num_rows($rez);
    
    if($resultCheck>0){
      while($red = mysqli_fetch_assoc($rez)){
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
        }
        else echo '<p>Baza je prazna trenutno!</p>';
        ?>
  </div>

</div>



</div>
<div class="placeholder_reklama placeholder_reklama-svi">
  <p class="placeholder_reklama_text placeholder_reklama_text-svi">Ovde moze stajati Vaš oglas!</p>
</div>

<?php
  include('includes/footer.inc.php');
  ?>