<?php
include('classes/Pengarang.php');

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
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>Dashboard Template for Bootstrap</title>

		<!-- Bootstrap core CSS -->
		<link href="bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="dashboard.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Project name</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Dashboard</a></li>
						<li><a href="#">Settings</a></li>
						<li><a href="#">Profile</a></li>
						<li><a href="#">Help</a></li>
					</ul>
					<form class="navbar-form navbar-right">
						<input type="text" class="form-control" placeholder="Search...">
					</form>
				</div>
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li class="active"><a href="index.php">Pengarang</a></li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h3 class="page-header">Daftar Pengarang</h3>

					<div class="row">
						<?php if(isset($edit_result) && $edit_result != false): ?>
						<div id="formEdit" style="margin: 10px 0;">
							<form action="index.php" method="post" onsubmit="return confirm('Are you sure?')">
								<div class="form-group">
									<label>Nama</label>
									<input class="form-control" type="text" name="nama" value="<?php echo $edit_result->nama; ?>">	
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<textarea class="form-control" name="alamat"><?php echo $edit_result->alamat; ?></textarea>
								</div>

								<input type="hidden" name="id" value="<?php echo $edit_result->id_pengarang; ?>">
								<input class="btn btn-success" type="submit" name="btn_update" value="Update">
							</form>
						</div>
						<?php else: ?>
						<div id="formTambah" style="margin: 10px 0;">
							<form action="index.php" method="post">
								<div class="form-group">
									<label>Nama</label>
									<input class="form-control" type="text" name="nama">
								</div>

								<div class="form-group">
									<label>Alamat</label>
									<textarea class="form-control" name="alamat"></textarea>
								</div>
								
								<input class="btn btn-success" type="submit" name="btn_submit" value="Simpan">
							</form>
						</div>

						<?php endif; ?>
					</div>

					<div class="table-responsive">
						<table class="table table-stripped">
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
										<form action="index.php" method="post">
											<input type="hidden" name="id_pengarang" value="<?php echo $pngrng->id_pengarang; ?>">
											<input class="btn btn-primary btn-xs" type="submit" name="btn_edit" value="Edit">					
										</form>

										<form action="index.php" method="post" onsubmit="return confirm('Are you sure?')">
											<input type="hidden" name="id_pengarang" value="<?php echo $pngrng->id_pengarang; ?>">
											<input class="btn btn-danger btn-xs" type="submit" name="btn_delete" value="Hapus">					
										</form>
									</td>
								</tr>
								<?php 
								endforeach; 
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="jquery.min.js"></script>
		<script src="bootstrap.min.js"></script>
		<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
		<script src="holder.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="ie10-viewport-bug-workaround.js"></script>

		<?php
		if(isset($save_result) && $save_result == true):
		?>
		<script>
			$(function(){
				alert('berhasil');
				document.location = "index.php";
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
				document.location = "index.php";
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
				document.location = "index.php";
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
				document.location = "index.php";
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
				document.location = "index.php";
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
				document.location = "index.php";
			});
		</script>

		<?php
		endif;
		?>
	</body>
</html>
