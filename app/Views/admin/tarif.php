<!DOCTYPE html>
<html>
<head>
    <title>Item List</title>
</head>
<body>
    <h1>Item List</h1>

    <table>
        <thead>
            <tr>
                <th>ID Tarif</th>
                <th>Daya</th>
                <th>tarif per kwh</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($tarif)) : ?>
                <?php foreach ($tarif as $t) : ?>
                    <tr>
                        <td><?= $t['id_tarif'] ?></td>
                        <td><?= $t['daya'] ?> Watt</td>
                        <td>Rp. <?= number_format($t['tarifperkwh'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">No data available</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
