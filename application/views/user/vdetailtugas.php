<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Detail Tugas</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Yang Tersedia</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <?php if ($this->session->flashdata('msg')) : ?>
            <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
        <?php endif; ?>
        <div class="row clearfix">
            <?php if (isset($hasil)) : ?>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="body">

                            <h4 class="card-title text-center"><?php echo $hasil->nama_tugas ?></h4>
                            <div class="card-subtitle"><b>Tanggal :</b>
                                <?php echo date("d-m-Y", strtotime($hasil->tgl_awal)) . ' s/d ' . date("d-m-Y", strtotime($hasil->tgl_akhir)) ?></div>
                            <b> Kategori Tugas : </b><?= $hasil->kategori_tugas ?> <br>
                            <b> Nilai Nominal : </b><?= ($hasil->nilai_nominal) ?><br>
                            <p class="card-text"><?php echo ($hasil->deskripsi) ?></p>
                            <?php if ($hasil->upload_image != null) : ?>
                                <img src="<?= base_url("upload/foto/") . $hasil->upload_image ?>" class="img-fluid rounded mx-auto d-block" width="550px">
                                <br>
                                <a href="<?= base_url("upload/foto/") . $hasil->upload_image ?>" download rel="noopener noreferrer" class="btn btn-primary btn-sm" title="Download Image">
                                    <span class="sr-only">Download Image</span>
                                    <i class="fa fa-download"></i></a>
                                <button type="button" id="btn-detail-img-admin" onclick="detailimgadmin(<?= $hasil->id_create_tugas ?>)" class="btn btn-round btn-info">Gambar Lain</button>
                                <br>
                            <?php endif ?>
                            <br>
                            <b>Link : </b>
                            <a href="<?= $hasil->link ?>"><?= $hasil->link ?></a><br>
                            <b>Target Akun : </b><?= $hasil->target ?><br><br>
                            <?php if (!$disable) : ?>
                                <form action="<?= isset($action) ? $action : '' ?>" method="post">
                                    <input type="hidden" value="<?= $hasil->id_create_tugas ?>" name="id_tugas">
                                    <div class="form-check">
                                        <input class="form-check-input" required type="checkbox" name="cekbox" value="proses" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            I agree to the term of service
                                        </label>
                                    </div>
                                    <br>
                                    <button type="submit" class=" btn btn-round btn-primary btn-lg btn-block ">Ambil Tugas</button>
                                </form>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <h4>Data Tidak Tersedia</h4>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="particles-js"></div>
<div class="modal fade bd-detail-img-admin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">File Gambar Lainnya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detail-img-admin">
                </div>

            </div>
        </div>
    </div>
</div>