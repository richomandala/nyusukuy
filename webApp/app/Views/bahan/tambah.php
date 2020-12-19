<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <form id="form">
            <div class="form-group">
                <label>Bahan</label>
                <input type="text" class="form-control" id="bahan" name="bahan" placeholder="Masukkan bahan" required>
            </div>
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <select name="satuan" id="satuan" class="form-control" required>
                    <option value="">-- Pilih satuan --</option>
                    <option value="ml">ml</option>
                    <option value="pcs">pcs</option>
                    <option value="gram">gram</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-submit mr-2">Simpan</button>
            <a href="/bahan" class="btn"><i class="fa fa-fw fa-chevron-circle-left"></i> Kembali</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>