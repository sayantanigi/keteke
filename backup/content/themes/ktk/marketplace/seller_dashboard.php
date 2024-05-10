<div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <!--=======  breadcrumb content  =======-->
        
        <div class="breadcrumb-content">
          <ul>
            <li class="has-child"><a href="<?=site_url()?>">Home </a></li>
            <li>Seller Dashboard</li>
          </ul>
        </div>
        
        <!--=======  End of breadcrumb content  =======-->
      </div>
    </div>
  </div>
</div>
<div class="page-section pb-40">
 <div class="container">
  <div class="row">
    <div class="col-12">
      <div class="row">
        <!-- My Account Tab Menu Start -->
        <div class="col-lg-3 col-12">
          <?php
          $this->load->front_view('marketplace/mrkt_sidebar',$this->data);
           ?>
       </div>
       <!-- My Account Tab Menu End -->

       <!-- My Account Tab Content Start -->
       <div class="col-lg-9 col-12">
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
        <div class="tab-content" id="myaccountContent">
          <!-- Single Tab Content Start -->
          <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
            <div class="myaccount-content">
              <h3>Dashboard</h3>
              
              <div class="welcome mb-20">
                <p>Hello, <strong><?=$udetail->user_fname.' '.$udetail->user_lname?></strong> (If Not <strong><?=$udetail->user_fname?> !</strong><a href="<?=site_url('signout')?>" class="logout"> Logout</a>)</p>
              </div>

              <div id="chart"></div>
            </div>
          </div>
          <!-- Single Tab Content End -->
        </div>
      </div>
      <!-- My Account Tab Content End -->
    </div>

  </div>
</div>   
</div>
</div>