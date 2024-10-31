<main class="main-one" id="main-one">
    <section class="login-or-signup" style="z-index: 5;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="formbox">
                        <div class="login" id="login">
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
                            <div class="alert alert-primary alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('error');
                                $this->session->unset_userdata('error');?>
                            </div>
                            <?php } ?>
                            <form id="forgot_pass_form" class="animate__animated animate__backInRight" action="<?= site_url('user/up_pass/' . $user_id) ?>" method="POST">
                                <h2>New Password <span style="color: red">*</span></h2>
                                <div class="form-item" style="display: inline-block;">
                                    <div style="display: flex;">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                        <input type="password" name="password" id="password" placeholder="New Password" required>
                                    </div>
                                    <p id="err_password" style="font-size: 14px !important;"></p>
                                </div>
                                <h2>Confirm Password <span style="color: red">*</span></h2>
                                <div class="form-item" style="display: inline-block;">
                                    <div style="display: flex;">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                        <input type="password" name="cpassword" id="conpassword" placeholder="Confirm Password" required>
                                    </div>
                                    <p id="err_confpassword" style="font-size: 14px !important;"></p>
                                </div>
                                <div class="form-item-submit">
                                    <p id="err_check_pass"></p>
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
$("#forgot_pass_form").submit(function(e){
    var password = document.getElementById('password').value;
    var conf_password = document.getElementById('conpassword').value;
    if(password=='') {
		$('#password').prop('placeholder','Enter password');
		$("#password").focus();
		return false;
        e.preventDefault();
	}
   	if(password.length < 6) {
		$('#err_password').fadeIn().html('Password should be at least 6 characters long').css({'color':'red'});
		setTimeout(function(){$("#err_password").html("");},3000);
		$("#password").focus();
		return false;
        e.preventDefault();
	}
	if(conf_password=='') {
		$('#conf_password').prop('placeholder','Enter confirm password');
		$("#conf_password").focus();
		return false;
        e.preventDefault();
	}
   	if(conf_password.length<6) {
		$('#err_confpassword').fadeIn().html('Confirm Password should be at least 6 characters long').css({'color':'red'});
		setTimeout(function(){$("#err_confpassword").html("");},3000);
		$("#conf_password").focus();
		return false;
        e.preventDefault();
	}
	if (password != conf_password) {
		$('#err_check_pass').fadeIn().html('Password Mismatch').css({'color':'red','margin': '0px'});
		setTimeout(function(){$("#err_check_pass").html("");},3000);
		return false;
        e.preventDefault();
	}
});
</script>