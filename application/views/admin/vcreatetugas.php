<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Admin | Create Tugas </h1>
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
                        <div id="form-hidden">
                            <form id="basic-form" autocomplete="off" method="post" enctype="multipart/form-data" action="<?php if (isset($action)) echo $action ?>" novalidate>
                                <input type="hidden" name="id_tugas" value="<?php if (isset($getrow)) echo $getrow->id_create_tugas ?>">
                                <input type="hidden" name="img" value="<?php if (isset($getrow)) echo $getrow->upload_image ?>">
                                <div class="form-group">
                                    <label>Nama Tugas</label>
                                    <input type="text" name="nama_tugas" class="form-control" value="<?php if (isset($getrow)) echo $getrow->nama_tugas ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Kategori Tugas</label>
                                    <input type="text" name="kategori_tugas" class="form-control" value="<?php if (isset($getrow)) echo $getrow->kategori_tugas ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Nominal</label>
                                    <input type="text" name="nominal" class="form-control" value="<?php if (isset($getrow)) echo $getrow->nilai_nominal ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea id="summernote" name="deskripsi"><?php if (isset($getrow)) echo $getrow->deskripsi ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="link" value="<?php if (isset($getrow)) echo $getrow->link ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" name="file_upload" class="dropify" value="<?php if (isset($getrow)) echo $getrow->upload_image ?>" data-height="100" data-default-file="<?php if (isset($getrow)) echo base_url('upload/foto/' . $getrow->upload_image) ?>" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="4M">

                                </div>

                                <div class="form-group">
                                    <label>Target Tugas</label>
                                    <select class="custom-select" name="target_tugas" data-parsley-required data-parsley-trigger-after-failure="change" data-parsley-errors-container="#error-multiselect">
                                        <option value="1" <?php if (isset($getrow)) echo $getrow->target == '1' ? "selected" : ""; ?>> Pelanggan Basic </option>
                                        <option value="7" <?php if (isset($getrow)) echo $getrow->target == '7' ? "selected" : ""; ?>> Pelanggan Premium Harian </option>
                                        <option value="8" <?php if (isset($getrow)) echo $getrow->target == '8' ? "selected" : ""; ?>> Pelanggan Premium Mingguan </option>
                                        <option value="2" <?php if (isset($getrow)) echo $getrow->target == '2' ? "selected" : ""; ?>> Pelanggan Premium Bulanan </option>
                                        <option value="6" <?php if (isset($getrow)) echo $getrow->target == '6' ? "selected" : ""; ?>> Pelanggan Bisnis </option>
                                        <option value="9" <?php if (isset($getrow)) echo $getrow->target == '9' ? "selected" : ""; ?>> Agen Kurir </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Tugas</label>
                                    <div class="input-daterange input-group" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="input-sm form-control" value="<?php if (isset($getrow)) echo $getrow->tgl_awal ?>" required name="tgl_awal">
                                        <span class="input-group-addon range-to">s/d</span>
                                        <input type="text" class="input-sm form-control" value="<?php if (isset($getrow)) echo $getrow->tgl_akhir ?>" required name="tgl_akhir">
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary"><?php echo (isset($getrow)) ? 'Edit' : 'Simpan'; ?></button>
                                <a href="<?php echo base_url('paneladmin') ?>" class="btn btn-primary">Batal</a>
                            </form>
                        </div>
                        <a href="#" id="btntambah" class="btn btn-primary pull-right">Tambah</a>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Tugas</th>
                                        <th>Kategori</th>
                                        <th>Nominal</th>
                                        <th>Target</th>
                                        <th>Tanggal</th>
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
                                            <td><?php if (($val->target) == '1') {
                                                    echo "Pelanggan Basic";
                                                } elseif (($val->target) == '7') {
                                                    echo "Pelanggan Premium Harian";
                                                } elseif (($val->target) == '8') {
                                                    echo "Pelanggan Premium Mingguan";
                                                } elseif (($val->target) == '2') {
                                                    echo "Pelanggan Premium Bulanan";
                                                } elseif (($val->target) == '6') {
                                                    echo "Pelanggan Bisnis";
                                                } elseif (($val->target) == '9') {
                                                    echo "Agen Kurir";
                                                } else {
                                                    echo "Tidak Ditemukan";
                                                } ?></td>
                                            <td><?php echo $val->tgl_awal . " s/d " . $val->tgl_akhir ?></td>
                                            <td>
                                                <?php if (!$val->is_broadcast) : ?>
                                                    <a href='#' type="button" id="broadcastwa" data-id="<?= $val->target ?>" data-id-tugas=<?= $val->id_create_tugas ?> class="btn btn-info btn-sm broadcastwa" title="Broadcast WA"><span class="sr-only">Kirim Notif</span> <i class="fa fa-envelope"></i></a>
                                                <?php endif ?>
                                                <a href="#" type="button" onclick="uploadlainnya(<?= $val->id_create_tugas ?>)" class="btn btn-warning btn-sm" title="Upload Gambar Lainnya"><span class="sr-only">Upload Gambar Lainnya</span> <i class="fa fa-upload"></i></a>
                                                <a href='<?php echo base_url('paneladmin') . '?func=updatecreatetugas&id=' . $val->id_create_tugas ?>' type="button" class="btn btn-success btn-sm" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-pencil"></i></a>
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
<div class="modal fade bd-example-modal-lg" id="uploadlainnya" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Upload Gambar Lainnya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="upload-admin-multi">
                </div>
                <div id="admin-image"></div>

            </div>
        </div>
    </div>
</div>