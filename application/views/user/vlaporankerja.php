<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Laporan Kinerja</h1>
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
                        <div id="form-hidden">
                            <form id="basic-form" autocomplete="off" method="post" enctype="multipart/form-data" action="<?php if (isset($action)) echo $action ?>" novalidate>
                                <input type="hidden" name="next_id" id="next_id" value="<?= isset($last_data->id_laporan_tugas) ? $last_data->id_laporan_tugas + 1 : 1 ?>">
                                <input type="hidden" name="id_tugas" value="<?= $this->input->get('id') ?>">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" value="<?php if (isset($getrow)) echo $getrow->keterangan ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Upload Gambar </label>
                                    <div id="myupload" class="dropzone"></div>
                                    <!-- <input type="file" name="file_upload" class="dropify" value="<?php if (isset($getrow)) echo $getrow->file_upload ?>" data-default-file="<?php if (isset($getrow)) echo base_url('upload/documents/' . $getrow->file_upload) ?>" data-allowed-file-extensions="png jpg jpeg" data-max-file-size="4M"> -->
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary"><?php echo (isset($getrow)) ? 'Edit' : 'Submit'; ?></button>
                                <a href="<?php echo base_url('panelpromotor/historitugas') ?>" class="btn btn-primary">Batal</a>
                            </form>
                        </div>
                        <p></p>
                        <a href="#" id="btntambah" class="btn btn-primary pull-right">Tambah</a>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tugas</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (isset($hasil)) foreach ($hasil as $val) : ?>
                                        <tr>
                                            <td class="w60"><?php echo $no++; ?></td>
                                            <td><?php echo $val->nama_tugas; ?></td>
                                            <td><?php echo $val->keterangan; ?></td>
                                            <td><span class="badge badge-<?php if ($val->status == 'selesai') {
                                                                                echo 'success';
                                                                            } else if ($val->status == 'proses') {
                                                                                echo 'info';
                                                                            } else {
                                                                                echo 'danger';
                                                                            } ?>  ml-0 mr-0">
                                                    <?php echo $val->status ?></span>
                                            </td>

                                            <!-- <td>
                                                <a href='<?php echo base_url('panelpromotor/updatelaporan') . '?func=updatedokumen&id=' . $val->id_laporan_tugas ?>' type="button" class="btn btn-success mb-2" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-pencil"></i></a>
                                                <a href="<?php echo base_url('panelpromotor/deletelaporan') . '?func=dokumen&id=' . $val->id_laporan_tugas ?>" onclick="return confirm('Yakin hapus data ini ?')" type="button" class="btn btn-danger mb-2" title="Delete">
                                                    <span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></a>
                                            </td> -->
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