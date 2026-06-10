<!DOCTYPE html>
<html>

<head>

<title>Data Laporan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Data Laporan Kerusakan</h2>

<a
href="<?= base_url('laporan/tambah')?>"
class="btn btn-primary mb-3">

Tambah Laporan

</a>

<table class="table table-bordered">

<thead>

<tr>

<th>Lokasi</th>
<th>Waktu</th>
<th>Jumlah</th>
<th>Status</th>
<th>Deskripsi</th>
<th>Foto</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php foreach($laporan as $row): ?>

<tr>

<td>
<?= $row->lokasi_fasilitas ?>
</td>

<td>
<?= $row->waktu_laporan ?>
</td>

<td>
<?= $row->jumlah_fasilitas_rusak ?>
</td>

<td>
<?= $row->status_kerusakan ?>
</td>

<td>
<?= $row->deskripsi ?>
</td>

<td>

<a
target="_blank"
href="<?= base_url('uploads/'.$row->foto_bukti) ?>">

Lihat

</a>

</td>

<td>

<a
href="<?= base_url('laporan/edit/'.$row->id) ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="<?= base_url('laporan/hapus/'.$row->id) ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</a>

</td>


</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</body>

</html>