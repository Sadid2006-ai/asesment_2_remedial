<!DOCTYPE html>
<html>

<head>

<title>Tambah Laporan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Tambah Laporan</h2>

<form
method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<label>Lokasi Fasilitas</label>

<input
type="text"
name="lokasi"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Waktu Laporan</label>

<input
type="datetime-local"
name="waktu"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Jumlah Fasilitas Rusak</label>

<input
type="number"
name="jumlah_fasilitas_rusak"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"
required>
</textarea>

</div>

<div class="mb-3">

<label>Foto Bukti</label>

<input
type="file"
name="foto_bukti"
class="form-control"
required>

</div>

<button
class="btn btn-success">

Simpan

</button>

</form>

</div>

</body>

</html>