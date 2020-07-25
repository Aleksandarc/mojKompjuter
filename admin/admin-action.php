<?php
$izmeni = false;
$sifra = '';
$naziv = '';
$cena = '';
$opis = '';
$kategorija = '';
$stanje = '';
$slika = '';

$username = '';
$email = '';
$password = '';
$passwordRepeat = '';

if(isset($_POST['registracija-submit'])){

  require '../includes/dbh.inc.php';

  
  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd2'];
  
  
  if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat) ){
    header("Location: ../admin.php?greska=praznaPolja&uid=" .$username . "&email=" . $email);
    exit();
  }
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../admin.php?greska=losemailkorisnickoime=");
    exit();
  }
  // ^^ Proverava da li su korisnicko ime i email losi, ako jesu ne vraca korisniku nista
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    header("Location: ../admin.php?greska=losemail&uid=" .$username);
    exit();
  }
  // Proverava da li je email dobar, ako nije vraca korisniku email da ga ne bi kucao opet
  elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../admin.php?greska=losekorisnickoime&mail=" .$email);
    exit();
  }
  // Proverava da li je korisnicko ime dobro, ako nije vraca korisnika sa emailom
  elseif($password !== $passwordRepeat){
    header("Location: ../admin.php?greska=passwordProvera&uid=" .$username . "&email=" . $email);
    exit();
  }
  // ^^ Proverava da li su paswordi isti, ako nisu vraca korisnika nazad sa emailom i korisnickim imenom
  // Nikad ne vraca korisnika nazad sa passwordom jer bi se on nasao kao plaintext u URL-u browsera
  else{
    // ------------------ KOD ISPOD JE PROVERA DA LI JE KORISNICKO IME ZAUZETO, ALI KORISTI ODBRANU
    $sql = 'SELECT uidKorisnik FROM korisnici WHERE uidKorisnik=?;';
    // ^^ Znak ? se koristi kao placeholder, kao zastita od sql injection attacka
    $stmt = mysqli_stmt_init($conn);
    // ^^ Pravi statement
    if (!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../admin.php?greska=sqlgreska1");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, $username);
      // ^^ S je kakav se tip podatka prosledjuje, s je string, integer je i, blob = b, double = d
      // ^^ Ako se koristi vise od jednog placeholdera, dodaje se jos tipova nakon statement-a u zavisnosti od koliko je placeholdera
      // mysqli_stmt_bind_param($stmt,"ss"); primer da se unose 2 stringa
      // mysqli_stmt_execute($stmt);
      mysqli_stmt_execute($stmt);
      mysqli_store_result($stmt);
      $resultCheck = mysqli_num_rows($stmt);
      
      $sqlu = "SELECT uidKorisnik FROM korisnici WHERE uidKorisnik= '$username' ;";
      $rez = mysqli_query($conn,$sqlu);
      $count = mysqli_num_rows($rez);
      
      // ------------------ KOD ISPOD JE PROVERA DA LI JE KORISNICKO IME ZAUZETO, ALI KORISTI ODBRANU
      if($count > 0){
        header("Location: ../admin.php?greska=korisnickoZauzeto&mail" . $email);
        exit();
      }
      // ^^ Konacno proverava sa bazom dal i postoji trazeno korisnicko ime
      else {
        $sql = "INSERT INTO korisnici (uidKorisnik, emailKorisnik, pwdKorisnik) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        // ^^ Prirprema se unos u bazu podataka, ponovo koriscenjem placeholdera.
        
        if (!mysqli_stmt_prepare($stmt,$sql)){
          header("Location: ../admin.php?greska=sqlgreska2");
          exit();
        }
        else{

          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          // ^^ Hashuje password radi sigurnosti, pre unosa u bazu
          mysqli_stmt_bind_param($stmt,"sss", $username, $email, $hashedPwd);
          mysqli_stmt_execute($stmt);
          header("Location: ../admin.php?registracija=uspesna");
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
// -------------- UNOS PROIZVODA --------------
elseif(isset($_POST['unesi-proizvod'])){
  require '../includes/dbh.inc.php';
  
  $naziv = $_POST['nazivP'];
  $cena = $_POST['cenaP'];
  $opis = $_POST['opisP'];
  $kategorija = $_POST['kategorijaP'];
  $stanje = $_POST['stanjeP'];

  $photo = $_FILES['image']['name'];
  $upload="./images/products/".$photo;
  
  if(empty($naziv) || empty($cena) || empty($opis) || empty($kategorija) || empty($stanje)){
    header("Location: ./admin.php?greska=praznaPolja");
    exit();
  }
  elseif(!preg_match("/^[0-9]*$/", $stanje)){
    header("Location: ./admin.php?greska=losestanje");
    exit();
  }
  else{
    $query = "INSERT INTO proizvodi(nazivP, slikaP,opisP,kategorijaP,cenaP,stanjeP) VALUES(?,?,?,?,?,?)";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("ssssii", $naziv, $upload, $opis, $kategorija, $cena, $stanje);
    $stmt->execute();
    move_uploaded_file($_FILES['image']['tmp_name'], "../images/products/$photo");

    header('location:../admin.php');
  }
  
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

elseif(isset($_GET['izmenip'])){
  $sifra = $_GET['izmenip'];
  require './includes/dbh.inc.php';
  $izmeni = true;


  $query = 'SELECT * FROM proizvodi WHERE sifraP=?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i",$sifra);
  $stmt->execute();

  $rezultat = $stmt->get_result();
  $red = $rezultat->fetch_assoc();

  $sifra = $red['sifraP'];
  $naziv = $red['nazivP'];
  $cena = $red['cenaP'];
  $opis = $red['opisP'];
  $kategorija = $red['kategorijaP'];
  $stanje = $red['stanjeP'];
  $slika = $red['slikaP'];
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

elseif(isset($_POST['izmeni-proizvod'])){
  $sifra = $_POST['pid'];
  require '../includes/dbh.inc.php';

  $naziv = $_POST['nazivP'];
  $cena = $_POST['cenaP'];
  $opis = $_POST['opisP'];
  $kategorija = $_POST['kategorijaP'];
  $stanje = $_POST['stanjeP'];
  $oldimage = $_POST['oldimage'];

  if(isset($_FILES['image']['name']) && ($_FILES['image']['name']!="")){
    $newimage = './images/products/' . $_FILES['image']['name'];
    unlink('.' . $oldimage);
    move_uploaded_file($_FILES['image']['tmp_name'], ".$newimage");
  }else{
    $newimage = $oldimage;
  }

  $query = 'UPDATE proizvodi SET nazivP=?,slikaP=?,opisP=?,kategorijaP=?,cenaP=?,stanjeP=? WHERE sifraP=?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ssssiii",$naziv,$newimage,$opis,$kategorija,$cena,$stanje,$sifra);
  $stmt->execute();

  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  header('location: ../admin.php');
  exit();
}

// else{
//   header('location:../admin.php');
//   exit();
// }

