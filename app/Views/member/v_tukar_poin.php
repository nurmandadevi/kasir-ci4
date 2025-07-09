<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>
            <div class="card-tools">
                <button class="btn btn-tool" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('pesan')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('pesan') ?></div>
            <?php endif; ?>

            <table class="table table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode Member</th>
                        <th>Nama Member</th>
                        <th>Nama Hadiah</th>
                        <th>Jumlah Hadiah</th>
                        <th>Total Poin Dipakai</th>
                        <th>Tanggal Tukar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tukar as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['kode_member'] ?></td>
                            <td><?= $row['nama_member'] ?></td>
                            <td><?= $row['nama_hadiah'] ?></td>
                            <td><?= $row['jumlah_hadiah'] ?></td>
                            <td><?= $row['total_poin_dipakai'] ?></td>
                            <td><?= $row['tanggal_tukar'] ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('TukarPoin/DeleteData/' . $row['id_tukar']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>