<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tarif Baru</title>
</head>

<body>
    <h1>Tambah Tarif Baru</h1>

    <form action="<?= base_url('admin/tarif/store'); ?>" method="post">
        <div>
            <label for="daya">Daya</label>
            <input type="text" name="daya" id="daya" required>
        </div>
        <div>
            <label for="tarifperkwh">Tarif per kWh</label>
            <input type="text" name="tarifperkwh" id="tarifperkwh" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>