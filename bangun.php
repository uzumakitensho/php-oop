<?php
include('connect_mysql.php');

$pilihan = isset($_POST['pilihan']) ? $_POST['pilihan'] : null;

if(isset($_POST['submit_lingkaran'])){
	$jari = $_POST['jari'];
	if($jari == null || $jari == '' || !is_numeric($jari))
		$jari = 0;

	$volume = (4/3) * (22/7) * $jari * $jari * $jari;
	$luas = (22/7) * $jari * $jari;
}

if(isset($_POST['submit_kubus'])){
	$kubus_rusuk = $_POST['kubus_rusuk'];
	if($kubus_rusuk == null || $kubus_rusuk == '' || !is_numeric($kubus_rusuk))
		$kubus_rusuk = 0;

	$kubus_luas_sisi = $kubus_rusuk * $kubus_rusuk;
	$kubus_luas_permukaan = 6 * $kubus_rusuk * $kubus_rusuk;
	$kubus_keliling = 12 * $kubus_rusuk;
	$kubus_volume = $kubus_rusuk * $kubus_rusuk * $kubus_rusuk;
}

if(isset($_POST['submit_balok'])){
	$balok_panjang = $_POST['balok_panjang'];
	if($balok_panjang == null || $balok_panjang == '' || !is_numeric($balok_panjang))
		$balok_panjang = 0;

	$balok_lebar = $_POST['balok_lebar'];
	if($balok_lebar == null || $balok_lebar == '' || !is_numeric($balok_lebar))
		$balok_lebar = 0;

	$balok_tinggi = $_POST['balok_tinggi'];
	if($balok_tinggi == null || $balok_tinggi == '' || !is_numeric($balok_tinggi))
		$balok_tinggi = 0;

	$balok_luas_permukaan = 2 * (($balok_panjang * $balok_lebar) + ($balok_panjang * $balok_tinggi) + ($balok_lebar * $balok_tinggi));
	$balok_diagonal_ruang = sqrt(pow($balok_panjang, 2) + pow($balok_lebar, 2) + pow($balok_tinggi, 2));
	$balok_keliling = 4 * ($balok_panjang + $balok_lebar + $balok_tinggi);
	$balok_volume = $balok_panjang * $balok_lebar * $balok_tinggi;
}


// --------------------------------------

// if(dbConnect() == null)
// 	die('konyol');

// $db = dbConnect();
// $statement = $db->query('select * from pengarang;');

// while ($row = $statement->fetch())
// {
// 	echo $row['nama'] . "</br>";
// }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Lingkaran</title>
	<style type="text/css">
		.hidden{
			display: none;
		}
	</style>
