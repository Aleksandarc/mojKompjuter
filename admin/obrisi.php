<?php
if(isset($_GET['obrisik'])){
  require '../includes/dbh.inc.php';
  $id = $_GET['obrisik'];
  //^^ uzima id koji je prosledjen kliktanjem dugmeta obrisi kako bi se napravio upit
  $query = 'DELETE FROM korisnici WHERE idKorisnik=?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i",$id);
  // Ovde se koristi "i" jer je id integer, dok se prethodno koristio S za string
  $stmt->execute();
  
  
  $_SESSIONS['odgovor']='Uspesno obrisano iz baze!';
  $_SESSIONS['tip_odg']='crveno';
  
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  header('location: ../admin.php');
  exit();
}
if(isset($_GET['obrisip'])){
  require '../includes/dbh.inc.php';
  $id = $_GET['obrisip'];
  //^^ uzima id koji je prosledjen kliktanjem dugmeta obrisi kako bi se napravio upit
  
  // ----------- KOD ISPOD BRISE SLIKU IZ FOLDERA
  $sql = "SELECT slikaP from proizvodi WHERE sifraP=?";
  $stmt2 = $conn->prepare($sql);
  $stmt2->bind_param("i",$id);
  $stmt2->execute();
  $rez2 = $stmt2->get_result();
  $red= $rez2->fetch_assoc();
  
  $imgpath='.' . $red['slikaP'];
  unlink($imgpath);
  // ----------- KOD IZNAD BRISE SLIKU IZ FOLDERA
  
  $query = 'DELETE FROM proizvodi WHERE sifraP=?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i",$id);
  // Ovde se koristi "i" jer je id integer, dok se prethodno koristio S za string
  $stmt->execute();
  
  
  $_SESSIONS['odgovor']='Uspesno obrisano iz baze!';
  $_SESSIONS['tip_odg']='crveno';
  
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  header('location: ../admin.php');
  exit();
}

// else{
  //   header("location:../admin.php");
  //   exit();
  // }