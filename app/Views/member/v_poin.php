<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>

        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('pesan')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('pesan') ?></div>
            <?php endif; ?>

            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Member</th>
                        <th>Total Poin</th>
                        <th>Poin didapat</th>
                        <th>Poin Terpakai</th>
                        <th>Poin Sisa</th>
                        <th>waktu</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($poin as $p): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $p['nama_member'] ?? '-' ?></td>
                            <td><?= $p['total_poin_histori'] ?></td>
                            <td><?= $p['poin_didapat'] ?></td>
                            <td><?= $p['poin_terpakai'] ?></td>
                            <td><?= $p['poin_sisa'] ?></td>
                            <td><?= $p['waktu'] ?></td>

                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="edit<?= $p['id_poin'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <?= form_open('Poin/UpdateData/' . $p['id_poin']) ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Poin</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Member</label>
                                            <select name="id_member" class="form-control" required>
                                                <?php foreach ($member as $m): ?>
                                                    <option value="<?= $m['kode_member'] ?>" <?= $m['kode_member'] == $p['kode_member'] ? 'selected' : '' ?>>
                                                        <?= $m['nama_member'] ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Total Poin</label>
                                            <input type="number" name="total_poin" class="form-control" value="<?= $p['total_poin'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Poin Terpakai</label>
                                            <input type="number" name="poin_terpakai" class="form-control" value="<?= $p['poin_terpakai'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Poin Sisa</label>
                                            <input type="number" name="poin_sisa" class="form-control" value="<?= $p['poin_sisa'] ?>" required>
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
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>