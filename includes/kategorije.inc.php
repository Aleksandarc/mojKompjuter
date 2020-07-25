<?php
require  'dbh.inc.php';
if(isset($_GET['kategorija'])){
  $kategorija = $_GET['kategorija'];
	$query = "SELECT * FROM proizvodi WHERE kategorijaP=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s",$kategorija);
	$stmt->execute();
	$rezultat = $stmt->get_result();
	$red = $rezultat->fetch_assoc();

	$vsifra = $red['sifraP'];
	$vnaziv = $red['nazivP'];
	$vslika = $red['slikaP'];
	$vcena = $red['cenaP'];
	$vopis = $red['opisP'];
  
}