<!DOCTYPE html>
<html>

<head>

<title>Edit Laporan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Edit Laporan</h2>

<form
method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<label>Lokasi</label>

<input
type="text"
name="lokasi"
class="form-control"
value="<?= $laporan->lokasi_fasilitas ?>"
required>

</div>

<div class="mb-3">

<label>Waktu</label>

<input
type="datetime-local"
name="waktu"
class="form-control"
value="<?= date('Y-m-d\TH:i',strtotime($laporan->waktu_laporan)) ?>"
required>

</div>

<div class="mb-3">

<label>Jumlah Rusak</label>

<input
type="number"
name="jumlah_fasilitas_rusak"
class="form-control"
value="<?= $laporan->jumlah_fasilitas_rusak ?>"
required>

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"
required><?= $laporan->deskripsi ?></textarea>

</div>

<div class="mb-3">

<label>Foto Lama</label>

<br>

<img
src="<?= base_url('uploads/'.$laporan->foto_bukti) ?>"
width="200">

</div>

<div class="mb-3">

<label>Upload Foto Baru</label>

<input
type="file"
name="foto_bukti"
class="form-control">

</div>

<button
class="btn btn-warning">

Update

</button>

</form>

</div>

</body>

</html>