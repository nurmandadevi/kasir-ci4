<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            line-height: 1.2;
        }
        .container {
            max-width: 300px;
            margin: 0 auto;
            background: white;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .header p {
            margin: 2px 0;
            font-size: 10px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 10px;
        }
        .info-table td {
            padding: 2px 0;
            font-size: 11px;
        }
        .separator {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }
        .items-table th,
        .items-table td {
            padding: 3px 2px;
            font-size: 10px;
            text-align: left;
        }
        .items-table th {
            border-bottom: 1px solid #000;
            font-weight: bold;
        }
        .items-table .qty {
            text-align: center;
            width: 25px;
        }
        .items-table .price {
            text-align: right;
            width: 60px;
        }
        .total-section {
            border-top: 1px solid #000;
            padding-top: 8px;
            margin-top: 10px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
            font-size: 11px;
        }
        .total-row.grand-total {
            font-weight: bold;
            font-size: 13px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
        }
        .print-btn:hover {
            background: #0056b3;
        }
        .back-btn {
            position: fixed;
            top: 20px;
            right: 150px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .back-btn:hover {
            background: #1e7e34;
            color: white;
            text-decoration: none;
        }
        @media print {
            body {
                padding: 0;
                margin: 0;
            }
            .print-btn, .back-btn {
                display: none;
            }
            .container {
                max-width: none;
                width: 100%;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <a href="<?= base_url('Transaksi/TransaksiBaru') ?>" class="back-btn">Kembali ke Transaksi</a>
    <button class="print-btn" onclick="window.print()">Print Nota</button>
    
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>HIKAM MART</h2>
            <p>Jalan Citandul No. 57, RT. 03 / RW. 07, Suko, Jogoyudan, Kec. Lumajang, Kabupaten Lumajang, Jawa Timur 67316</p>
            <p>Telp: (0123) 456789</p>
        </div>

        <!-- Info Transaksi -->
        <table class="info-table">
            <tr>
                <td>No. Faktur</td>
                <td>:</td>
                <td><?= $transaksi['no_faktur'] ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?= date('d/m/Y', strtotime($transaksi['tgl_jual'])) ?></td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>:</td>
                <td><?= $transaksi['jam'] ?></td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>:</td>
                <td><?= $transaksi['nama_user'] ?></td>
            </tr>
            <?php if ($transaksi['nama_member']): ?>
            <tr>
                <td>Member</td>
                <td>:</td>
                <td><?= $transaksi['nama_member'] ?></td>
            </tr>
            <?php if ($transaksi['poin'] > 0): ?>
            <tr>
                <td>Poin</td>
                <td>:</td>
                <td>+<?= $transaksi['poin'] ?> poin</td>
            </tr>
            <?php endif; ?>
            <?php endif; ?>
        </table>

        <div class="separator"></div>

        <!-- Detail Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="qty">Qty</th>
                    <th class="price">Harga</th>
                    <th class="price">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $item): ?>
                <tr>
                    <td>
                        <strong><?= $item['nama_produk'] ?></strong><br>
                        <small><?= $item['nama_kategori'] ?></small>
                    </td>
                    <td class="qty"><?= $item['qty'] ?></td>
                    <td class="price"><?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td class="price"><?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Total Section -->
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
                <span>Bayar:</span>
                <span>Rp <?= number_format($transaksi['dibayar'], 0, ',', '.') ?></span>
            </div>
            <div class="total-row">
                <span>Kembalian:</span>
                <span>Rp <?= number_format($transaksi['kembalian'], 0, ',', '.') ?></span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>*** TERIMA KASIH ***</p>
            <p>Barang yang sudah dibeli tidak dapat dikembalikan</p>
            <p>Simpan nota ini sebagai bukti pembelian</p>
        </div>
    </div>

    <script>
        // Auto print saat halaman dimuat
        window.onload = function() {
            // Tunggu 1 detik lalu print otomatis
            setTimeout(function() {
                window.print();
            }, 1000);
        };
    </script>
</body>
</html>