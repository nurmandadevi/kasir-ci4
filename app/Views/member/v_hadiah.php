<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>
            <div class="card-tools">
                <button class="btn btn-tool" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Tambah Data</button>
            </div>
        </div>

        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5> </div>';
            }
            ?>

            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Hadiah</th>
                        <th>Jenis</th>
                        <th>Stok</th>
                        <th>Poin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($hadiah as $key => $value): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_hadiah'] ?></td>
                            <td><?= $value['jenis'] ?></td>
                            <td><?= $value['stok'] ?></td>
                            <td><?= $value['poin_dibutuhkan'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-data<?= $value['id_hadiah'] ?>"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-data<?= $value['id_hadiah'] ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open('Hadiah/InsertData') ?>
            <div class="modal-header"><h5>Tambah Hadiah</h5></div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Hadiah</label>
                    <input name="nama_hadiah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jenis</label>
                    <input name="jenis" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input name="stok" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Poin Dibutuhkan</label>
                    <input type="number" name="poin_dibutuhkan" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($hadiah as $key => $value): ?>
<div class="modal fade" id="edit-data<?= $value['id_hadiah'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open('Hadiah/UpdateData/' . $value['id_hadiah']) ?>
            <div class="modal-header"><h5>Edit Hadiah</h5></div>
            <div class="modal-body">
                <input type="hidden" name="id_hadiah" value="<?= $value['id_hadiah'] ?>">
                <div class="form-group">
                    <label>Nama Hadiah</label>
                    <input name="nama_hadiah" value="<?= $value['nama_hadiah'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jenis</label>
                    <input name="jenis" value="<?= $value['jenis'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input name="stok" value="<?= $value['stok'] ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Poin Dibutuhkan</label>
                    <input type="number" name="poin_dibutuhkan" value="<?= $value['poin_dibutuhkan'] ?>" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-warning" type="submit">Update</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php endforeach ?>

<!-- Modal Delete -->
<?php foreach ($hadiah as $key => $value): ?>
<div class="modal fade" id="delete-data<?= $value['id_hadiah'] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5>Hapus Hadiah</h5></div>
            <div class="modal-body">Yakin hapus <b><?= $value['nama_hadiah'] ?></b>?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <a href="<?= base_url('Hadiah/DeleteData/' . $value['id_hadiah']) ?>" class="btn btn-danger">Ya</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
