<style>
        #logo-sec{
          display:none;
        }
      #signup{
        display:none;
      }
    </style>
 
<main class="main-one" id="main-one"> 
        <section class="login-or-signup" style="z-index: 5;">
          <div class="container">
            <div class="row" >
              <div class="col-sm-12 col-md-12 col-xl-6 col-lg-5 ">
                <div class="search">
                <div class="form-box">
                  <?php $uri= $this->uri->segment('1');?>
                  <h2><span <?php if($uri=='login'){?> class="sactive" <?php } else { ?>class="in-active" <?php } ?> style="background:transparent;box-shadow:none;" id="login-name" onclick="openlogin();">Login</span> &emsp; <span class="divider"> | &emsp;</span>
                    <span <?php if($uri=='signup'){?> class="sactive" <?php } else { ?>class="in-active" <?php } ?> id="signup-name"  onclick="opensignup();">Signup</span></h2>
                  <br>
                  <br>
                   <?php
                    if($this -> session -> flashdata('errorlist')){
              ?>
              <div class="alert alert-info alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?php echo $this -> session -> flashdata('errorlist'); ?>
              </div>
              <?php
          }
          if($this -> session -> flashdata('success')){
              ?>
              <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?php echo $this -> session -> flashdata('success'); ?>
              </div>
              <?php
          }
          if($this -> session -> flashdata('error')){
              ?>
              <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?php echo $this -> session -> flashdata('error'); ?>
              </div>
              <?php
          }
          $err = validation_errors();
          if($err){
              ?>
              <div class="alert alert-warning alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <?php echo $err; ?>
              </div>
              <?php
          }
          ?>
                  <div class="login" id="login" <?php if($uri=='login'){?> style="display: block;" <?php } ?> <?php if($uri=='signup'){?> style="display: none;" <?php } ?>>
                        
                    <form  class="animate__animated animate__backInLeft" role="form" action="<?=site_url('login')?>" method="post" id="log-form">
                      <p id="text" class="capstext">Email address and paswword are case sentive.WARNING! Caps lock is On.</p>
                      <div class="form-item">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="email" name="umail" id="validemail" placeholder="Email" autocomplete="off" required>
                      </div>
                      <div class="form-item">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" name="upass" id="validpassword" value="" placeholder="Password" required>

                      </div>
                        <p class="almem"><a href="<?=site_url('forgot-password')?>">Forgot Password?</a></p>
                      
                      <div class="form-item-submit">
                        <input type="submit" value="Login">
                         
                        <!-- <input type="submit" onclick="goBack()" value="Cancel"> -->
                      </div>
                    </form>
                  </div>
                  <div class="login" id="signup" <?php if($uri=='signup'){?> style="display: block;" <?php } ?> <?php if($uri=='login'){?> style="display: none;" <?php } ?>>
                    <form class="animate__animated animate__backInRight" role="form" action="<?=site_url('signup')?>" method="post" id="sig-form" onSubmit = "return checkPassword(this)" >
                      <div class="form-item">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" class="name" name="fname" placeholder="First name" required>
                        <input type="text" class="name"  name="lname" placeholder="Last name" required>
                      </div>
                      <span class="alert-red" id="mailiderror">Email format is wrong</span>
                      <div class="form-item">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="email" id="remail" name="email" placeholder="Email" required>
                      </div>
                       <span id="passworderror"></span>
                      <div class="form-item">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" id="password" name="password" placeholder="Password" onchange="check_pass()" required>
                      </div>
                      <div class="form-item">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password"   id="confirm_password" name="con_password" onchange="check_pass()" placeholder="Confirm Password" required>
                      </div>
                       <div class="form-item">
                        <i class="fa fa-user-secret" aria-hidden="true"></i>
                        <select name="u_type" required>
                          <option value="">Select User Type</option>
            							<option value="1">Business Owner</option>
                          <option value="2">Service Provider</option>
            							<option value="3">Seller</option>
                          <option value="4">User</option>
            						</select>
                      </div>
                      
                        <p class="almem"><a href="<?php echo base_url();?>login" >Already a member?</a></p>
                          <div class="form-item-submit">
                          <input type="submit" id="subsignup" value="Signup" name="submit">

                          <input type="submit" onclick="goBack()" value="Cancel">
                        </div>
                      
                    </form>
                  </div>
                </div>
                </div>
                <!-- <div class="button-box"> 
                  <a href="<?=site_url('list-your-business')?>">
                    <button> List your Business</button>
                  </a>
                  <a href="<?php echo base_url();?>">
                    <button> Get some Coupons </button>
                  </a>
                </div> -->
              </div>
              <div class="col-6 search-opp-display" style="max-height:650px;">
                <img src="<?=site_url()?>fassets/images/svg%20items/Group%2047.svg">
              </div>
            </div>
          </div>
        </section>
      </main>
   
    <script>
        $(document).ready(function() {
     $("#fmobile").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
       return false;
    }
   })
 });
</script>

 <script>
   $("input[name=email]").change(function(){
  var eemail = $("#remail").val();
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (!filter.test(eemail)) {
      $('#mailiderror').show();
     $("#remail").val(' ');
    } else {
      $('#mailiderror').hide(); 
     return true;
    }
  });
 </script>
 <script>
   function check_pass() {
    if (document.getElementById('password').value ==
        document.getElementById('confirm_password').value) {
        document.getElementById('subsignup').disabled = false;
        document.getElementById('passworderror').style.color = 'green';
        document.getElementById('passworderror').innerHTML = 'matching';
    } else {
        document.getElementById('subsignup').disabled = true;
        document.getElementById('passworderror').style.color = 'red';
        document.getElementById('passworderror').innerHTML = 'Passwords do not match';
    }
}
 </script>
 <script>

   var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    // document.getElementById('passworderror').style.color = 'green';
    // document.getElementById('passworderror').innerHTML = 'matching';
  } else {
    document.getElementById('passworderror').style.color = 'red';
    document.getElementById('passworderror').innerHTML = 'Passwords do not match';
    return false;
  }
}
 </script>
 <script>
var input = document.getElementById("validemail");
var text = document.getElementById("text");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});
</script>

