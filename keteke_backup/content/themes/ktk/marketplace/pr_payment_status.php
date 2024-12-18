<div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <!--=======  breadcrumb content  =======-->

        <div class="breadcrumb-content">
         <h2>Payment  Status</h2>
         <ul>
            <li class="has-child"><a href="<?=site_url('shop/pr_cart')?>">Payment</a></li>
            <li>cart</li>
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
            <!-- Checkout Form s-->
    <?php 
    
    if(!empty($orders)){ ?>
    <!-- Display transaction status -->
<div class="row">
  <div class="col-lg-10 offset-lg-1">
    <div class="boxPaypent">
      <?php if($orders->payment_status == 'succeeded'){ ?>
      <h1 class="text-success text-center">Your Payment has been Successful!</h1>
      <?php }else{ ?>
      <h1 class="text-danger text-center">The transaction was successful! But your payment has been failed!</h1>
      <?php } ?>
    
      <h4>Payment Information</h4>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td><b>Reference Number:</b></td>
            <td> <?=$orders->order_id; ?></td>
          </tr>
          <tr>
            <td><b>Transaction ID:</b></td>
            <td><?=$orders->txn_id; ?></td>
          </tr>
           <tr>
            <td><b>Transaction Date:</b></td>
            <td><?=$orders->date; ?></td>
          </tr>
          <tr>
            <td><b>Paid Amount:</b></td>
            <td><?=$orders->payment_gross?> USD</td>
          </tr>
          <tr>
            <td><b>Payment Status:</b></td>
            <td><?=$orders->payment_status?></td>
          </tr>
        </tbody>
      </table>

      <h4>Product Information</h4>
      <table class="table-bordered table">
        <thead>
          <tr>
            <th></th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Shipping Charge</th>
            <th>Order Status</th>
          </tr>
        </thead>
        <tbody>
           <?php
           
            if(is_array($products) && count($products)>0){
              $i=0;
          foreach ($products as $prd) { 
            $i++;
            $prdetl=$this->Master_model->getSingleRow("productId",$prd->product_id, "products");
             $shaddr=$this->Master_model->getSingleRow('order_id',$prd->orderid,'customer_shipping_addrs');
                  
            $baddr=$this->Master_model->getSingleRow('order_id',$prd->orderid,'customer_billing_addrs');

            ?>
          <tr>
            <td><?=$i?></td>
            <td><?=@$prd->prd_title?></td>
            <td><?=@$prd->quantity?></td>
            <td><?=$prd->quantity.'*'.$prd->amount?> USD</td>
            <td><?=$prdetl->shipping_charge?> USD</td>
            <td><?=$prd->order_status?></td>
          </tr>
          <tr>
            <td colspan="3">
            <?php if($prd->billing_addr==1){ ?>
              <h4>Billing Address</h4>
                      <p><?=$baddr->billing_fname.' '.$baddr->billing_lname?></p>
                      <p><?=$baddr->billing_address?></p>
                      <p><?=$baddr->billing_city.','.$baddr->billing_state.','.$baddr->billing_country.','.$baddr->billing_zip?></p>
                      <p>Phone: <?=$baddr->billing_phone?></p>
                      <p>Email: <?=$baddr->billing_email?></p>
                    <?php } ?>
          </td>
           <td colspan="3">
            <?php if($prd->shipping_addr==1){ ?>
                     <p><?=$shaddr->shipping_fname.' '.$shaddr->shipping_lname?></p>
                     <p><?=$shaddr->shipping_address?></p>
                     <p><?=$shaddr->shipping_city.','.$shaddr->shipping_state.','.$shaddr->shipping_country.','.$shaddr->shipping_zip?></p>
                     <p>Phone: <?=$shaddr->shipping_phone?></p>
                     <p>Email: <?=$shaddr->shipping_email?></p>
                   <?php } ?>
          </td>
          </tr>
        <?php } } ?>
        </tbody>

      </table>
      
      <?php }else{ ?>
      <h1 class="text-danger text-center">The transaction has failed</h1>
      <?php } ?>
      <br>

      <div class="text-center">
        <a href="<?=site_url('shop')?>" class="btn btn-danger" style="color: #fff !important;">Back to Shop</a>
      </div>
    </div>
  </div>
</div>
         </div>
      </div>
   </div>
</div>
