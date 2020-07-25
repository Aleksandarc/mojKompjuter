<?php
if(isset($_POST['registracija-submit'])){
  
  require 'dbh.inc.php';
  
  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd2'];
  
  
  if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat) ){
    header("Location: ../registracija.php?greska=praznaPolja&uid=" .$username . "&email=" . $email);
    exit();
  }
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../registracija.php?greska=losemailkorisnickoime=");
    exit();
  }
  // ^^ Proverava da li su korisnicko ime i email losi, ako jesu ne vraca korisniku nista
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    header("Location: ../registracija.php?greska=losemail&uid=" .$username);
    exit();
  }
  // Proverava da li je email dobar, ako nije vraca korisniku email da ga ne bi kucao opet
  elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../registracija.php?greska=losekorisnickoime&mail=" .$email);
    exit();
  }
  // Proverava da li je korisnicko ime dobro, ako nije vraca korisnika sa emailom
  elseif($password !== $passwordRepeat){
    header("Location: ../registracija.php?greska=passwordProvera&uid=" .$username . "&email=" . $email);
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
      header("Location: ../registracija.php?greska=sqlgreska1");
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
        header("Location: ../registracija.php?greska=korisnickoZauzeto&mail" . $email);
        exit();
      }
      // ^^ Konacno proverava sa bazom dal i postoji trazeno korisnicko ime
      else {
        $sql = "INSERT INTO korisnici (uidKorisnik, emailKorisnik, pwdKorisnik) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        // ^^ Prirprema se unos u bazu podataka, ponovo koriscenjem placeholdera.
        
        if (!mysqli_stmt_prepare($stmt,$sql)){
          header("Location: ../registracija.php?greska=sqlgreska2");
          exit();
        }
        else{
          
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          // ^^ Hashuje password radi sigurnosti, pre unosa u bazu
          mysqli_stmt_bind_param($stmt,"sss", $username, $email, $hashedPwd);
          mysqli_stmt_execute($stmt);
          header("Location: ../registracija.php?registracija=uspesna");
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  
}
else{
  header("Location: ../registracija.php");
  exit();
}
