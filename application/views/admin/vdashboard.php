<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Dashboard Admin</h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
                            <div class="ml-4">
                                <span>Tugas Terpost</span>
                                <h4 class="mb-0 font-weight-medium"><?= isset($semuatugas) ? count($semuatugas) : '-' ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-credit-card"></i></div>
                            <div class="ml-4">
                                <span>Tugas Proses</span>
                                <h4 class="mb-0 font-weight-medium"><?= isset($tugasproses) ? count($tugasproses) : '-' ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-users"></i></div>
                            <div class="ml-4">
                                <span>Tugas Selesai</span>
                                <h4 class="mb-0 font-weight-medium"><?= isset($tugasselesai) ? count($tugasselesai) : '-' ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-pink text-white rounded-circle"><i class="fa fa-life-ring"></i></div>
                            <div class="ml-4">
                                <span>Tugas Ditolak</span>
                                <h4 class="mb-0 font-weight-medium"><?= isset($tugasditolak) ? count($tugasditolak) : '-' ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Laporan</h2>
                    </div>
                    <div class="body">
                        <div class="row text-center">
                            <div class="col-6 border-right pb-4 pt-4">
                                <label class="mb-0">Telah Lapor</label>
                                <h4 class="font-30 font-weight-bold text-col-blue"><?= isset($telahlapor) ? count($telahlapor) : '-' ?></h4>
                            </div>
                            <div class="col-6 pb-4 pt-4">
                                <label class="mb-0">Belum Lapor</label>
                                <h4 class="font-30 font-weight-bold text-col-blue"><?= isset($belumlapor) ? count($belumlapor) : '-' ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <?php
                        $persenproses = isset($tugasproses) ? ceil((count($tugasproses) / count($tugastanpastatus) * 100)) : '0';
                        $persenselesai = isset($tugasselesai) ? ceil((count($tugasselesai) / count($tugastanpastatus) * 100)) : '0';
                        $persenditolak = isset($tugasditolak) ? ceil((count($tugasditolak) / count($tugastanpastatus) * 100)) : '0';
                        ?>

                        <div class="form-group">
                            <label class="d-block">Tugas Diproses <span class="float-right"><?= $persenproses ?>%</span></label>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?= $persenproses ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $persenproses ?>%;"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Tugas Ditolak <span class="float-right"><?= $persenditolak ?>%</span></label>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?= $persenditolak ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $persenditolak ?>%;"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Tugas Selesai<span class="float-right"><?= $persenselesai ?>%</span></label>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?= $persenselesai ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $persenselesai ?>%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card user_statistics">
                    <div class="header">
                        <h2>Report Pembayaran <?= date('Y') ?></h2>
                    </div>
                    <div class="body">
                        <div id="chart-bar" style="height: 302px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div id="particles-js"></div>