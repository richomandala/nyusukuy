<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <form id="form" action="/penjualan/save" method="post">
            <input type="hidden" name="pembelian_id" id="pembelian_id">
            <div class="form-group">
                <label for="pembeli">Pembeli</label>
                <input type="text" name="pembeli" id="pembeli" class="form-control" placeholder="Masukkan nama pembeli" required>
            </div>
            <div class="form-group">
                <label for="produk">Produk</label>
                <small id="produkHelp" class="form-text text-muted">Pilih produk yang dibeli lalu klik tambahkan.</small>
                <div class="input-group">
                    <select name="produk" id="produk" class="form-control">
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produk as $p) : ?>
                            <option value="<?= $p['id']; ?>"><?= $p['produk']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="btn-tambahkan">Tambahkan</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tableTambah">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align: end;">Grand total</th>
                            <td colspan="2" id="total" style="text-align: start;"></td>
                        </tr>
                        <tr>
                            <th colspan="4" style="text-align: end;">Bayar</th>
                            <td colspan="2" style="text-align: start;">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp </span>
                                    </div>
                                    <input type="number" name="bayar" id="bayar" class="form-control" min="1" step="any" placeholder="Masukkan uang bayar">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: end;"><button type="submit" id="selesai" class="btn btn-primary">Selesai</button></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>