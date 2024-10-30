<main class="main-one" id="main-one">
    <section class="login-or-signup" style="z-index: 5;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="formbox">
                        <div class="login" id="login">
                            <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-info alert-dismissible">
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
                            <?php } ?>
                            <form class="animate__animated animate__backInRight" action="<?= site_url('user/sendForgetMail') ?>" method="POST">
                                <h2>Enter Your Email</h2>
                                <p id="forgetext" style="margin-bottom: 0px;"></p>
                                <div class="form-item">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <input type="email" id="foremail" name="forgetemail" placeholder="Email" onblur="return checkemail();" autocomplete="off" required>
                                </div>
                                <div class="form-item-submit">
                                    <input type="submit" id="subsignup" value="Submit" name="submit" disabled>
                                    <input type="submit" onclick="history.go(-1); return false;" value="Cancel">
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
    }) .done(function (e) {
        if (e == 1) {
            $('#forgetext').html('<p class="text-danger" style="font-size: 15px; margin-top: 15px; margin-bottom: 0px;">Your account is disabled by admin. Please contact administrator.</p>');
            //$('#foremail').val('');
            setTimeout(() => {
                $('#forgetext').html();
            }, 3000);
            $("#subsignup").prop('disabled',true);
        } else if(e == 2) {
            $('#forgetext').html('<p class="text-danger" style="font-size: 15px; margin-top: 15px; margin-bottom: 0px;">Email address verification is pending.</p>');
            setTimeout(() => {
                $('#forgetext').html();
            }, 3000);
            $("#subsignup").prop('disabled',true);
        } else if(e == 4) {
            $('#forgetext').html('<p class="text-danger" style="font-size: 15px; margin-top: 15px; margin-bottom: 0px;">Email address is not registered with us. Please registered yourself.</p>');
            setTimeout(() => {
                $('#forgetext').html();
            }, 3000);
            $("#subsignup").prop('disabled', true);
        } else {
            $('#forgetext').html('');
            $("#subsignup").prop('disabled', false);
        }
    });
}
</script>