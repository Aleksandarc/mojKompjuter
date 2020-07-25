<?php require_once './admin/admin-action.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin stranica</title>
    <link rel="icon" href="./images/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="./css/admin-style.css">
</head>

<body>
    <nav class="admin-main-nav">
        <button class="admin-nav-btn admin-korisnici" onclick="dropMeni1()">Korisnici</button>
        <button class="admin-nav-btn admin-proizvodi" onclick="dropMeni2()">Proizvodi</button>
    </nav>

    <div class="korisnici-panel">
        <div class="korisnici-panel-unos">
            <h2>Unesi korisnika</h2>
            <form action="./admin/admin-action.php" method="POST" class="form-registracija">
                <input type="text" name="uid" placeholder="Korisničko ime">
                <input type="email" name="mail" placeholder="Vaša email adresa">
                <input type="password" name="pwd" placeholder="Lozinka">
                <input type="password" name="pwd2" placeholder="Ponovite lozinku">
                <button type="submit" name="registracija-submit">Unesi</button>
            </form>
        </div>

        <div class="korisnici-panel-prikaz">
            <h2>Korisnici u bazi</h2>
            <table class="korisnici-table">
                <tr>
                    <td>#</td>
                    <td>Korisničko ime</td>
                    <td>Email</td>
                    <td>Akcije</td>
                </tr>
                <?php 
                require './includes/dbh.inc.php'; 
                if($conn->error){
                  die("Greska: " . $mysqli->error);
              }
              $id ="";
              $uid="";
              $email="";

              $sql = 'SELECT * FROM korisnici';
              $rez = $conn->query($sql);
              $resultCheck = mysqli_num_rows($rez);

              if($resultCheck>0){
                  while($red = mysqli_fetch_assoc($rez)){
                    $id = $red['idKorisnik'];
                    $uid = $red['uidKorisnik'];
                    $email = $red['emailKorisnik'];
                    echo '<tr>';
                    ?>
                <td><?= $id; ?></td>
                <td><?= $uid; ?></td>
                <td><?= $email; ?></td>
                <td><a href="./admin/obrisi.php?obrisik=<?= $id ?>" class="akcija-dugme obrisi"
                        onclick="return confirm('Da li sigurno želite obrisati ovaj red?')">Obrisi</a>
                </td>
                <?php echo '</tr>';
                }
            }
            else echo '<p>Baza je prazna trenutno!</p>';
            ?>
            </table>
        </div>
    </div>


    <!-- ---------------------- PROIZVODI ---------------------- -->
    <div class="proizvodi-panel">
        <div class="proizvodi-panel-unos">
            <h2>Unesi proizvod</h2>
            <form action="./admin/admin-action.php" enctype="multipart/form-data" method="POST"
                class="form-registracija">
                <input type="hidden" name="pid" value="<?= $sifra ?>">
                <input type="text" name="nazivP" placeholder="Naziv proizvoda" value="<?= $naziv; ?>">
                <input type="text" name="cenaP" placeholder="Cena" value="<?= $cena; ?>">
                <input type="text" name="opisP" placeholder="Opis" value="<?= $opis; ?>">
                <input type="text" name="kategorijaP" placeholder="Kategorija" value="<?= $kategorija; ?>">
                <input type="text" name="stanjeP" placeholder="Kolicina na stanju" value="<?= $stanje; ?>">
                <input type="hidden" name="oldimage" value="<?= $slika ?>">
                <input type="file" name="image">
                <img src="<?= $slika ?>" width="120">
                <?php if($izmeni == true){ ?>
                <button type="submit" name="izmeni-proizvod" class="izmeni-proizvod">Izmeni</button>
                <?php } else { ?>
                <button type="submit" name="unesi-proizvod" class="unesi-proizvod">Unesi</button>
                <?php } ?>
            </form>
        </div>

        <div class="proizvod-panel-prikaz">
            <h2>Proizvodi u bazi</h2>
            <table class="proizvodi-table">
                <tr>
                    <td>Sifra</td>
                    <td>Slika</td>
                    <td>Naziv</td>
                    <td>Cena</td>
                    <td>Opis</td>
                    <td>Kategorija</td>
                    <td>Stanje</td>
                    <td>Akcije</td>
                </tr>
                <?php 
            require './includes/dbh.inc.php'; 
            if($conn->error){
              die("Greska: " . $mysqli->error);
          }


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
                echo '<tr>';
                ?>
                <td><?= $sifra; ?></td>
                <td><img src="<?= $slika; ?>"></td>
                <td><?= $naziv; ?></td>
                <td><?= $cena; ?></td>
                <td><?= $opis; ?></td>
                <td><?= $kategorija; ?></td>
                <td><?= $stanje; ?></td>
                <td><a href="detalji.php?detalji=<?= $sifra; ?>" class="akcija-dugme detalji">Detalji</a>
                    <a href="./admin/obrisi.php?obrisip=<?= $sifra ?>" class="akcija-dugme obrisi"
                        onclick="return confirm('Da li sigurno želite obrisati ovaj red?')">Obrisi</a>
                    <a href="./admin.php?izmenip=<?= $sifra; ?>" class="akcija-dugme izmeni">Izmeni</a></td>
                <?php echo '</tr>';
                    }
                }
                else echo '<p>Baza je prazna trenutno!</p>';
                ?>
            </table>
        </div>
    </div>
    <script src="./js/admin.js"></script>
</body>

</html>