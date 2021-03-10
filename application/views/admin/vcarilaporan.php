<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Cari Laporan</h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>System Kredit</h2>
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        </ul>
                    </div>
                    <?php if ($this->session->flashdata('msg')) : ?>
                        <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
                    <?php endif; ?>

                    <div class="body">
                        <form id="basic-form" autocomplete="off" method="get" enctype="multipart/form-data" action="<?php if (isset($action)) echo $action ?>" novalidate>
                            <div class="form-group">
                                <label>Cari Barang</label>
                                <select id="cari-barang" class="js-example-basic-multiple" name="id_barang">

                                </select>
                            </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<div id="particles-js"></div>