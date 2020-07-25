<?php
$vsifra = '';
$vnaziv = '';
$vslika = '';
$vcena = '';
$vopis = '';
$vkategorija = '';
$vstanje = '' ;

require 'dbh.inc.php';
if(isset($_GET['detalji'])){
	$sifra = $_GET['detalji'];
	$query = "SELECT * FROM proizvodi WHERE sifraP=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i",$sifra);
	$stmt->execute();
	$rezultat = $stmt->get_result();
	$red = $rezultat->fetch_assoc();

	$vsifra = $red['sifraP'];
	$vnaziv = $red['nazivP'];
	$vslika = $red['slikaP'];
	$vcena = $red['cenaP'];
	$vopis = $red['opisP'];
	$vkategorija = $red['kategorijaP'];
	$vstanje = '';
	if($red['stanjeP']>0){
		$vstanje = "<p class=\"green paragraf-detalji\">Ima ga na stanju.</p>";
	}else $vstanje = "<p class=\"red paragraf-detalji\">Nema ga na stanju.</p>";


}