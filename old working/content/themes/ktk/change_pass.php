<main class="main-one" id="main-one">
    <div class="container">
        <div class="bootstrap snippets bootdey">
            <div class="row">
                <div class="profile-nav col-md-3">
                    <?php $this->load->front_view('user_sidebar', $this->data); ?>
                </div>
                <div class="profile-info col-md-9">
                    <div class="panel">
                        <div class="panel-body bio-graph-info">
                            <h1>Change Password</h1>
                            <div class="addbus" id="addbus">
                                <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php
                                    echo $this->session->flashdata('success');
                                    $this->session->unset_userdata('success');
                                    ?>
                                </div>
                                <?php }
                                if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php
                                    echo $this->session->flashdata('error');
                                    $this->session->unset_userdata('error');
                                    ?>
                                </div>
                                <?php }
                                $err = validation_errors();
                                if ($err) { ?>
                                <div class="alert alert-warning alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $err; ?>
                                </div>
                                <?php } ?>
                                <form class="dash-form" action="<?= site_url('change-password') ?>" role="form" method="post">
                                    <!--<div class="dash-form-item-full">
                                        <b>Current Password:</b>
                                        <input type="password" name="new_pass" value="">
                                    </div> -->
                                    <div class="dash-form-item-full">
                                        <b>New Password:</b>
                                        <input type="password" name="new_pass" value="">
                                    </div>
                                    <div class="dash-form-item-full">
                                        <b>Confirm New Password:</b>
                                        <input type="password" name="con_pass" value="">
                                    </div>
                                    <br>
                                    <input type="submit" value="Change">
                                    <input type="submit" onclick="goBack()" value="Cancel">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>