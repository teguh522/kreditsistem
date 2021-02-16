<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="card forgot-pass">
            <div class="body">
                <p class="lead mb-3"><strong>Reset Password</strong></p>
                <form id="basic-form" autocomplete="off" method="post" enctype="multipart/form-data" action="<?php echo base_url('userconfig/action_update') ?>" novalidate>
                    <div class="form-group">
                        <input type="password" id="password" placeholder="New Password" name="password" data-parsley-minlength="8" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password_w" placeholder="Confirm Password" data-parsley-equalto="#password" name="password_w" data-parsley-minlength="8" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-round btn-primary btn-lg btn-block">Submit</button>
                    <a href="<?php echo base_url() ?>" class="btn btn-round btn-primary btn-lg btn-block">Batal</a>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>