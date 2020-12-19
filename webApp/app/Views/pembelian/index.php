<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <a href="/pembelian/tambah" class="btn btn-primary my-2">Tambah pembelian</a>
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 10px;">No.</th>
                        <th>Kode pembelian</th>
                        <th>Supplier</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pembelian as $p) :
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $p['kode_pembelian']; ?></td>
                            <td><?= $p['supplier']; ?></td>
                            <td><?= $p['keterangan']; ?></td>
                            <td><a href="/pembelian/ubah/<?= $p['kode_pembelian']; ?>" class="btn btn-sm btn-success btn-ubah">Ubah</a></td>
                        </tr>
                    <?php
                        $no++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>