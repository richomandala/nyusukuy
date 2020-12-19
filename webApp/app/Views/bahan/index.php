<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <a href="/bahan/tambah" class="btn btn-primary my-2">Tambah bahan</a>
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
                            <th>Kode bahan</th>
                            <th>Nama bahan</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($bahan as $b) :
                        ?>
                            <tr>
                                <td>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox<?= $no; ?>" name="checkbox[]" value="<?= $b['id']; ?>">
                                        <label for="checkbox<?= $no; ?>" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td><?= $no; ?></td>
                                <td><?= $b['kode_bahan']; ?></td>
                                <td><?= $b['bahan']; ?></td>
                                <td><?= number_format($b['stok'], 0, '', '.'); ?></td>
                                <td><?= $b['satuan']; ?></td>
                                <td><a href="/bahan/ubah/<?= $b['kode_bahan']; ?>" class="btn btn-sm btn-success btn-ubah">Ubah</a></td>
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