<?php
include('../../classes/Pengarang.php');

$pengarang = new Pengarang();

if(isset($_POST['btn_submit'])){
	$save_result = false;
	$input = [
		'nama' => $_POST['nama'],
		'alamat' => $_POST['alamat']
	];

	if(isset($_POST['nama']) && $_POST['nama'] != ''){
		$save_result = $pengarang->insert($input);
	}
}

if(isset($_POST['btn_delete'])){
	$delete_result = false;

	if(isset($_POST['id_pengarang']) && is_numeric($_POST['id_pengarang'])){
		$delete_result = $pengarang->delete($_POST['id_pengarang']);
	}
}

if(isset($_POST['btn_edit'])){
	$edit_result = false;

	if(isset($_POST['id_pengarang']) && is_numeric($_POST['id_pengarang'])){
		$edit_result = $pengarang->find($_POST['id_pengarang']);
	}
}

if(isset($_POST['btn_update'])){
	$update_result = false;
	$input_update = [
		'nama' => $_POST['nama'],
		'alamat' => $_POST['alamat']
	];

	if(isset($_POST['id']) && is_numeric($_POST['id']) && isset($_POST['nama']) && $_POST['nama'] != ''){
		$update_result = $pengarang->update($_POST['id'], $input_update);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar Pengarang</title>
	<style type="text/css">
		.hidden{
			display: none;
		}
	</style>
</head>
<body>
	<h3>Daftar Pengarang</h3>
	<?php if(isset($edit_result) && $edit_result != false): ?>
	<div id="formEdit" style="margin: 10px 0;">
		<form action="tampil.php" method="post" onsubmit="return confirm('Are you sure?')">
			<label>Nama</label>
			<input type="text" name="nama" value="<?php echo $edit_result->nama; ?>"><br>
			<label>Alamat</label>
			<textarea name="alamat"><?php echo $edit_result->alamat; ?></textarea><br>
			<input type="hidden" name="id" value="<?php echo $edit_result->id_pengarang; ?>">
			<input type="submit" name="btn_update" value="Update">
		</form>
	</div>
	<?php else: ?>
	<a href="#formTambah" id="btnTambah">Tambah</a>
	<div id="formTambah" style="margin: 10px 0;">
		<form action="tampil.php" method="post">
			<label>Nama</label>
			<input type="text" name="nama"><br>
			<label>Alamat</label>
			<textarea name="alamat"></textarea><br>
			<input type="submit" name="btn_submit" value="Simpan">
		</form>
	</div>

	<?php endif; ?>

	<table>
		<thead>
			<tr>
				<td>#</td>
				<td>Nama</td>
				<td>Alamat</td>
				<td>Aksi</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach($pengarang->get() as $key => $pngrng): 
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $pngrng->nama; ?></td>
				<td><?php echo $pngrng->alamat; ?></td>
				<td style="display: inline-flex;">
					<form action="tampil.php" method="post">
						<input type="hidden" name="id_pengarang" value="<?php echo $pngrng->id_pengarang; ?>">
						<input type="submit" name="btn_edit" value="Edit">					
					</form>

					<form action="tampil.php" method="post" onsubmit="return confirm('Are you sure?')">
						<input type="hidden" name="id_pengarang" value="<?php echo $pngrng->id_pengarang; ?>">
						<input type="submit" name="btn_delete" value="Hapus">					
					</form>
				</td>
			</tr>
			<?php 
			endforeach; 
			?>
		</tbody>
	</table>

	<script src="../../jquery.min.js"></script>

	<?php
	if(isset($save_result) && $save_result == true):
	?>
	<script>
		$(function(){
			alert('berhasil');
			document.location = "tampil.php";
		});
	</script>

	<?php
	endif;
	?>

	<?php
	if(isset($save_result) && $save_result != true):
	?>
	<script>
		$(function(){
			alert('gagal');
			document.location = "tampil.php";
		});
	</script>

	<?php
	endif;
	?>

	<!-- +++++++++++++++++++ -->

	<?php
	if(isset($delete_result) && $delete_result == true):
	?>
	<script>
		$(function(){
			alert('berhasil dihapus');
			document.location = "tampil.php";
		});
	</script>

	<?php
	endif;
	?>

	<?php
	if(isset($delete_result) && $delete_result != true):
	?>
	<script>
		$(function(){
			alert('gagal dihapus');
			document.location = "tampil.php";
		});
	</script>

	<?php
	endif;
	?>

	<!-- +++++++++++++++++++ -->

	<?php
	if(isset($update_result) && $update_result == true):
	?>
	<script>
		$(function(){
			alert('berhasil diubah');
			document.location = "tampil.php";
		});
	</script>

	<?php
	endif;
	?>

	<?php
	if(isset($update_result) && $update_result != true):
	?>
	<script>
		$(function(){
			alert('gagal diubah');
			document.location = "tampil.php";
		});
	</script>

	<?php
	endif;
	?>

</body>
</html>