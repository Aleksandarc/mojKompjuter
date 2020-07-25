<?php
session_start();
$product_ids = array();
// session_destroy();

//Proveri da li se pritisnulo dugme za dodavanje u korpu
if(filter_input(INPUT_POST, 'dodaj-u-korpu')){
  if(isset($_SESSION['korpa-proizvoda'])){

    $count = count($_SESSION['korpa-proizvoda']);
    // Prati koliko proizvoda je u korpi 
    $product_ids = array_column($_SESSION['korpa-proizvoda'], 'id');
    
    if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
      $_SESSION['korpa-proizvoda'][$count] = array
      (
        'id' => filter_input(INPUT_GET, 'id'),
        'nazivProizvoda' => filter_input(INPUT_POST, 'nazivProizvoda'),
        'cenaProizvoda' => filter_input(INPUT_POST, 'cenaProizvoda'),
        'kolicinaProizvoda' => filter_input(INPUT_POST, 'kolicinaProizvoda'),
      );
    }
    else{ //Else u slucaju da proizvod postoji, povecaj kolicinu
      // for petlja jednaci id proizvodu koji se dodaje u korpu
      for($i=0; $i<count($product_ids);$i++){
        if($product_ids[$i]==filter_input(INPUT_GET,'id')){
          $_SESSION['korpa-proizvoda'][$i]['kolicinaProizvoda']+=filter_input(INPUT_POST,'kolicinaProizvoda');
          // Povecava broj proizvoda u korpi
        }
        // Dodaje kolicinu proizvoda u postojecem elementu
      }
    }
  }
  else{ //AKo korpa proizvoda ne postoji, napravi prvi proizvod sa praznim array-om
    $_SESSION['korpa-proizvoda'][0] = array
    (
      //Ovaj input je get jer se on nalazi u naslovu sajta, umesto u post metodi
      'id' => filter_input(INPUT_GET, 'id'), 
      'nazivProizvoda' => filter_input(INPUT_POST, 'nazivProizvoda'),
      'cenaProizvoda' => filter_input(INPUT_POST, 'cenaProizvoda'),
      'kolicinaProizvoda' => filter_input(INPUT_POST, 'kolicinaProizvoda'),     
    );
  }
}
// pre_r($_SESSION);

function pre_r($array){
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
  content="MojKompjuter je stranica namenjna tačno za vaš kompjuter! Svi delovi koji su Vam potrebni, sa najboljim cenama!" />

  <title>MojKompjuter</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" href="./images/favicon.svg" type="image/x-icon" />
  <link rel="stylesheet" href="css/all.css" />
  <!--load all styles -->
</head>

<body>
  <header>
    <div class="left">
      <div class="logo">
        <a href="index.php"><img src="./images/logo.svg" alt="logo" /></a>
      </div>
<!-- <ul class="nav_cat">
<li><a href="#">Procesor</a></li>
<li class="noClick"> | </li>
<li><a href="#">Graficka</a></li>
<li class="noClick"> | </li>
<li><a href="#">Kuciste</a></li>
<li><a href="svi_proizvodi.php">Proizvodi</a></li>
</ul> -->
<a href="svi_proizvodi.php">Proizvodi</a>
</div>

<div class="nav-search">
  <form action="./pretraga.php" class="nav-search-form" method="POST">
    <input type="text" class="nav-search-text" name="pretraga" placeholder="Trazi">
    <input type="submit" class="nav-search-btn" name="nav-search-btn" value="Go" tabindex="20">
  </form>
</div>

<div class="login-nav">
  <button class="dropBtn" onclick="toggleMenu()">Nalog</button>
  <div class="dropdown-content" style="display:none;">
    <?php
    if(isset($_SESSION['korisnikId'])){
      echo '
      <form action="includes/odjava.inc.php" method="POST">
      <button type="submit" name="logout-submit" class="nav-button">Odjava</button>
      </form>
      ';
    }
    else{
      echo '
      <form action="includes/prijava.inc.php" method="POST">
      <input type="text" name="korisnicko" placeholder="Korisnicko ime">
      <input type="password" name="pwd" placeholder="Password">
      <button type="submit" name="login-submit" class="nav-button">Prijava</button>
      </form>
      <span>Nemate nalog?</span>
      <a href="registracija.php" class="navReg">Registracija</a>
      ';
    }
    ?>

  </div>
</div>
<a href="korpa.php" class="korpadropBtn">
  <div class="korpa-div">
    <span><i class="fas fa-cart-plus"></i></span>
    <label class="korpa-label">Korpa</label>
  </div>
  <div class="korpa-drop">
    <div class="table-korpe">
      <table class="korpa-table">
        <tr><th colspan="5"><h3>Detalji narudžbine</h3></th></tr>
        <tr>
          <th width="40%">Naziv proizvoda</th>
          <th width="10%">Kolicina</th>
          <th width="20%">Cena</th>
          <th width="15%">Total</th>
          <th width="5%">Akcija</th>
        </tr>

        <?php
        if(!empty($_SESSION['korpa-proizvoda']));

        $total = 0;
        foreach ($_SESSION['korpa-proizvoda'] as $key => $product):
          ?>
          <tr>
            <td><?php echo $product['nazivProizvoda']; ?></td>
            <td><?php echo $product['kolicinaProizvoda']; ?>?></td>
            <td><?php echo $product['cenaProizvoda']; ?></td>
            <td><?php echo $product['kolicinaProizvoda'] * $product['cenaProizvoda']; ?> </td>
            <td>
              <a href="index.php?action=obrisi&id=<?php echo $product['id'] ?>" class="akcija-dugme obrisi">Obrisi
              </a>
            </td>
          </tr>
          <?php
          $total = $total + ($product['kolicinaProizvoda'] * $product['cenaProizvoda']);
        endforeach;
        ?>
        <tr>
          <td colspan="3" align="right">Ukupna cena</td>
          <td align="right"><?php echo number_format($total,2); ?> dinara.</td>
          <td></td>
        </tr>
      </table>
    </div>
    <a href="korpa.php">Zavrsi kupovinu</a>

  </div>
</a>
</header>
<?php
if(isset($_SESSION['korisnikId'])){
  echo '<p class="login-status hidden">Prijavljeni ste!</p>';
}
else{
  echo '<p class="login-status hidden">Odjavljeni ste!</p>';
}
?>
<div id="main">