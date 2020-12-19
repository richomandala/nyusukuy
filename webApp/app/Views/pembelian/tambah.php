<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <form id="form">
            <div class="form-group">
                <label for="supplier">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="form-control" required>
                    <option value="">-- Pilih supplier --</option>
                    <?php foreach ($supplier as $s) : ?>
                        <option value="<?= $s['id']; ?>"><?= $s['supplier']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="bahan_id">Bahan</label>
                <small id="bahanHelp" class="form-text text-muted">Pilih bahan yang dibeli lalu klik tambahkan.</small>
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
                <table class="table table-bordered table-hover" id="tableModal">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama bahan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary btn-submit mr-2">Simpan</button>
            <a href="/pembelian" class="btn"><i class="fa fa-fw fa-chevron-circle-left"></i> Kembali</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>