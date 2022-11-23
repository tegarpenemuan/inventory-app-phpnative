<?php
ob_end_clean();
require_once '../config/koneksi.php';
require_once '../models/database.php';
require "../models/m_barang.php";

$connection = new Database($hostname, $user, $pass, $database);
$brg = new Barang($connection);

$content = '
<style type="text/css">
.table {
    border-collapse: collapse;
}

.table th {
    padding: 8px 5px;
    background-color: #f60;
    color:#fff;
}
</style>
';

$content .= '
<page>
    <div style="padding:4mm; border:1px solid;" align="center">
        <span style="font-size:25px;">Report PDF</span>
    </div>

    <div style="padding:20px 0 10px 0; font-size:15px;">
        Laporan Data Barang
    </div>

    <table border="1px" class="table">
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Stok Barang</th>
        </tr>
    </table>
</page>
';

require __DIR__ . '../../assets/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'A4', 'en');
$html2pdf->writeHTML($content);
$html2pdf->Output('Example.pdf');