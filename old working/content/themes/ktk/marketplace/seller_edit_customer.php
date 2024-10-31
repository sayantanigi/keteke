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
          <div class="tab-pane fade show active" id="address-edit" role="tabpanel">
            <div class="myaccount-content">
              <h3>Update Customer details</h3>

              <div class="account-details-form">
                <form action="<?=site_url('edit-customer/'.$customer->user_id)?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-6 col-12 mb-30">
                      <label>First Name</label>
                      <input placeholder="First Name" name="frm[user_fname]" value="<?=$customer->user_fname?>" type="text">
                    </div>
                    <div class="col-lg-6 col-12 mb-30">
                      <label>Last Name</label>
                      <input placeholder="Last Name" name="frm[user_lname]" type="text" value="<?=$customer->user_lname?>">
                    </div>
                    <div class="col-lg-6 col-12 mb-30">
                      <label>Email</label>
                      <input placeholder="Email"  readonly type="email" value="<?=$customer->user_emailid?>">
                    </div>
                    <div class="col-lg-6 col-12 mb-30">
                      <label>Password</label>
                      <input placeholder="Password"  name="frm[user_pasword]" type="password" value="<?=base64_decode($customer->user_pasword)?>">
                    </div>
                    
                    <div class="col-lg-12 col-12 mb-30">
                     <button class="save-change-btn" type="submit">Update </button>
                     <button class="save-change-btn" onclick="goBack()">Cancel</button>
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
<script>
  function fetchprice(){
    var regPrice = $("#maxPrice").val();
    var dprcnt = $("#disc_percent").val();
    var offprc = (regPrice*dprcnt)/100;
    var discprc = Math.round(regPrice-offprc);
    $("#offedprice").val(discprc);
  }
</script>