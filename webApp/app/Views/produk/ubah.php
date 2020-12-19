<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <form id="form">
            <input type="hidden" name="produk_id" id="produk_id" value="<?= $produk['id']; ?>">
            <div class="form-group">
                <label>Produk</label>
                <input type="text" class="form-control" id="produk" name="produk" placeholder="Masukkan produk" value="<?= $produk['produk']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" class="form-control" id="harga" name="harga" step="any" min="1" placeholder="Masukkan harga" value="<?= $produk['harga']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="bahan_id">Bahan</label>
                <small id="bahanHelp" class="form-text text-muted">Pilih bahan yang digunakan lalu klik tambahkan.</small>
                <div class="input-group">
                    <select name="bahan_id" id="bahan_id" class="form-control">
                        <option value="">-- Pilih bahan --</option>
                        <?php foreach ($bahan as $b) : ?>
                            <option value="<?= $b['id']; ?>"><?= $b['bahan']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="btn-tambahkan">Tambahkan</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tableBahan">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama bahan</th>
                            <th>Jumlah yang digunakan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary btn-submit mr-2">Simpan</button>
            <a href="/produk" class="btn"><i class="fa fa-fw fa-chevron-circle-left"></i> Kembali</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>