</head>
<body>
	<div>
		<b>Pilih Bangun</b>
		<select name="pilih_bangun" id="pilih_bangun">
			<option 
			<?php
				if($pilihan == null)
					echo 'selected';
			?>
			>-- Pilih --</option>
			<option value="lingkaran" <?php
				if($pilihan == 'lingkaran')
					echo 'selected';
			?>
			>Lingkaran</option>
			<option value="kubus" <?php
				if($pilihan == 'kubus')
					echo 'selected';
			?>
			>Kubus</option>
			<option value="balok" <?php
				if($pilihan == 'balok')
					echo 'selected';
			?>
			>Balok</option>
		</select>
	</div>

	<div class="hidden" id="lingkaran">
		<h3>Lingkaran</h3>
		<form action="index.php" method="post">
			<input type="text" name="jari" placeholder="jari-jari"
			<?php
				if(isset($jari)){
					echo "value='" . $jari . "'";
				}
			?>
			>
			<input type="hidden" name="pilihan" value="lingkaran">
			<input type="submit" name="submit_lingkaran">
		</form>
		<?php
			if(isset($jari)){
				echo "jari-jari: <b>" . $jari . "</b></br>";
			}

			if(isset($volume)){
				echo "volume: <b>" . $volume . "</b></br>";
			}

			if(isset($luas)){
				echo "luas: <b>" . $luas . "</b></br>";
			}
		?>
	</div>

	<!-- ============== -->
	<br>
	<!-- ============== -->

	<div class="hidden" id="kubus">
		<h3>Kubus</h3>
		<form action="index.php" method="post">
			<input type="text" name="kubus_rusuk" placeholder="rusuk kubus"
			<?php
				if(isset($kubus_rusuk)){
					echo "value='" . $kubus_rusuk . "'";
				}
			?>
			>
			<input type="hidden" name="pilihan" value="kubus">
			<input type="submit" name="submit_kubus">
		</form>
		<?php
			if(isset($kubus_rusuk)){
				echo "rusuk kubus: <b>" . $kubus_rusuk . "</b></br>";
			}

			if(isset($kubus_luas_sisi)){
				echo "luas satu permukaan kubus: <b>" . $kubus_luas_sisi . "</b></br>";
			}

			if(isset($kubus_luas_permukaan)){
				echo "luas permukaan kubus: <b>" . $kubus_luas_permukaan . "</b></br>";
			}

			if(isset($kubus_keliling)){
				echo "keliling kubus: <b>" . $kubus_keliling . "</b></br>";
			}

			if(isset($kubus_volume)){
				echo "volume kubus: <b>" . $kubus_volume . "</b></br>";
			}
		?>
	</div>

	<!-- ============== -->
	<br>
	<!-- ============== -->

	<div class="hidden" id="balok">
		<h3>Balok</h3>
		<form action="index.php" method="post">
			<input type="text" name="balok_panjang" placeholder="panjang balok"
			<?php
				if(isset($balok_panjang)){
					echo "value='" . $balok_panjang . "'";
				}
			?>
			>
			<input type="text" name="balok_lebar" placeholder="lebar balok"
			<?php
				if(isset($balok_lebar)){
					echo "value='" . $balok_lebar . "'";
				}
			?>
			>
			<input type="text" name="balok_tinggi" placeholder="tinggi balok"
			<?php
				if(isset($balok_tinggi)){
					echo "value='" . $balok_tinggi . "'";
				}
			?>
			>
			<input type="hidden" name="pilihan" value="balok">
			<input type="submit" name="submit_balok">
		</form>
		<?php
			if(isset($balok_panjang)){
				echo "panjang balok: <b>" . $balok_panjang . "</b></br>";
			}

			if(isset($balok_lebar)){
				echo "lebar balok: <b>" . $balok_lebar . "</b></br>";
			}

			if(isset($balok_tinggi)){
				echo "tinggi balok: <b>" . $balok_tinggi . "</b></br>";
			}

			if(isset($balok_luas_permukaan)){
				echo "luas permukaan balok: <b>" . $balok_luas_permukaan . "</b></br>";
			}

			if(isset($balok_diagonal_ruang)){
				echo "diagonal ruang balok: <b>" . $balok_diagonal_ruang . "</b></br>";
			}

			if(isset($balok_keliling)){
				echo "keliling balok: <b>" . $balok_keliling . "</b></br>";
			}

			if(isset($balok_volume)){
				echo "volume balok: <b>" . $balok_volume . "</b></br>";
			}
		?>
	</div>

	<script src="jquery.min.js"></script>
	<script>
		$("#pilih_bangun").on('change', checkOption);
		
		function checkOption(){
			var option = $("#pilih_bangun").val();
			var lingkaran = $("#lingkaran");
			var kubus = $("#kubus");
			var balok = $("#balok");

			if(!lingkaran.hasClass('hidden'))
				lingkaran.addClass('hidden');
			if(!kubus.hasClass('hidden'))
				kubus.addClass('hidden');
			if(!balok.hasClass('hidden'))
				balok.addClass('hidden');

			if(option == 'lingkaran'){
				if(lingkaran.hasClass('hidden'))
					lingkaran.removeClass('hidden');
			}

			if(option == 'kubus'){
				if(kubus.hasClass('hidden'))
					kubus.removeClass('hidden');
			}

			if(option == 'balok'){
				if(balok.hasClass('hidden'))
					balok.removeClass('hidden');
			}
		}

		checkOption();
	</script>
</body>
</html>
