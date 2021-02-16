<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Verifikasi Tugas</h1>
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
                        <form id="basic-form" autocomplete="off" method="post" enctype="multipart/form-data" action="<?php if (isset($action)) echo $action ?>" novalidate>
                            <?php $no = 1;
                            if (isset($jobprocess)) foreach ($jobprocess as $val) : ?>
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="list-group">
                                            <a href="<?= base_url('paneladmin/detailverif?id=') ?><?= $val->id_user_tugas ?>" class="list-group-item list-group-item-action">
                                                <?= $val->nama_tugas . " ({$val->id_auth})" . "({$val->nama_user})" . "({$val->tgl_submit_user})" ?>
                                                <span class="pull-right badge badge-<?= $val->status_upload_laporan ? 'success' : 'warning' ?> ml-0 mr-0">
                                                    <?= $val->status_upload_laporan ? 'Sudah Lapor' : 'Belum Lapor' ?></span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!-- <button type="submit" class="btn btn-primary"><?php echo (isset($getrow)) ? 'Edit' : 'Submit'; ?></button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div id="particles-js"></div>