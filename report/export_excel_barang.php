<?php
require_once '../config/koneksi.php';
require_once '../models/database.php';
require "../models/m_barang.php";

$connection = new Database($hostname, $user, $pass, $database);
$brg = new Barang($connection);

$tanggal = date('dmY');
$fileName = "excel_barang_$tanggal.xls";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
?>

<table border="1px">
    <tr>
        <th>No.</th>
        <th>Nama Barang</th>
        <th>Harga Barang</th>
        <th>Stok Barang</th>
    </tr>
    <?php
$no = 1;
$tampil = $brg->tampil();
while ($data = $tampil->fetch_object()) {
    ?>

    <tr>
        <td><?=$no++ . "."?></td>
        <td><?=$data->nama_brg?></td>
        <td><?=$data->harga_brg?></td>
        <td><?=$data->stok_brg?></td>
    </tr>

    <?php
}
?>
</table>