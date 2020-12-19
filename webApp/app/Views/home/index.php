<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="alert alert-primary">Selamat datang, <?= getUser()['nama']; ?></div>

<?= $this->endSection(); ?>