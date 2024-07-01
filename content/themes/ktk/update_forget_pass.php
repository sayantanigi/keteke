<main class="main-one" id="main-one">
    <section class="login-or-signup" style="z-index: 5;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="formbox">
                        <div class="login" id="login">
                            <?php
                            if ($this->session->flashdata('success')) {
                                ?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                                <?php
                            }
                            if ($this->session->flashdata('error')) {
                                ?>
                                <div class="alert alert-primary alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                                <?php
                            }
                            ?>
                            <form class="animate__animated animate__backInRight"
                                action="<?= site_url('user/up_pass/' . $user_id) ?>" method="POST">
                                <h2>New Password</h2>
                                <div class="form-item">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                    <input type="password" name="password" placeholder="New Password" required>
                                </div>
                                <h2>Confirm Password</h2>
                                <div class="form-item">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                    <input type="password" name="cpassword" placeholder="Confirm Password" required>
                                </div>
                                <div class="form-item-submit">
                                    <input type="submit" value="Update" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    function checkemail() {
        var foremail = document.getElementById('foremail').value;

        $.ajax({
            url: '<?= site_url("welcome/checkvalidmail") ?>',
            type: 'POST',
            dataType: 'html',
            data: { foremail: foremail },
        })
            .done(function (e) {
                if (e == 0) {
                    $('#forgetext').html('<b class="text-danger">Please Enter valid Email Address!!</b>');
                    $('#foremail').val('');
                }
                else {
                    $('#forgetext').html('<p class="text-success"><b>Email Verified..</b></p>');
                }
            });

    }
</script>