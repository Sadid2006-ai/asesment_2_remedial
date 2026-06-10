<!DOCTYPE html>
<html>

<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-dark bg-primary">

<div class="container-fluid">

<span class="navbar-brand">

SmartCampus Facility Report

</span>

<a
href="<?= base_url('logout') ?>"
class="btn btn-light">

Logout

</a>

</div>

</nav>

<div class="container mt-4">

<h2>
Selamat Datang,
<?= $this->session->userdata('nama') ?>
</h2>

<hr>

<div class="row">

    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Total Laporan</h5>
                <h2><?= $total ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Ringan</h5>
                <h2><?= $ringan ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5>Sedang</h5>
                <h2><?= $sedang ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5>Berat</h5>
                <h2><?= $berat ?></h2>
            </div>
        </div>
    </div>

</div>

<hr>

<a
href="<?= base_url('laporan') ?>"
class="btn btn-primary">

Kelola Laporan

</a>

</div>

</body>

</html>