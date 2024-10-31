<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <link rel="icon" href="<?=site_url('fassets/images/favicon.png')?>">

  <title>Login Panel | <?= SITENAME ?></title>

  <!-- Bootstrap Core CSS -->
  <link href="<?= base_url('assets/admin/dist/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/admin/dist/css/animate.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/admin/dist/css/style.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/admin/dist/css/colors/default.css') ?>" id="theme" rel="stylesheet">
</head>
<body>
  <!-- Preloader -->
 
    <section id="wrapper" class="new-login-register" style="background-image: linear-gradient(#2874f0, #7b7b7b);background-repeat: no-repeat;">
    <div class="new-login-box">
       <?php
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
      <div class="white-box">
        <a href="<?= base_url() ?>" class="text-center db m-b-20">
          <div class="logo">
           <img src="<?=theme_option('logo')?>" class="img-responsive" width="60%">
          </div>
        </a>
        <form class="form-horizontal form-material" action="<?=admin_url('users/login')?>" method="post">
          <div class="form-group  m-t-20">
            <div class="col-xs-12">
             <input type="text" name="username" placeholder="Username" class="form-control input-sm" autocomplete="off"/>
            </div>
          </div>

          <div class="form-group">
            <div class="col-xs-12">
               <input type="password" name="password" placeholder="Password" class="form-control input-sm" />
            </div>
          </div>
          <!-- <div class="form-group">
            <div class="col-md-12">
              <div class="checkbox checkbox-main pull-left p-t-0">
                <input id="checkbox-signup" type="checkbox" checked="checked">
                <label for="checkbox-signup"> Remember me </label>
              </div>
            </div>
          </div> -->

          <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
              <button class="btn btn-main btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Log In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- jQuery -->
  <script src="<?= base_url('assets/admin/plugins/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/dist/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/plugins/sidebar-nav/dist/sidebar-nav.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/dist/js/jquery.slimscroll.js') ?>"></script>
  <script src="<?= base_url('assets/admin/dist/js/waves.js') ?>"></script>
  <script src="<?= base_url('assets/admin/dist/js/custom.min.js') ?>"></script>
  <script src="<?= base_url('assets/admin/plugins/styleswitcher/jQuery.style.switcher.js') ?>"></script>

</body>
</html>
