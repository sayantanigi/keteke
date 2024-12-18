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
              <h3>Draft Order Details</h3>

              <div class="table-responsive">
                <table class="table table-bordered orderTable">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $subtotal=0;
                    foreach ($sldrftord as $slord) {
                      $primgs=$this->Master_model->getSingleRow('productId',$slord->product_id,'product_images');
                      $shadr=$this->Master_model->getSingleRow('order_id',$slord->draftpayment_orderid,'customer_shipping_addrs');
                      $bladr=$this->Master_model->getSingleRow('order_id',$slord->draftpayment_orderid,'customer_billing_addrs');

                      ?>
                    <tr>
                      <td>
                        <a href="#"><?=$slord->productName?>  <img src="<?=site_url('assets/images/products/'.$primgs->productImage)?>" width="100px" class="img-fluid" alt=""> ✖ <?=$slord->qty?></a>
                      </td>
                       
                      <td>
                       USD <?=$slord->qty*$slord->price + $slord->shipping_charge?> + (Shipping charge) </td>
                     </tr>
                      <?php 
                      $subtotal += $slord->qty*$slord->price + $slord->shipping_charge; 
                   } ?>

                     <tr>
                      <td><strong>Subtotal:</strong></td>
                      <td><strong> USD <?=$subtotal?></strong></td>
                    </tr>
                    <!-- <tr>
                      <td><strong>Tax:</strong></td>
                      <td><strong> Rs. 45.00</strong></td>
                    </tr> -->
                   
                    <tr>
                      <td><strong>Payment Method:</strong></td>
                      <td><strong>Stripe</strong></td>
                    </tr>
                    <tr>
                      <td><strong>Order Status:</strong></td>
                      <td><strong><?=$slord->order_status?></strong></td>
                    </tr>
                    <tr>
                      <td><strong>Order Date:</strong></td>
                      <td><strong><?=date('m-d-Y',strtotime($draftdetl->tran_date))?></strong></td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-lg-6 mb-4">
                    <div class="order-addressInfo">
                      <h2 class="text-danger">Billing Address  </h2>
                      <p><strong> <?=$bladr->billing_fname.' '.$bladr->billing_lname?></strong></p>
                      <p><strong>Phone: <?=$bladr->billing_phone?></strong></p>
                      <p><strong>Email: <?=$bladr->billing_email?></strong></p>
                      <p><strong>Address:</strong> <?=$bladr->billing_address.'<br>'.$bladr->billing_city.$bladr->billing_state .'<br>'.$bladr->billing_country.' '.$bladr->billing_zip?></p>
                    </div>
                  </div>
                  <div class="col-lg-6 mb-4">
                    <div class="order-addressInfo">
                      <h2 class="text-danger">Shipping Address </h2>
                      <?php if($slord->shipping_addr==1){ ?>
                       <p><strong><?=$shadr->shipping_fname.' '.$shadr->shipping_lname?></strong></p>
                       <p><strong>Phone: </strong><?=$shadr->shipping_phone?></p>
                       <p><strong>Email: </strong><?=$shadr->shipping_email?></p>
                       <p><strong>Address:</strong> <?=$shadr->shipping_address.'<br>'.$shadr->shipping_city.$shadr->shipping_state .'<br>'.$shadr->shipping_country.','.$shadr->shipping_zip?></p>
                     <?php } ?>
                   </div>
                 </div>
                 <div class="col-lg-12 text-center mb-4">
                  <a href="<?=site_url('draft-orders')?>" class="btn btn-success" style="color: #fff !important">Back</a>
                </div>
              </div>
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
  function changeOrderstatus(orderstate,OrderId) {
    $.ajax({
     url: '<?php echo base_url("shop/updateOrderstatus");?>',       
     type: 'POST',       
     dataType: 'json',       
     data: {         
      orderstatus: String(orderstate),        
      ordId: String(OrderId),       
    },
    success:function (data) {
      if(data=='1')
      {
       window.location.reload();
     }
   }
 })
  }
</script>