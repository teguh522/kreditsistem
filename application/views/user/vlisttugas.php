<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>List Tugas</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Yang Tersedia</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <?php if ($this->session->flashdata('msg')) : ?>
            <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
        <?php endif; ?>

        <?php if (isset($hasil)) : ?>
            <?php foreach ($hasil as $val) : ?>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="card text-center border-info">
                            <div class="card-header bg-info border-info">
                                <?php echo $val->nama_tugas ?>
                            </div>
                            <div class="card-body ">
                                <h5 class="card-title"><?php echo ($val->nilai_nominal)  ?></h5>
                                <p class="card-text"><?php echo substr($val->deskripsi, 0, 90) ?></p>
                            </div>
                            <div class="card-footer bg-warning ">
                                <?php echo date("d-m-Y", strtotime($val->tgl_awal)) . ' s/d ' . date("d-m-Y", strtotime($val->tgl_akhir)) ?>
                            </div>
                            <div class="card-footer bg-transparent ">
                                <a href="<?php echo base_url('panelpromotor/detailtugas?id=') . $val->id_create_tugas ?>" class="btn btn-sm btn-block btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;
        else : ?>
            <h4>Data Tidak Tersedia</h4>
        <?php endif; ?>

    </div>
</div>
<div id="particles-js"></div>