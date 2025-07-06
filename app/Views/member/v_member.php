<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>
            <div class="card-tools">
                <button class="btn btn-tool" data-toggle="modal" data-target="#add-member"><i class="fas fa-plus"></i> Tambah Data</button>
                <button class="btn btn-tool" data-toggle="modal" data-target="#import-member">
                    <i class="fas fa-file-excel"></i> Import Excel
                </button>
            </div>
        </div>

        <div class="card-body">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <?php
                $pesan = session()->getFlashdata('pesan');
                $alertClass = ($pesan == 'Kode Member sudah digunakan!') ? 'alert-danger' : 'alert-success';
                ?>
                <div class="alert <?= $alertClass ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas <?= $alertClass == 'alert-danger' ? 'fa-ban' : 'fa-check' ?>"></i>
                        <?= $pesan ?>
                    </h5>
                </div>
            <?php endif; ?>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode Member</th>
                        <th>Nama Member</th>
                        <th>Alamat</th>
                        <th>Total Poin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($member as $m): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $m['kode_member'] ?></td>
                            <td><?= $m['nama_member'] ?></td>
                            <td><?= $m['alamat'] ?></td>
                            <td class="text-center"><?= $m['total_poin'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-member<?= $m['id_member'] ?>"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-member<?= $m['id_member'] ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="edit-member<?= $m['id_member'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <?= form_open('Member/UpdateData/' . $m['id_member']) ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Member</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Kode Member</label>
                                            <input name="kode_member" value="<?= $m['kode_member'] ?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Member</label>
                                            <input name="nama_member" value="<?= $m['nama_member'] ?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input name="alamat" value="<?= $m['alamat'] ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-warning" type="submit">Update</button>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="delete-member<?= $m['id_member'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Member</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah yakin ingin menghapus <strong><?= $m['nama_member'] ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <a href="<?= base_url('Member/DeleteData/' . $m['id_member']) ?>" class="btn btn-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="add-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open('Member/InsertData') ?>
            <div class="modal-header">
                <h5 class="modal-title">Tambah Member</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Member</label>
                    <input name="kode_member" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nama Member</label>
                    <input name="nama_member" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input name="alamat" class="form-control" required>
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

<!-- Modal Import Excel -->
<div class="modal fade" id="import-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open_multipart('Member/ImportExcel') ?>
            <div class="modal-header">
                <h5 class="modal-title">Import Member via Excel</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>File Excel (.xlsx/.xls)</label>
                    <input type="file" name="file_excel" accept=".xlsx,.xls" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Import</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "info": true,
            "ordering": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    $('#add-member').on('keypress', 'input', function (e) {
        if (e.which === 13) {
            e.preventDefault(); // cegah default behavior
            $(this).closest('form').submit(); // paksa submit
        }
    });
</script>