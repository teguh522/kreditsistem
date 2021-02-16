<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>History </h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Tugas</h2>
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        </ul>
                    </div>
                    <?php if ($this->session->flashdata('msg')) : ?>
                        <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
                    <?php endif; ?>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tugas</th>
                                        <th>Kategori</th>
                                        <th>Nominal</th>
                                        <th>Batas Akhir</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (isset($hasil)) foreach ($hasil as $val) : ?>
                                        <tr>
                                            <td class="w60"><?php echo $no++; ?></td>
                                            <td><?php echo $val->nama_tugas; ?></td>
                                            <td><?php echo $val->kategori_tugas; ?></td>
                                            <td><?php echo $val->nilai_nominal; ?></td>
                                            <td><span class="badge badge-danger"><?php echo $val->tgl_akhir; ?></span></td>

                                            <td><span class="badge badge-<?php if ($val->status == 'selesai') {
                                                                                echo 'success';
                                                                            } else if ($val->status == 'proses') {
                                                                                echo 'info';
                                                                            } else {
                                                                                echo 'danger';
                                                                            } ?> ml-0 mr-0">
                                                    <?php echo $val->status ?></span></td>
                                            <td><?php echo $val->keterangan; ?></td>
                                            <td>
                                                <?php if ($val->status == 'selesai' || $val->tgl_akhir < date('Y-m-d')) { ?>
                                                    Waktu telah terlewat
                                                <?php } else { ?>
                                                    <a href='<?php echo base_url('panelpromotor/laporankerja') . '?id=' . $val->id_user_tugas ?>' type="button" class="btn btn-primary mb-2" title="Laporkan Hasil">
                                                        <span class="sr-only">Hasil</span>
                                                        <i class="fa fa-book"></i></a>
                                                <?php } ?>
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
</div>

</div>

</div>
<div id="particles-js"></div>