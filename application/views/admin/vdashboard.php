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
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
                            <div class="ml-4">
                                <span>Total Pelanggan</span>
                                <h4 class="mb-0 font-weight-medium"><?= isset($pelanggan) ? count($pelanggan) : '-' ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-credit-card"></i></div>
                            <div class="ml-4">
                                <span>Total Barang</span>
                                <h4 class="mb-0 font-weight-medium"><?= isset($barang) ? count($barang) : '-' ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card user_statistics">
                    <div class="header">
                        <h2>Barang Yang Paling Banyak Di Kredit</h2>
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