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
                          <div class="tab-pane fade show active" id="account-info" role="tabpanel">
                              <div class="myaccount-content">
                                  <h3>Account Details</h3>

                                  <div class="account-details-form">
                                      <form action="<?=site_url('account-settings')?>" method="post">
                                          <div class="row">
                                              <div class="col-lg-6 col-12 mb-30">
                                                  <input id="first-name" placeholder="First Name" value="<?=$udetail->user_fname?>" type="text" name="user_fname">
                                              </div>

                                              <div class="col-lg-6 col-12 mb-30">
                                                  <input id="last-name" placeholder="Last Name"  value="<?=$udetail->user_lname?>"  type="text" name="user_lname">
                                              </div>

                                              <div class="col-12 mb-30">
                                                  <input id="email" placeholder="Email Address"  value="<?=$udetail->user_emailid?>"  type="email" readonly>
                                              </div>

                                              <div class="col-12 mb-30"><h4>Password change</h4></div>

                                              <div class="col-12 mb-30">
                                                  <input id="current-pwd" placeholder="Current Password"  type="password" value="<?=base64_decode($udetail->user_pasword)?>" readonly>
                                              </div>

                                              <div class="col-lg-6 col-12 mb-30">
                                                  <input id="new-pwd" placeholder="New Password" name="new_pass" type="password">
                                              </div>

                                              <div class="col-lg-6 col-12 mb-30">
                                                  <input id="confirm-pwd" placeholder="Confirm Password" name="con_pass" type="password">
                                              </div>

                                              <div class="col-12">
                                                  <button class="save-change-btn" type="submit">Save Changes</button>
                                              </div>

                                          </div>
                                      </form>
                                  </div>
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