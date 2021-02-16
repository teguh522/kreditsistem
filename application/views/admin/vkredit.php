<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Admin | Master Kredit </h1>
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
                                <input type="hidden" name="id_barang" value="<?php if (isset($getrow)) echo $getrow->id_barang ?>">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control" value="<?php if (isset($getrow)) echo $getrow->nama_barang ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Singkat</label>
                                    <textarea class="form-control" name="deskripsi"><?php if (isset($getrow)) echo $getrow->deskripsi ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>HPP</label>
                                    <input type="text" name="hpp" class="form-control" value="<?php if (isset($getrow)) echo $getrow->hpp ?>" required>
                                </div>
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
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (isset($hasil)) foreach ($hasil as $val) : ?>
                                        <tr>
                                            <td class="w60"><?php echo $no++; ?></td>
                                            <td><?php echo $val->nama_barang; ?></td>
                                            <td><img src="<?= base_url('upload/foto/') . $val->foto ?>" class="rounded" width="200px"></td>
                                            <td>
                                                <a href='<?php echo base_url('paneladmin/barang') . '?func=updatebarang&id=' . $val->id_barang ?>' type="button" class="btn btn-success btn-sm" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-pencil"></i></a>
                                                <a href="<?php echo base_url('paneladmin/delete') . '?func=barang&id=' . $val->id_barang ?>" onclick="return confirm('Yakin hapus data ini ?')" type="button" class="btn btn-danger btn-sm" title="Delete">
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