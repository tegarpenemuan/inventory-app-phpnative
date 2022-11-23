<div class="row">
    <div class="col-lg-12">
        <h1>Grafik Barang <small>Admin</small></h1>
        <ol class="breadcrumb">
            <li><a href="assets/index.html"><i class="icon-dashboard"></i> Barang</a></li>
            <li class="active"><i class="icon-file-alt"></i> Grafik</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <!-- chart -->
        <figure class="highcharts-figure">
            <div id="data_barang"></div>
            <p class="highcharts-description">
                Menampilkan nama barang beserta stoknya.
            </p>
        </figure>
        <!-- chart -->
    </div>
</div>

<?php

include "models/m_barang.php";
$brg = new Barang($connection);
$tampil = $brg->tampil();

$nama_brg = array();
$stok_brg = array();
while ($data = $tampil->fetch_object()) {
    $nama_brg[] = $data->nama_brg;
    $stok_brg[] = intval($data->stok_brg);
}
//print_r(json_encode($stok_brg));
?>

<!-- chart -->
<!-- versi online -->
<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
<!-- versi online -->

<script src="assets/highcharts/highcharts.js"></script>
<script src="assets/highcharts/exporting.js"></script>
<script src="assets/highcharts/export-data.js"></script>
<script src="assets/highcharts/accessibility.js"></script>
<script>
Highcharts.chart('data_barang', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Data Nama dan Jumlah Stok Barang'
    },
    subtitle: {
        text: 'Source: LebahCoding.blogspot.com'
    },
    xAxis: {
        categories: <?=json_encode($nama_brg)?>,
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            useHTML: true,
            text: 'Jumlah Satuan'
        }
    },
    tooltip: {
        shared: true,
        headerFormat: ''
    },
    plotOptions: {
        area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            }
        }
    },
    series: [{
        name: 'Jumlah Stok',
        data: <?=json_encode($stok_brg)?>
    }]
});
</script>
<!-- chart -->