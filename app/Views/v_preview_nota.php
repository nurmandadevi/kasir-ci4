<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Nota - <?= $no_faktur ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nota-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            background: #f8f9fa;
        }
        
        .nota-preview {
            background: white;
            padding: 20px;
            border-radius: 5px;
            font-size: 12px;
            line-height: 1.4;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }
        
        .header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        
        .header p {
            margin: 2px 0;
            font-size: 11px;
        }
        
        .info-section {
            margin: 15px 0;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        
        .items-table th,
        .items-table td {
            border: none;
            padding: 3px;
            font-size: 11px;
            text-align: left;
        }
        
        .items-table th {
            border-bottom: 1px dashed #000;
            font-weight: bold;
        }
        
        .items-table .text-right {
            text-align: right;
        }
        
        .items-table .text-center {
            text-align: center;
        }
        
        .total-section {
            border-top: 1px dashed #000;
            padding-top: 10px;
            margin-top: 15px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
        }
        
        .grand-total {
            font-weight: bold;
            font-size: 13px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
        
        .thank-you {
            text-align: center;
            margin-top: 15px;
            font-size: 10px;
            font-style: italic;
        }
        
        .btn-group {
            text-align: center;
            margin: 20px 0;
        }
        
        .btn-print {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            margin: 0 5px;
        }
        
        .btn-print:hover {
            background: #218838;
        }
        
        .btn-back {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            margin: 0 5px;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-back:hover {
            background: #545b62;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="nota-container">
                    <div class="btn-group">
                        <a href="<?= base_url('Transaksi/CetakNota/' . $no_faktur) ?>" class="btn-print" target="_blank">
                            📄 Cetak Nota
                        </a>
                        <a href="<?= base_url('Transaksi') ?>" class="btn-back">
                            ← Kembali
                        </a>
                    </div>
                    
                    <div class="nota-preview">
                        <div class="header">
                            <h3>PONDOK PESANTREN</h3>
                            <h3>MAMBAUL HIKAM</h3>
                            <p>Jl. Alamat Pesantren</p>
                            <p>Telp: (0341) 123456</p>
                        </div>

                        <div class="info-section">
                            <div class="info-row">
                                <span>No. Faktur:</span>
                                <span><strong><?= $no_faktur ?></strong></span>
                            </div>
                            <div class="info-row">
                                <span>Tanggal:</span>
                                <span><?= date('d/m/Y', strtotime($transaksi['tgl_jual'])) ?></span>
                            </div>
                            <div class="info-row">
                                <span>Jam:</span>
                                <span><?= $transaksi['jam'] ?></span>
                            </div>
                            <div class="info-row">
                                <span>Kasir:</span>
                                <span><?= session()->get('nama_user') ?? 'Admin' ?></span>
                            </div>
                            <?php if (!empty($transaksi['kode_member'])): ?>
                            <div class="info-row">
                                <span>Member:</span>
                                <span><?= $transaksi['kode_member'] ?></span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <table class="items-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rinci as $item): ?>
                                <tr>
                                    <td><?= $item['nama_produk'] ?></td>
                                    <td class="text-center"><?= $item['qty'] ?></td>
                                    <td class="text-right"><?= number_format($item['harga'], 0, ',', '.') ?></td>
                                    <td class="text-right"><?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="total-section">
                            <div class="total-row">
                                <span>Subtotal:</span>
                                <span>Rp <?= number_format($transaksi['grand_total'], 0, ',', '.') ?></span>
                            </div>
                            <div class="total-row grand-total">
                                <span>TOTAL:</span>
                                <span>Rp <?= number_format($transaksi['grand_total'], 0, ',', '.') ?></span>
                            </div>
                            <div class="total-row">
                                <span>Dibayar:</span>
                                <span>Rp <?= number_format($transaksi['dibayar'], 0, ',', '.') ?></span>
                            </div>
                            <div class="total-row">
                                <span>Kembalian:</span>
                                <span>Rp <?= number_format($transaksi['kembalian'], 0, ',', '.') ?></span>
                            </div>
                            <?php if (!empty($transaksi['poin']) && $transaksi['poin'] > 0): ?>
                            <div class="total-row">
                                <span>Poin Didapat:</span>
                                <span><?= $transaksi['poin'] ?> poin</span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="thank-you">
                            <p><strong>Terima kasih atas kunjungan Anda!</strong></p>
                            <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</p>
                            <p>Simpan nota ini sebagai bukti pembayaran</p>
                        </div>
                    </div>
                    
                    <div class="btn-group">
                        <a href="<?= base_url('Transaksi/CetakNota/' . $no_faktur) ?>" class="btn-print" target="_blank">
                            📄 Cetak Nota
                        </a>
                        <a href="<?= base_url('Transaksi') ?>" class="btn-back">
                            ← Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>