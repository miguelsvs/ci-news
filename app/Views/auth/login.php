<div class="container text-light mt-4">
    <form method="post" action="<?= base_url('login') ?>" autocomplete="off">
        <?= csrf_field(); ?>
        <?php if(!empty(session()->getFlashdata('fail'))) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>
        <?php  if(!empty(session()->getFlashdata('success'))) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-title">
                    <h2>Login</h2>
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <input type="text" class="form-control" name="email" value="<?= set_value('email'); ?>">
                            <span class="text-danger"><?= isset($validation) ? $validation->getError('email') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Password</label>
                            <input type="password" class="form-control" name="password">
                            <span class="text-danger"><?= isset($validation) ? $validation->getError('password') : '' ?></span>
                        </div>

                        <div class="col-lg-12 loginbttm">
                            <div class="col-lg-6 login-btm login-text">
                                <!-- Error Message -->
                            </div>
                            <div class="col-lg-6 login-btm login-button mt-3">
                                <button type="submit" class="btn btn-outline-primary">Sign In</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
    </form>