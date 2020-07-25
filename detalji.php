<?php 
include_once './includes/header.inc.php'; 
include './includes/detalji.inc.php'; 
?>

<div class="container-detalji">
	<div class="slika-detalji">
		<img src="<?= $vslika; ?>">
	</div>
	<div class="informacije-detalji">
		<h2 class="naslov-detalji"><?= $vnaziv; ?></h2>

		<div class="detalji-row">
			<p class="paragraf-detalji sifra-detalji">Sifra proizvoda:<?= $vsifra; ?></p>
			<p class="paragraf-detalji">Kategorija proizvoda: <?= $vkategorija; ?></p>
		</div>
		<p class="paragraf-detalji"><?= $vopis; ?></p>

		<div class="detalji-row">
			<?= $vstanje; ?>
			<p class="paragraf-detalji detalji-cena">Cena je: <?= $vcena; ?> dinara.</p>
		</div>
		<div class="class_dodaj_proizvod">
			<a href="#">
				<button class="dodaj_proizvod"><i class="fas fa-shopping-cart\"></i>
					DODAJ U KORPU
				</button>
			</a>
		</div>
	</div>
</div>

<?php include_once './includes/footer.inc.php'; ?>