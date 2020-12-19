<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <a href="/produk/tambah" class="btn btn-primary my-2">Tambah produk</a>
        <form id="formHapus">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px;">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                </div>
                            </th>
                            <th style="width: 10px;">No.</th>
                            <th>Kode produk</th>
                            <th>Nama produk</th>
                            <th>Bahan yang digunakan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($produk as $p) :
                        ?>
                            <tr>
                                <td>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox<?= $no; ?>" name="checkbox[]" value="<?= $p['id']; ?>">
                                        <label for="checkbox<?= $no; ?>" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td><?= $no; ?></td>
                                <td><?= $p['kode_produk']; ?></td>
                                <td><?= $p['produk']; ?></td>
                                <td>
                                    <ul>
                                        <?php
                                        $jumlah = explode(',', $p['jumlah_jumlah']);
                                        $satuan = explode(',', $p['satuan_satuan']);
                                        $bahan = explode(',', $p['bahan_bahan']);
                                        foreach ($bahan as $i => $b) :
                                        ?>
                                            <li><?= $b; ?> (<?= $jumlah[$i] . ' ' . $satuan[$i]; ?>)</li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>
                                <td>Rp. <?= number_format($p['harga'], 2, ',', '.'); ?>,-</td>
                                <td><a href="/produk/ubah/<?= $p['kode_produk']; ?>" class="btn btn-sm btn-success btn-ubah">Ubah</a></td>
                            </tr>
                        <?php
                            $no++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-danger btn-hapus">Hapus yang dipilih</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>