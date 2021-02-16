<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Verifikasi</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Laporan Tugas</a></li>
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
                            <?php foreach ($hasil as $val) : ?>
                                <div class="card border-success">
                                    <div class="body ">
                                        <p><?= "Keterangan : " . $val->keterangan . " ( " . $val->tgl_lapor . " ) " ?></p>
                                        <?php if ($val->upload_image != null) : ?>
                                            <?php $filename = base_url("upload/foto/") . $val->upload_image; ?>
                                            <img src=<?= $filename ?> class="img-fluid rounded mx-auto d-block" width="450px">
                                        <?php endif ?>
                                    </div>
                                </div>
                                <button type="button" id="detail-img" onclick="detailimg(<?= $val->id_laporan_tugas ?>)" class="btn btn-round btn-info">Gambar Lain</button>
                                <br>
                                <br>
                            <?php endforeach; ?>


                            <?= $userinfo->firstname . ' ' . $userinfo->lastname . ' ' ?>
                            <?php
                            if ($userinfo->customer_group_id == '1') {
                                echo '<b>' . '( Pelanggan Basic )' . '</b>';
                            } else if ($userinfo->customer_group_id == '7') {
                                echo '<b>' . '( Pelanggan Premium Harian )' . '</b>';
                            } else if ($userinfo->customer_group_id == '8') {
                                echo '<b>' . '( Pelanggan Premium Mingguan )' . '</b>';
                            } else if ($userinfo->customer_group_id == '2') {
                                echo  '<b>' . '( Pelanggan Premium Bulanan )' . '</b>';
                            } else if ($userinfo->customer_group_id == '6') {
                                echo  '<b>' . '( Pelanggan Bisnis )' . '</b>';
                            } else if ($userinfo->customer_group_id == '9') {
                                echo '<b>' . '( Agen Kurir )' . '</b>';
                            } else {
                                echo 'Tidak ditemukan';
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6 card ">

                                    <form action="<?= isset($action) ? $action : '' ?>" method="post">
                                        <input type="hidden" name="id_user_tugas" value="<?= $this->input->get('id'); ?>">
                                        <input type="hidden" name="status" value="selesai">
                                        <input type="hidden" name="hp" value="<?= $userinfo->telephone ?>">
                                        <input type="hidden" name="nama_promotor" value="<?= $userinfo->firstname . ' ' . $userinfo->lastname ?>">
                                        <div class=" form-group">
                                            <label>Besar Nominal</label>
                                            <input type="text" name="keterangan" class="form-control" value="<?php if (isset($getrow)) echo $getrow->nama_tugas ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-round btn-primary btn-lg btn-block">Accepted</button>
                                    </form>
                                </div>
                                <div class="col-md-6 card ">
                                    <form action="<?= isset($action) ? $action : '' ?>" method="post">
                                        <input type="hidden" name="id_user_tugas" value="<?= $this->input->get('id'); ?>">
                                        <input type="hidden" name="status" value="ditolak">
                                        <input type="hidden" name="hp" value="<?= $userinfo->telephone ?>">
                                        <input type="hidden" name="nama_promotor" value="<?= $userinfo->firstname . ' ' . $userinfo->lastname ?>">
                                        <div class=" form-group">
                                            <label>Alasan Ditolak</label>
                                            <input type="text" name="keterangan" class="form-control" value="<?php if (isset($getrow)) echo $getrow->nama_tugas ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-round btn-danger btn-lg btn-block">Rejected</button>
                                    </form>
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
                </div>
            <?php
            else : ?>
                <h4>Data Tidak Tersedia</h4>
            <?php endif; ?>
        </div>
    </div>
</div>

</div>
<div id="particles-js"></div>