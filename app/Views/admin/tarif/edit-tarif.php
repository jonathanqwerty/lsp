<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tarif</title>
</head>

<body>
    <h1>Edit Tarif</h1>

    <form action="<?= base_url('admin/tarif/update/' . $tarif['id_tarif']); ?>" method="post">
        <div>
            <label for="daya">Daya</label>
            <input type="text" name="daya" id="daya" value="<?= $tarif['daya']; ?>" required>
        </div>
        <div>
            <label for="tarifperkwh">Tarif per kWh</label>
            <input type="text" name="tarifperkwh" id="tarifperkwh" value="<?= $tarif['tarifperkwh']; ?>" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>