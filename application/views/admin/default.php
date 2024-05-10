<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Keteke | <?=$title?></title> 
  <link rel="icon" href="<?=site_url('fassets/images/favicon.png')?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/plugins/jqvmap/jqvmap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/dist/css/adminlte.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <link href="<?= site_url('assets/admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>" rel="stylesheet" type="text/css" />
  <!-- summernote -->
  <link rel="stylesheet" href="<?=site_url('assets/admin/plugins/summernote/summernote-bs4.min.css')?>">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="<?=site_url()?>fassets/marketplace/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?=site_url()?>fassets/marketplace/css/bootstrap-tagsinput.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.22/sorting/datetime-moment.js">

  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=site_url()?>" class="brand-link">
      <img src="<?=theme_option('logo')?>" alt="Keteke Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Keteke</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=site_url('assets/images/profile/user-icon.png')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="<?=site_url('dashboard')?>" class="nav-link <?=($tab=='dashboard')?'active':'' ;?> ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item <?=($tab=='members')?'menu-is-opening menu-open':'' ;?> ">
            <a href="#" class="nav-link <?=($tab=='members')?'active':'' ;?> ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Member & Newsletter Mgmt
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             <!--  <li class="nav-item">
                <a href="<?=admin_url('members/add')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Member</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="<?=admin_url('members')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Member List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=admin_url('members/newsletters')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Newsletter List</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item <?=($tab=='banners')?'menu-is-opening menu-open':'' ;?> ">
            <a href="#" class="nav-link <?=($tab=='banners')?'active':'' ;?> ">
              <i class="nav-icon fas fa-camera"></i>
              <p>
                Marketplace Banner Mgmt
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=admin_url('banner/add')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=admin_url('banner')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banner List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?=($tab=='subcat'||$tab=='add_subcat' ||$tab=='mrktcat')?'menu-is-opening menu-open':'' ;?> ">
            <a href="#" class="nav-link <?=($tab=='subcat')?'active':'' ;?> ">
              <i class="nav-icon fas fa-arrows-alt"></i>
              <p>
                Category Mgmt
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=admin_url('categories/categoryIndex')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=admin_url('categories/add')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Subcategory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=admin_url('categories')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subcategory List</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="<?=admin_url('categories/addMarketcategory')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Marketplace Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=admin_url('categories/MarketCategoryindex')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marketplace Category List</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="<?=admin_url('categories/submenumarketplaceindex')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marketplace sub-menu List</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item <?=($tab=='country'||$tab=='add_country')?'menu-is-opening menu-open':'' ;?> ">
            <a href="#" class="nav-link <?=($tab=='country')?'active':'' ;?> ">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Country Mgmt
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=admin_url('countries/add')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Country</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=admin_url('countries')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Country List</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item <?=($tab=='dir_list_shop')?'menu-is-opening menu-open':'' ;?> ">
            <a href="#" class="nav-link <?=($tab=='dir_list_shop')?'active':'' ;?> ">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Business Mgmt
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=admin_url('directories')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Business</p>
                </a>
              </li>
             
            </ul>
          </li>
           <li class="nav-item <?=($tab=='products' || $tab=='trans')?'menu-is-opening menu-open':'' ;?> ">
            <a href="#" class="nav-link <?=($tab=='products')?'active':'' ;?> ">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Product & Order Mgmt
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=admin_url('products')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=admin_url('products/transactions')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaction List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=admin_url('products/DraftOrdertransactions')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Draft Order List</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item <?=($tab=='cms')?'menu-is-opening menu-open':'' ;?> ">
            <a href="#" class="nav-link <?=($tab=='cms' || $tab=='add_cms')?'active':'' ;?> ">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Content Mgmt
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="<?=admin_url('cms/add')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add CMS</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="<?=admin_url('cms')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CMS Lists</p>
                </a>
              </li>
            </ul>
          </li>
         
         <li class="nav-item <?=($tab=='coupons')?'menu-is-opening menu-open':'' ;?> ">
            <a href="#" class="nav-link <?=($tab=='coupons')?'active':'' ;?> ">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Coupon code Mgmt
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=admin_url('coupon')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Coupon code Lists</p>
                </a>
              </li>
            </ul>
          </li>  
           <li class="nav-item">
            <a href="<?=admin_url('option')?>" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Why Choose Us
              </p>
            </a>
          </li>

         <!--  <li class="nav-item">
            <a href="reviews.html" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Reviews
              </p>
            </a>
          </li> -->
      <li class="nav-item <?=($tab=='change_password')?'menu-is-opening menu-open':'' ;?> ">
            <a href="<?=admin_url('profile')?>" class="nav-link <?=($tab=='change_password')?'active':'' ;?> ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>
      <li class="nav-item">
            <a href="<?=admin_url('users/logout')?>" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$title?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$title?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     <div class="content-header">
      <?php $this->load->view('alert');?>
                  </div>
                  <?php
                  $this->load->view($main);
                  ?>
                </div>

    <footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y')?> <a href="https://keteke.net">keteke.net</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=site_url('assets/admin/plugins/jquery/jquery.min.js')?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=site_url('assets/admin/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=site_url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- ChartJS -->
<script src="<?=site_url('assets/admin/plugins/chart.js/Chart.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?=site_url('assets/admin/plugins/sparklines/sparkline.js')?>"></script>
<!-- JQVMap -->
<script src="<?=site_url('assets/admin/plugins/jqvmap/jquery.vmap.min.js')?>"></script>
<script src="<?=site_url('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?=site_url('assets/admin/plugins/jquery-knob/jquery.knob.min.js')?>"></script>
<script src="<?=site_url('assets/admin/plugins/moment/moment.min.js')?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=site_url('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<!-- Summernote -->
<script src="<?=site_url('assets/admin/plugins/summernote/summernote-bs4.min.js')?>"></script>
<!-- overlayScrollbars -->
<script src="<?=site_url('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=site_url('assets/admin/dist/js/adminlte.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=site_url('assets/admin/dist/js/demo.js')?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=site_url('assets/admin/dist/js/pages/dashboard.js')?>"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?=site_url()?>fassets/marketplace/js/bootstrap-tagsinput.js"></script>
  <script src="<?= site_url('assets/admin/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
  <!-- <script src="<?=site_url()?>fassets/marketplace/js/shieldui-all.min.js"></script> -->
   <script type="text/javascript">
        jQuery(function ($) {
            $("#chart").shieldChart({
                theme: "bootstrap",
                exportOptions: {
                    image: false,
                    print: false
                },
                seriesSettings: {
                    bar: {
                        stackMode: "normal"
                    }
                },
                axisX: {
                    categoricalValues: [
                        "Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec"
                     ]
                },
                primaryHeader: {
                    text: "Keteke"
                },
                dataSeries: [{
                    seriesType: "bar",
                    collectionAlias: "Total Sale",
                    data: [40, 32, 34, 36, 45, 33, 34, 75, 85, 150, 55, 20]
                }]
            });
        });

    </script>
    <style>
      text tspan{
        display: none;
      }
      g text tspan{
        display: block;
      }
    </style>
<script>
  $(document).ready(function(){
    $(".delete").click(function(){
      if (!confirm("Do you want to delete")){
        return false;
      }
    });
  });
</script>
<script>
function delete_confirm(){
    if($('.checkbox:checked').length > 0){
        var result = confirm("Are you sure to delete selected Listing?");
        if(result){
            return true;
        }else{
            return false;
        }
    }else{
        alert('Select at least 1 record to delete.');
        return false;
    }
}

$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
  
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});

</script>
<script>
function goBack() {
  window.history.back();
}
</script>
<script>
    $(document).ready(function() {
      $('#ex').DataTable();
    } );

    $(function () {
        $("#fromdate").datepicker({ 
              autoclose: true,
              format:'yyyy-mm-dd', 
              todayHighlight: true
        }).datepicker();
        $("#expiredate").datepicker({ 
              autoclose: true,
              format:'yyyy-mm-dd', 
              todayHighlight: true
        }).datepicker();
      });
 
  </script>
</body>
</html>
