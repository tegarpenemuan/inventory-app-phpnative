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
        <button class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah
            Data</button>
        <a href="./report/export_excel_barang.php" target="_blank">
            <button class="btn btn-default"><i class="fa fa-print"></i> Export Excel</button>
        </a>
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
                        <td><?=$data->harga_brg?></td>
                        <td><?=$data->stok_brg?></td>
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
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah -->
        <div id="tambah" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Tambah Data Barang</h4>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nm_brg" class="control-label">Nama Barang</label>
                                <input type="text" name="nm_brg" class="form-control" id="nm_brg" required>
                            </div>
                            <div class="form-group">
                                <label for="hrg_brg" class="control-label">Harga Barang</label>
                                <input type="number" min="0" name="hrg_brg" class="form-control" id="hrg_brg" required>
                            </div>
                            <div class="form-group">
                                <label for="stok_brg" class="control-label">Stok Barang</label>
                                <input type="number" min="0" name="stok_brg" class="form-control" id="stok_brg"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="gbr_brg" class="control-label">Gambar Barang</label>
                                <input type="file" name="gbr_brg" class="form-control" id="gbr_brg" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
                        </div>
                    </form>
                    <?php

    if (@$_POST['tambah']) {
        $nm_brg = $connection->conn->real_escape_string($_POST['nm_brg']);
        $hrg_brg = $connection->conn->real_escape_string($_POST['hrg_brg']);
        $stok_brg = $connection->conn->real_escape_string($_POST['stok_brg']);

        $extensi = explode(".", $_FILES['gbr_brg']['name']);
        $gbr_brg = "brg-" . round(microtime(true)) . "." . end($extensi);
        $sumber = $_FILES['gbr_brg']['tmp_name'];
        $upload = move_uploaded_file($sumber, "assets/img/barang/" . $gbr_brg);

        if ($upload) {
            $brg->tambah($nm_brg, $hrg_brg, $stok_brg, $gbr_brg);
            header("location: ?page=barang");
        } else {
            echo "<script>alert('Upload Gambar Gagal!')</script>";
        }
    }

    ?>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="edit" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Data Barang</h4>
                    </div>
                    <form id="form" enctype="multipart/form-data">
                        <div class="modal-body" id="modal-edit">
                            <div class="form-group">
                                <label for="nm_brg" class="control-label">Nama Barang</label>
                                <input type="hidden" name="id_brg" id="id_brg">
                                <input type="text" name="nm_brg" class="form-control" id="nm_brg" required>
                            </div>
                            <div class="form-group">
                                <label for="hrg_brg" class="control-label">Harga Barang</label>
                                <input type="number" min="0" name="hrg_brg" class="form-control" id="hrg_brg" required>
                            </div>
                            <div class="form-group">
                                <label for="stok_brg" class="control-label">Stok Barang</label>
                                <input type="number" min="0" name="stok_brg" class="form-control" id="stok_brg"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="gbr_brg" class="control-label">Gambar Barang</label>
                                <div style="padding-bottom: 5px;">
                                    <img src="" width="80px" id="pict">
                                </div>
                                <input type="file" name="gbr_brg" class="form-control" id="gbr_brg">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" name="edit" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript">
        $(document).on("click", "#edit_brg", function() {
            var idbrg = $(this).data('id');
            var nmbrg = $(this).data('nama');
            var hrgbrg = $(this).data('harga');
            var stokbrg = $(this).data('stok');
            var gbrbrg = $(this).data('gbr');
            $("#modal-edit #id_brg").val(idbrg);
            $("#modal-edit #nm_brg").val(nmbrg);
            $("#modal-edit #hrg_brg").val(hrgbrg);
            $("#modal-edit #stok_brg").val(stokbrg);
            $("#modal-edit #pict").attr("src", "assets/img/barang/" + gbrbrg);
        });

        $(document).ready(function(e) {
            $("#form").on("submit", (function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'models/proses_edit_barang.php',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(msg) {
                        $('.table').html(msg);
                    }
                });
            }));
        });
        </script>

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