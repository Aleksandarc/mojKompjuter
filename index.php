<?php include('includes/header.inc.php'); ?>
<div class="main-wrapper">

<div class="category-row1">
<div class="product-wrapper">

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
$i=0;

$sql = 'SELECT * FROM proizvodi ORDER BY sifraP DESC';
$rez = $conn->query($sql);
$resultCheck = mysqli_num_rows($rez);

if($resultCheck>0){
  while(($red = mysqli_fetch_assoc($rez)) && $i<10){
    $sifra = $red['sifraP'];
    $naziv = $red['nazivP'];
    $cena = $red['cenaP'];
    $opis = $red['opisP'];
    $kategorija = $red['kategorijaP'];
    $stanje = $red['stanjeP'];
    $slika = $red['slikaP'];
    $i++;
    // $cena = number_format($cena, 2,',','.');
    
    
    
    echo "<div class=\"main-product\">";
    echo "<a href=\"detalji.php?detalji=$sifra\">";
    echo "<img src=\"$slika\" alt=\"$naziv | MojKompjuter\">";
    echo "<p class=\"ime_proizvoda\">$naziv</p>";
    echo "<p class=\"cena_proizvoda\">$cena RSD</p>";
    ?>
    
    <form action="index.php?akcija=dodaj&id=<?= $sifra; ?>" method="post">
    <div class="class_dodaj_proizvod">
    <input name="dodaj-u-korpu" type="submit" class="dodaj_proizvod" value="Kupi">
    </input>
    <input type="hidden" name="nazivProizvoda" value="<?php echo "$naziv"; ?>">
    <input type="hidden" name="cenaProizvoda" value="<?php echo "$cena"; ?>">
    <input type="hidden" name="kolicinaProizvoda" value="1">
    </div>
    </form>
    
    <?php
    echo '</a></div>';
  }
}
else echo '<p>Baza je prazna trenutno!</p>';
?>
</>

</div>
</div>





<div class="placeholder_reklama">
<p class="placeholder_reklama_text">Ovde moze stajati Vaš oglas!</p>
</div>
</div>
<?php include('includes/footer.inc.php'); ?>