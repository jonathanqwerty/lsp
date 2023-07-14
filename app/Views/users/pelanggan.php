<!-- app/Views/pelanggan.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Pelanggan Dashboard</title>
</head>

<body>
    <h2>Welcome, <?= session()->get('username') ?></h2>

    <h3>Tagihan</h3>
    <table>
        <thead>
            <tr>
                <th>ID Tagihan</th>
                <th>ID Pelanggan</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jumlah Meter</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tagihan as $row) : ?>
                <tr>
                    <td><?= $row['id_tagihan'] ?></td>
                    <td><?= $row['id_pelanggan'] ?></td>
                    <td><?= $row['bulan'] ?></td>
                    <td><?= $row['tahun'] ?></td>
                    <td><?= $row['jumlah_meter'] ?></td>
                    <td><?= $row['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Pembayaran</h3>
    <table>
        <thead>
            <tr>
                <th>ID Pembayaran</th>
                <th>ID Tagihan</th>
                <th>ID Pelanggan</th>
                <th>Tanggal Pembayaran</th>
                <th>Bulan Bayar</th>
                <th>Biaya Admin</th>
                <th>Total Bayar</th>
                <th>ID User</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pembayaran as $row) : ?>
                <tr>
                    <td><?= $row['id_pembayaran'] ?></td>
                    <td><?= $row['id_tagihan'] ?></td>
                    <td><?= $row['id_pelanggan'] ?></td>
                    <td><?= $row['tanggal_pembayaran'] ?></td>
                    <td><?= $row['bulan_bayar'] ?></td>
                    <td><?= $row['biaya_admin'] ?></td>
                    <td><?= $row['total_bayar'] ?></td>
                    <td><?= $row['id_user'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>