<?php

if(isset($_POST['login-submit'])){
  // ^^ Proverava da li je pritisnut login taster, odnosno dal i korisnik posteno dosao do ove stranice
  require 'dbh.inc.php';
  $korisnickoId = $_POST['korisnicko'];
  $password = $_POST['pwd'];
  // ^^ Dodeljuje vrednosti iz login headera

  if (empty($korisnickoId) || empty($password)) {
    header("Location: ../index.php?greska=praznaPolja");
    exit();
  }
  else{
    $sql = "SELECT * FROM korisnici WHERE uidKorisnik=?;";
    // ^^ statement za proveru, odnosno da li postoji korisnik sa tim korisnickim imenom ILI email adresom
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../index.php?greska=sqlgreska");
      exit();
    }
    // ^^ Ovaj gore if proverava da li stmt radi sa bazom
    else{
      mysqli_stmt_bind_param($stmt, "s", $korisnickoId);
      // ^^ Salje sql-u unesen email, a sql prihvata i testira da li se neki poklapa
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        $pwdCheck = password_verify($password, $row['pwdKorisnik']);
        // ^^ Proverava da li se pasword koji je korisnik uneo poklapa passwordu iz baze, automatski ga unhashuje i hashuje za proveru
        // --------------- DOLE JE PROVERA PASSWORD PRE LOGINA ---------------
        if($pwdCheck == false){
          header("Location: ../index.php?erorr=pogreskaSifra");
          exit();
        }
        else if($pwdCheck == true){
          session_start();
          $_SESSION['korisnikId'] = $row['idKorisnik'];
          $_SESSION['korisnikUid'] = $row['uidKorisnik'];
          // ^^ Pravi session za korisnika bazirano na id i Uid
          header("Location: ../index.php?login=uspesno");
          exit();

        }
        else{
          header("Location: ../index.php?greska=pogreskaSifra");
          exit();
        }
        // --------------- GORE JE PROVERA PASSWORD PRE LOGINA ---------------
      }
      else{
        header("Location: ../index.php?greska=nemaKorisnika");
        exit();
      }
      // ^^ Ovde se proverava da li baza vraca username/email koji se poklapaju ako ih ima, ako nema ide else
    }
  }

}

else{
  header("Location: ../index.php");
  exit();
}
// ^^ Vraca korisnika na index stranicu jer nije posteno dosao do ovog dela
