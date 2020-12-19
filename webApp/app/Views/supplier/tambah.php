<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <form id="form">
            <div class="form-group">
                <label>Supplier</label>
                <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Masukkan supplier" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="form-group">
                <label>Telp</label>
                <input type="tel" class="form-control" id="telp" name="telp" placeholder="Masukkan telp" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-submit mr-2">Simpan</button>
            <a href="/supplier" class="btn"><i class="fa fa-fw fa-chevron-circle-left"></i> Kembali</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>