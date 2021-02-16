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
                                    <label>Nama Pelanggan</label>
                                    <select id="cari-pelanggan" class="js-example-basic-multiple" name="id_pelanggan" required>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Barang</label>
                                    <select id="cari-barang" class="js-example-basic-multiple" name="id_barang" required>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>HPP</label>
                                    <input type="text" id="hpp" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="text" name="harga_jual" class="form-control" value="<?php if (isset($getrow)) echo $getrow->harga_jual ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Tenor (Bulan)</label>
                                    <input type="text" name="tenor" class="form-control" value="<?php if (isset($getrow)) echo $getrow->tenor ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Jatuh Tempo</label>
                                    <input data-provide="datepicker" value="<?php if (isset($getrow)) echo $getrow->jatuh_tempo ?>" name='jatuh_tempo' data-date-autoclose="true" class="form-control" data-date-format="yyyy-mm-dd" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Tagihan / Bulan</label>
                                    <input type="text" name="tgl_tagihan" placeholder="ex. 25" class="form-control" value="<?php if (isset($getrow)) echo $getrow->tgl_tagihan ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary"><?php echo (isset($getrow)) ? 'Edit' : 'Simpan'; ?></button>
                                <a href="<?php echo base_url('paneladmin/tambahkredit') ?>" class="btn btn-primary">Batal</a>
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
                                        <th>Pelanggan</th>
                                        <th>Barang</th>
                                        <th>Foto</th>
                                        <th>HPP</th>
                                        <th>Harga Jual</th>
                                        <th>Tenor </th>
                                        <th>Angsuran </th>
                                        <th>Tgl Tagihan </th>
                                        <th>Jatuh Tempo</th>
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
                                            <td><img src="<?= base_url('upload/foto/') . $val->foto ?>" class="rounded" width="200px"></td>
                                            <td><?php echo number_format($val->hpp); ?></td>
                                            <td><?php echo number_format($val->harga_jual); ?></td>
                                            <td><?php echo $val->tenor . " bulan"; ?></td>
                                            <td><?php echo number_format($val->harga_jual / $val->tenor); ?></td>
                                            <td><?php echo $val->tgl_tagihan; ?></td>
                                            <td><?php echo $val->jatuh_tempo; ?></td>

                                            <td>
                                                <a href='<?php echo base_url('paneladmin/tambahkredit') . '?func=updatekredit&id=' . $val->id_kredit ?>' type="button" class="btn btn-success btn-sm" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-pencil"></i></a>
                                                <a href="<?php echo base_url('paneladmin/delete') . '?func=kredit&id=' . $val->id_kredit ?>" onclick="return confirm('Yakin hapus data ini ?')" type="button" class="btn btn-danger btn-sm" title="Delete">
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