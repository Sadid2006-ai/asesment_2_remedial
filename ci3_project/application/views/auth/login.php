<!DOCTYPE html>
<html>

<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-4">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4>Login SmartCampus</h4>

</div>

<div class="card-body">

<?php if($this->session->flashdata('error')): ?>

<div class="alert alert-danger">

<?= $this->session->flashdata('error') ?>

</div>

<?php endif; ?>

<?php if($this->session->flashdata('success')): ?>

<div class="alert alert-success">

<?= $this->session->flashdata('success') ?>

</div>

<?php endif; ?>

<form method="POST">

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-primary w-100">

Login

</button>

</form>

<hr>

<a href="<?= base_url('register') ?>">

Belum punya akun?

Daftar disini

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>