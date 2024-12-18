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
              <div class="row mb-3">
               <div class="col-lg-8 col-md-6 col-xs-12">
                <h3 class="m-0">Draft Orders List</h3>
              </div>
              <div class="col-lg-4 col-md-6 col-xs-12 text-right">
                <a href="<?=site_url('create-draftorder')?>" class="btn btn-success">Create draft order</a>
              </div>
            </div>

              <div class="myaccount-table table-responsive text-center">
                <table class="table table-bordered" id="ex">
                  <thead class="thead-light">
                    <tr>
                      <th>Sl No</th>
                      <th>Customer Email</th>
                      <th>Paid Amount</th>
                      <th>Created</th>
                      <th>Payment Status</th>
                      <th>Email Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(is_array($sellerdrftorders) && count($sellerdrftorders)>0){
                      $i=0;
                      foreach ($sellerdrftorders as $slord) {
                        $userdetl=$this->Master_model->getSingleRow('user_id',$slord->pay_user_id,'user_accounts');

                        //$shadr=$this->Master_model->getSingleRow('order_id',$slord->orderid,'customer_shipping_addrs');

                        //$bladr=$this->Master_model->getSingleRow('order_id',$slord->orderid,'customer_billing_addrs');

                        $i++; ?>
                        <tr>
                          <td><?=$i?></td>
                          <td><?=$userdetl->user_emailid?></td>
                          <td>$ <?=$slord->paid_amount?></td>
                          <td><?=date('d M Y',strtotime($slord->payment_created_date))?></td>
                          <td>
                            <?=$slord->payment_status?>
                          </td>
                          <td>
                            <?php if($slord->email_sent==NULL){ ?>
                            <a href="<?=site_url('seller/dreftOrderMailsend/'.base64_encode($slord->id))?>" title="email send" class="btn btn-warning">Pending</a>
                              <?php
                              }else{
                                echo"Success";
                              } ?>
                          </td>
                           <td><a href="<?=site_url('view-draftorders/'.base64_encode($slord->id))?>" class="btn btn-primary btn-xs">View</a></td>
                          </tr>
                            <?php } } else{ ?>
                              <tr>
                                <td colspan="8">No Draft Orders yet..</td>
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