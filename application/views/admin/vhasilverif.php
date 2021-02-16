<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Hasil Verifikasi</h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Promotor</h2>
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        </ul>
                    </div>
                    <?php if ($this->session->flashdata('msg')) : ?>
                        <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
                    <?php endif; ?>

                    <div class="body">
                        <div class="table-responsive">
                            <table id="table-data" class="table table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Id User</th>
                                        <th>Nama User</th>
                                        <th>Nama Tugas</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($hasil)) foreach ($hasil as $val) : ?>
                                        <tr>
                                            <td><a href="#" type="button" onclick="detailcustomer(<?= $val->id_auth ?>)"><?php echo $val->id_auth ?></a></td>
                                            <td><?php echo $val->nama_user ?></td>
                                            <td><?php echo $val->nama_tugas ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($val->tgl_akhir)) ?></td>
                                            <td><?php echo $val->status ?></td>
                                            <td><?php echo $val->keterangan ?></td>
                                            <td>
                                                <?php if (!$val->kirim_saldo && is_numeric($val->keterangan)) : ?>
                                                    <a href='#' type="button" id="kirimsaldo<?= $val->id_user_tugas ?>" data-id_user_tugas=<?= $val->id_user_tugas ?> data-saldo=<?= $val->keterangan ?> data-id="<?= $val->id_auth ?>" class="btn btn-info btn-sm kirimsaldo" title="Kirim Saldo"><span class="sr-only">Kirim Saldo</span> <i class="fa fa-dollar"></i></a>
                                                <?php endif ?>
                                                <a href="#" type="button" onclick="detailaporan(<?= $val->id_user_tugas ?>)" class="btn btn-success btn-sm" title="Lihat Laporan"><span class="sr-only">Detail Laporan</span> <i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div id="particles-js"></div>
<!-- larg modal -->
<div class="modal fade" id="detaillaporan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Detail Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detail-laporan">
                </div>

            </div>
        </div>
    </div>
</div>

<!-- larg modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">File Gambar Lainnya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detail-img-user">
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailcustomer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Detail Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detail-customer">
                </div>

            </div>
        </div>
    </div>
</div>