<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <form id="form">
            <div class="form-group">
                <label>Nama barang</label>
                <input type="text" class="form-control" id="barang" name="barang" placeholder="Masukkan nama barang" required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" required>
            </div>
            <div class="form-group">
                <label>jumlah</label>
                <input type="number" class="form-control" step="any" min="1" id="jumlah" name="jumlah" placeholder="Masukkan jumlah" required>
            </div>
            <button type="submit" class="btn btn-primary btn-submit mr-2">Simpan</button>
            <a href="/inventaris" class="btn"><i class="fa fa-fw fa-chevron-circle-left"></i> Kembali</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>