<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Admin | Master Pelanggan </h1>
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
                                <input type="hidden" name="id_pelanggan" value="<?php if (isset($getrow)) echo $getrow->id_pelanggan ?>">
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" name="nama_pel" class="form-control" value="<?php if (isset($getrow)) echo $getrow->nama_pel ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>No KTP</label>
                                    <input type="text" name="no_ktp" class="form-control" value="<?php if (isset($getrow)) echo $getrow->no_ktp ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input data-provide="datepicker" value="<?php if (isset($getrow)) echo $getrow->tgl_lahir ?>" name='tgl_lahir' data-date-autoclose="true" class="form-control" data-date-format="yyyy-mm-dd" required>
                                </div>
                                <div class="form-group">
                                    <label>No WA</label>
                                    <input type="text" name="no_wa" class="form-control" value="<?php if (isset($getrow)) echo $getrow->no_wa ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat"><?php if (isset($getrow)) echo $getrow->alamat ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No Kontak Saudara</label>
                                    <input type="text" name="no_saudara" value="<?php if (isset($getrow)) echo $getrow->no_saudara ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Saudara</label>
                                    <input type="text" name="nama_saudara" value="<?php if (isset($getrow)) echo $getrow->nama_saudara ?>" class="form-control" required>
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
                                        <th>Nama</th>
                                        <th>KTP</th>
                                        <th>Tgl Lahir</th>
                                        <th>WA</th>
                                        <th>No Saudara</th>
                                        <th>Nama Saudara</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (isset($hasil)) foreach ($hasil as $val) : ?>
                                        <tr>
                                            <td class="w60"><?php echo $no++; ?></td>
                                            <td><?php echo $val->nama_pel; ?></td>
                                            <td><?php echo $val->no_ktp; ?></td>
                                            <td><?php echo $val->tgl_lahir; ?></td>
                                            <td><?= $val->no_wa ?></td>
                                            <td><?= $val->no_saudara ?></td>
                                            <td><?= $val->nama_saudara ?></td>
                                            <td>
                                                <a href='<?php echo base_url('paneladmin') . '?func=updatepelanggan&id=' . $val->id_pelanggan ?>' type="button" class="btn btn-success btn-sm" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-pencil"></i></a>
                                                <a href="<?php echo base_url('paneladmin/delete') . '?func=pelanggan&id=' . $val->id_pelanggan ?>" onclick="return confirm('Yakin hapus data ini ?')" type="button" class="btn btn-danger btn-sm" title="Delete">
                                                    <span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></a>
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