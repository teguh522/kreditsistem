<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Hasil Pencarian</h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        </ul>
                    </div>

                    <div class="body">
                        <div class="table-responsive">
                            <table id="table-data" class="table table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Nama Pelanggan</th>
                                        <th>No KTP</th>
                                        <th>No WA</th>
                                        <th>Nama Barang</th>
                                        <th>Deskripsi</th>
                                        <th>HPP</th>
                                        <th>Harga Jual</th>
                                        <th>Tenor</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Angsuran Terbayar</th>
                                        <th>Sisa Angsuran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($hasil)) foreach ($hasil as $val) : ?>
                                        <tr>
                                            <td><?php echo $val->nama_pel ?></td>
                                            <td><?php echo $val->no_ktp ?></td>
                                            <td><?php echo $val->no_wa ?></td>
                                            <td><?php echo $val->nama_barang ?></td>
                                            <td><?php echo $val->deskripsi ?></td>
                                            <td><?php echo "Rp. " . number_format($val->hpp) ?></td>
                                            <td><?php echo "Rp. " . number_format($val->harga_jual) ?></td>
                                            <td><?php echo $val->tenor ?></td>
                                            <td><?php echo $val->jatuh_tempo ?></td>
                                            <td><?php echo "Rp. " . number_format($val->total_angsuran) ?></td>
                                            <td><?php echo "Rp. " . number_format($val->harga_jual - $val->total_angsuran) ?></td>
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