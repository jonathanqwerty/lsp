<!-- admin/pelanggan/edit.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>
</head>

<body>
    <h1>Edit Pelanggan</h1>

    <?php if (isset($validation)) : ?>
        <!-- Tampilkan error validasi jika ada -->
        <?= $validation->listErrors() ?>
    <?php endif; ?>

    <form action="<?= base_url('admin/pelanggan/update/' . $pelanggan['id_pelanggan']); ?>" method="post">
        <div>
            <label for="nomor_kwh">Nomor KWH</label>
            <input type="text" name="nomor_kwh" id="nomor_kwh" value="<?= $pelanggan['nomor_kwh'] ?>" required>
        </div>
        <div>
            <label for="nama_pelanggan">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" value="<?= $pelanggan['nama_pelanggan'] ?>" required>
        </div>
        <div>
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" required><?= $pelanggan['alamat'] ?></textarea>
        </div>
        <div>
            <label for="id_tarif">Kode Tarif</label>
            <select name="id_tarif" id="id_tarif" required>
                <?php foreach ($tarif as $t) : ?>
                    <option value="<?= $t['id_tarif'] ?>" <?= $t['id_tarif'] == $pelanggan['id_tarif'] ? 'selected' : '' ?>><?= $t['id_tarif'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>