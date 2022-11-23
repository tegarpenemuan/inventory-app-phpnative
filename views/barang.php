<?php

require "models/m_barang.php";

$brg = new Barang($connection);

if (@$_GET['act'] == '') {
    ?>

<div class="row">
    <div class="col-lg-12">
        <h1>Data Barang <small>Admin</small></h1>
        <ol class="breadcrumb">
            <li><a href="assets/index.html"><i class="icon-dashboard"></i> Barang</a></li>
            <li class="active"><i class="icon-file-alt"></i> Data Barang</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah
            Data</a>
        <a href="./report/export_excel_barang.php" target="_blank">
            <button class="btn btn-default"><i class="fa fa-print"></i> Export Excel</button>
        </a>
        <a class="btn btn-default" data-toggle="modal" data-target="#cetakpdf"><i class="fa fa-print"></i> Cetak PDF</a>

        <?php
include ".modal_brg_add.php";
    include ".modal_brg_edit.php";
    include ".modal_brg_cetak.php";
    ?>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="datatables">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Gambar Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Barang</th>
                        <th>Stok Barang</th>
                        <th>Tgl Publish</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$no = 1;
    $tampil = $brg->tampil();

    while ($data = $tampil->fetch_object()) {

        ?>
                    <tr>
                        <td><?=$no++ . "."?></td>
                        <td>
                            <img src="assets/img/barang/<?=$data->gbr_brg?>" width="70px" alt="<?=$data->nama_brg?>">
                        </td>
                        <td><?=$data->nama_brg?></td>
                        <td><?="Rp. " . number_format($data->harga_brg, 2, ",", ".")?></td>
                        <td><?=$data->stok_brg?></td>
                        <td><?=date('d F Y', strtotime($data->tgl_publish))?></td>
                        <td align="center">
                            <a id="edit_brg" data-toggle="modal" data-target="#edit" href=""
                                data-id="<?=$data->id_brg?>" data-nama="<?=$data->nama_brg?>"
                                data-harga="<?=$data->harga_brg?>" data-stok="<?=$data->stok_brg?>"
                                data-gbr="<?=$data->gbr_brg?>">
                                <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>
                            </a>
                            <a href="?page=barang&act=del&id=<?=$data->id_brg?>"
                                onclick="return confirm('Yakin hapus data ini?')">
                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
                            </a>
                            <a href="./report/cetak_barang.php?id=<?=$data->id_brg;?>" target="_blank">
                                <button class="btn btn-default btn-xs"><i class="fa fa-print"></i> Cetak</button>
                            </a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php

} else if (@$_GET['act'] == 'del') {
    $gbr_awal = $brg->tampil($_GET['id'])->fetch_object()->gbr_brg;
    unlink("assets/img/barang/" . $gbr_awal);

    $brg->hapus($_GET['id']);
    header("location: ?page=barang");
}

?>