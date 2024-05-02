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
              <h3>Orders</h3>

              <div class="myaccount-table table-responsive text-center">
                <table class="table table-bordered" id="ex">
                  <thead class="thead-light">
                    <tr>
                      <th>Sl No</th>
                      <th>Name</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Contact Email </th>
                      <th>Order Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(is_array($sellorders) && count($sellorders)>0){
                      $i=0;
                      foreach ($sellorders as $slord) {
                        $userdetl=$this->Master_model->getSingleRow('user_id',$slord->userid,'user_accounts');

                        $shadr=$this->Master_model->getSingleRow('order_id',$slord->orderid,'customer_shipping_addrs');

                        $bladr=$this->Master_model->getSingleRow('order_id',$slord->orderid,'customer_billing_addrs');

                        $i++; ?>
                        <tr>
                          <td><?=$i?></td>
                          <td><?=$slord->prd_title?></td>
                          <td><?=$slord->quantity?></td>
                          <td>$<?=$slord->quantity*$slord->amount?>.00</td>
                          <td>
                            <?php if($slord->userid =="guest"){
                              echo "Guest";
                            }else {
                              echo $userdetl->user_emailid;
                            }
                              ?></td>
                          <td><?=date('d M Y',strtotime($slord->order_date))?></td>
                                <td>
                                  <select class="form-control" onchange="changeOrderstatus(this.value,'<?=$slord->id?>')">
                                    <option value="processing" <?php if($slord->order_status=='processing'){echo "selected";} ?>>Processing</option>
                                    <option value="completed" <?php if($slord->order_status=='completed'){echo "selected";} ?>>Completed</option>
                                    <option value="shipped" <?php if($slord->order_status=='shipped'){echo "selected";} ?>>Shipped</option>
                                    <option value="cancelled" <?php if($slord->order_status=='cancelled'){echo "selected";} ?>>Cancelled</option>
                                    <option value="declined" <?php if($slord->order_status=='declined'){echo "selected";} ?>>Declined</option>
                                    <option value="disputed" <?php if($slord->order_status=='disputed'){echo "selected";} ?>>Disputed</option>
                                    <option value="returned" <?php if($slord->order_status=='returned'){echo "selected";} ?>>Return & Refund Request</option>
                                     <option value="refunded" <?php if($slord->order_status=='refunded'){echo "selected";} ?>>Refunded</option>
                                  </select>
                                </td>
                                <td><a href="<?=site_url('view-orders/'.base64_encode($slord->product_id))?>" class="btn btn-primary btn-xs">View</a></td>
                              </tr>
                            <?php } } else{ ?>
                              <tr>
                                <td colspan="8">No Orders yet..</td>
                              </tr>
                            <?php  } ?>
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