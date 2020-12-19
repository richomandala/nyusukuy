<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <a href="/inventaris/tambah" class="btn btn-primary my-2">Tambah inventaris</a>
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
                            <th>Kode inventaris</th>
                            <th>Nama barang</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($inventaris as $i) :
                        ?>
                            <tr>
                                <td>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox<?= $no; ?>" name="checkbox[]" value="<?= $i['id']; ?>">
                                        <label for="checkbox<?= $no; ?>" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td><?= $no; ?></td>
                                <td><?= $i['kode_inventaris']; ?></td>
                                <td><?= $i['barang']; ?></td>
                                <td><?= $i['keterangan']; ?></td>
                                <td><?= $i['jumlah']; ?></td>
                                <td><a href="/inventaris/ubah/<?= $i['kode_inventaris']; ?>" class="btn btn-sm btn-success">Ubah</a></td>
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