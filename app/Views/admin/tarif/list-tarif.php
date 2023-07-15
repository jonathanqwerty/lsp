<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tarif</title>
</head>

<body>
    <h1>Daftar Tarif</h1>

    <a href="<?= base_url('admin/tarif/create-tarif'); ?>">Tambah Tarif Baru</a>

    <table>
        <thead>
            <tr>
                <th>ID Tarif</th>
                <th>Daya</th>
                <th>Tarif per kWh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tarif as $t) : ?>
                <tr>
                    <td><?= $t['id_tarif']; ?></td>
                    <td><?= $t['daya']; ?></td>
                    <td><?= $t['tarifperkwh']; ?></td>
                    <td>
                        <a href="<?= base_url('admin/tarif/edit/' . $t['id_tarif']); ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>