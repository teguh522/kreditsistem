<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Admin | Pembayaran Angsuran </h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <?php if ($this->session->flashdata('msg')) : ?>
                        <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
                    <?php endif; ?>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Barang</th>
                                        <th>Total</th>
                                        <th>Tenor</th>
                                        <th>Angsuran</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Sisa</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (isset($hasil)) foreach ($hasil as $val) : ?>
                                        <tr>
                                            <td class="w60"><?php echo $no++; ?></td>
                                            <td><?php echo $val->nama_pel; ?></td>
                                            <td><?php echo $val->nama_barang; ?></td>
                                            <td><?php echo number_format($val->harga_jual); ?></td>
                                            <td><?php echo $val->tenor . " bulan"; ?></td>
                                            <td><?= number_format($val->harga_jual / $val->tenor) ?></td>
                                            <td><?php echo $val->jatuh_tempo; ?></td>
                                            <td>
                                                <?php echo number_format($val->harga_jual - $val->total_angsuran); ?>
                                            </td>
                                            <td>
                                                <?php if (($val->harga_jual - $val->total_angsuran) == 0) { ?>
                                                    <span class="badge badge-success">Lunas</span>
                                                <?php } else { ?>
                                                    <a href='#' type="button" data-toggle="modal" id="btnangsuran" data-target="#bayarangsuranmodal" data-id-kredit="<?= $val->id_kredit ?>" class="btn btn-primary btn-sm" title="Bayar Angsuran"><span class="sr-only"></span>
                                                        <i class="fa fa-book"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="particles-js"></div>
<div class="modal fade" id="bayarangsuranmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Bayar Angsuran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="tampilid" name="id_interview">
                <div id="jawabaninterview"></div>
                <form id="form-jawaban-interview" autocomplete="off" method="post" enctype="multipart/form-data" action="#" novalidate>
                    <div class="form-group">
                        <input type="text" id="jumlah_angsuran" placeholder="Masukan Nominal Tanpa TITIK" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnsimpanjwb" class="btn btn-round btn-primary">Bayar</button>
            </div>
        </div>
    </div>
</div>