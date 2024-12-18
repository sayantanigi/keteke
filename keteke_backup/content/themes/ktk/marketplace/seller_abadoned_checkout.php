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
          <div class="tab-pane fade show active" id="orders" role="tabpanel">
            <div class="myaccount-content">
              <div class="row">
               <div class="col-lg-8 col-md-6 col-xs-12">
                <h3>Checkout Product List</h3>
                <?php  //print_r($chkroducts); ?>
              </div>
            </div>
            <div class="myaccount-table table-responsive text-center">
              <table class="table table-bordered" id="ex">
                <thead class="thead-light">
                  <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Checkout Date</th>
                    <th>Customer Email</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody id="showproductlist">
                  <?php

                   if(is_array($chkroducts) && count($chkroducts)>0){
                    $j=0;
                    foreach ($chkroducts as $mp) { 
                      $j++;
                      $userdetl=$this->Master_model->getAll_where('user_accounts','user_id',$mp->userid);
                      ?>
                      <tr >
                        <td><?=$j?></td>
                        <td><?=$mp->productName?></td>
                        <td><?=date('M d, Y',strtotime($mp->order_date))?></td>
                        <td><strong><?=$userdetl->user_fname.' '.$userdetl->user_lname?><br>
                          <?=$userdetl->user_emailid?></strong></td>
                        <td><a href="<?=site_url('viewabandoned-orders/'.base64_encode($mp->productId))?>" class="btn btn-warning btn-xs">View</a>
                      </td>
                      </tr>
                    <?php } } ?>
                    
                  </tbody>
                </table>
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
  function getproductbycategory(){
    var caatid=$("#mcategory").val();
    var loguid=$("#userid").val();
    $.ajax({
     url: '<?=site_url("shop/fetchproduct")?>',
     type: 'POST',
     dataType: 'html',
     data: {caatid:caatid,loguid:loguid},

     success: function(data) {
      console.log(data);
      $('#showproductlist').html(data);
      
    }
  })
  }
</script>
<script>
 $(document).ready(function(){
  $(".delete").click(function(){
    if (!confirm("Do you want to delete")){
      return false;
    }
  });
});
</script>