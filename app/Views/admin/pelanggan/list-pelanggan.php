<!-- admin/pelanggan/index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan</title>
</head>

<body>
    <h1>Lihat Pelanggan yang terdaftar</h1>

    <table>
        <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <th>nomor kwh</th>
                <th>Alamat</th>
                <th>Kode Tarif</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($pelanggan as $p) : ?>
                <tr>
                    <td><?= $p['nama_pelanggan']; ?></td>
                    <td><?= $p['nomor_kwh']; ?></td>
                    <td><?= $p['alamat']; ?></td>
                    <?php if (isset($tarif[$p['id_pelanggan']]) && isset($tarif[$p['id_pelanggan']]['tarifperkwh'])) : ?>
                        <td><?= $tarif[$p['id_pelanggan']]['tarifperkwh']; ?></td>
                    <?php else : ?>
                        <td></td>
                    <?php endif; ?>
                    <td>
                        <a href="/admin/pelanggan/edit-pelanggan/<?= $p['id_pelanggan']; ?>">Edit</a>
                        <a href="/admin/pelanggan/delete/<?= $p['id_pelanggan']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>