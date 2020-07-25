<?php
include('includes/header.inc.php');
?>
<div class="main-wrapper">

  <?php 
      require './includes/dbh.inc.php'; 
      if($conn->error){
        die("Greska: " . $mysqli->error);
      }
      if(isset($_GET['kategorija'])){
        $kategorija = $_GET['kategorija'];
        $sifra = '';
        $naziv = '';
        $cena = '';
        $opis = '';
        $stanje = '';
        $slika = '';
        
        $sql = "SELECT * FROM proizvodi WHERE kategorijaP = '$kategorija'";
        $rez = $conn->query($sql);
        $resultCheck = mysqli_num_rows($rez);

        echo "<h2 class=\"category-title\">$kategorija:</h2>";
        echo "<div class=\"product-wrapper\">";
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
          }?>
</div>

</div>



</div>
<div class="placeholder_reklama">
  <p class="placeholder_reklama_text">Ovde moze stajati Vaš oglas!</p>
</div>



<?php
                        include('includes/footer.inc.php');
                        ?>