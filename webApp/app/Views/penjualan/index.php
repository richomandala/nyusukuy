<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <a href="/penjualan/tambah" class="btn btn-primary my-2">Tambah penjualan</a>
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 10px;">No.</th>
                        <th>Kode penjualan</th>
                        <th>Nama pembeli</th>
                        <th>Produk</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($penjualan as $p) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['kode_penjualan']; ?></td>
                            <td><?= $p['pembeli']; ?></td>
                            <td>
                                <ul>
                                    <?php
                                    $produk_produk = explode(',', $p['produk_produk']);
                                    $jumlah_jumlah = explode(',', $p['jumlah_jumlah']);
                                    foreach ($produk_produk as $i => $produk) :
                                    ?>
                                        <li><?= $produk . ' (' . $jumlah_jumlah[$i] . ')'; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td>Rp. <?= number_format($p['total'], 2, ',', '.'); ?>,-</td>
                            <td>Rp. <?= number_format($p['bayar'], 2, ',', '.'); ?>,-</td>
                            <td>Rp. <?= number_format($p['kembali'], 2, ',', '.'); ?>,-</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>