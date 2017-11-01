<?php
include('../../classes/Pengarang.php');

$pengarang = new Pengarang();
$input = [
	'nama' => 'hahaha',
	'alamat' => 'Mbuh aa'
];
print_r($pengarang->insert($input));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar Pengarang</title>
</head>
<body>
<h3>Daftar Pengarang</h3>
<a href="tambah.php">Tambah</a>
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
			<td>
				<a <?php echo 'href="edit.php?id_pengarang=' . $pngrng->id_pengarang . '"'; ?>
				>Edit</a>
				<a <?php echo 'href="hapus.php?id_pengarang=' . $pngrng->id_pengarang . '"'; ?>
				>Hapus</a>
			</td>
		</tr>
		<?php 
		endforeach; 
		?>
	</tbody>
</table>

</body>
</html>