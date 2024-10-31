<div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <!--=======  breadcrumb content  =======-->

        <div class="breadcrumb-content">
         <h2>Draft Order Checkout</h2>
         <ul>
            <li class="has-child"><a href="<?=site_url('shop/pr_cart')?>">Cart</a></li>
            <li>Checkout</li>
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
            <form  action="<?=site_url('seller/placeOrders')?>" method="post" class="checkout-form form-validation">
               <div class="row row-40">
                  <div class="col-lg-7 mb-20">
                    
            <!-- Billing Address -->
            <div id="billing-form" class="mb-40">
               <h4 class="checkout-title">Billing Address</h4>
               <div class="row">
                  <div class="col-md-6 col-12 mb-20">
                     <label>First Name*</label>
                     <input type="text" name="billingfname" value="<?=@$udetail->user_fname?>" placeholder="First Name" >
                     
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Last Name*</label>
                     <input type="text" name="billinglname" value="<?=@$udetail->user_lname?>" placeholder="Last Name" >
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Email Address*</label>
                     <input type="email" name="billing_email" value="<?=@$udetail->user_emailid?>" placeholder="Email Address" >
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Phone no*</label>
                     <input type="text" name="billing_phone" placeholder="Phone number" required>
                  </div>
                  <div class="col-12 mb-20">
                     <label>Address*</label>
                     <input type="text" name="billing_address" placeholder="Address line 1">
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Country*</label>
                     <input type="text" name="billing_country" placeholder="Country">
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Town/City*</label>
                     <input type="text" name="billing_city" placeholder="Town/City">
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>State*</label>
                     <input type="text" name="billing_state" placeholder="State">
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Zip Code*</label>
                     <input type="text" name="billing_zip" placeholder="Zip Code">
                  </div>
                  <div class="col-12 mb-20">
                     <div class="check-box">
                        <input type="checkbox" id="shiping_address" value="1" name="shipaddress" data-shipping="">
                        <label for="shiping_address">Ship to Different Address</label>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Shipping Address -->
            <div id="shipping-form" class="mb-40">
               <h4 class="checkout-title">Shipping Address</h4>
               <div class="row">
                  <div class="col-md-6 col-12 mb-20">
                     <label>First Name*</label>
                     <input type="text" name="shipping_fname" placeholder="First Name">
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Last Name*</label>
                     <input type="text" name="shipping_lname" placeholder="Last Name">
                  </div>
                  <div class="col-md-6 col-12 mb-20"> 
                     <label>Email Address*</label>
                     <input type="email" name="shipping_email" value="<?=@$udetail->user_emailid?>"  placeholder="Email Address">
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Phone no*</label>
                     <input type="text" name="shipping_phone" placeholder="Phone number">
                  </div>
                  <div class="col-12 mb-20">
                     <label>Address*</label>
                     <input type="text" name="shipping_address" placeholder="Address line 1">
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Country*</label>
                     <input type="text" name="shipping_country" placeholder="Country">
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Town/City*</label>
                     <input type="text" name="shipping_city" placeholder="Town/City">
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>State*</label>
                     <input type="text" name="shipping_state" placeholder="State">
                  </div>
                  <div class="col-md-6 col-12 mb-20">
                     <label>Zip Code*</label>
                     <input type="text" name="shipping_zip" placeholder="Zip Code">
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-5">
            <div class="row">
               <!-- Cart Total -->
               <div class="col-12 mb-60">
                  <h4 class="checkout-title">Draft Order Total</h4>
                  <div class="checkout-cart-total">
                     <h4>Product <span>Total</span></h4>
                     <ul>
                        <?php if(count($draftItems)>0){
                           $sfee=0;
                           $subtotal=0;
                           $grtotal=0;
                           foreach ($draftItems as $crt) {
                              if($crt->shipping_charge==NULL){
                                 $shcharge='0';
                              }
                              else{
                                  $shcharge=$crt->shipping_charge;
                              }
                              $pricetotal=$crt->price;
                              $proddetls=$this->Master_model->getSingleRow('productId',$crt->product_id,'products');
                              ?>
                              <li><?=$proddetls->productName?> X <?=$crt->qty?> <span>$<?=$crt->price?>.00</span></li>
                              <li>Shipping charge <span>$<?=$shcharge?>.00</span></li>
                             <?php
                              $sfee += @$shcharge;
                              $subtotal += $pricetotal;
                              $grtotal = $subtotal + $sfee; ?>
                             
                           <?php } } ?>
                           <input type="hidden" name="total_paid_price" value="<?=$grtotal?>">
                           <input type="hidden" name="draftorderId" value="<?=$DraftorderId?>">
                           <input type="hidden" name="draftuserId" value="<?=$udetail->user_id?>">

                        </ul>
                        <p>Sub Total <span>$<?=$subtotal?>.00</span></p>
                        <p>Shipping Fee Total <span>$<?=$sfee?>.00</span></p>
                        <h4>Grand Total <span>$<?=$grtotal?>.00</span></h4>
                     </div>
                  </div>
                  <!-- Payment Method -->
                  <div class="col-12">
                     <h4 class="checkout-title">Payment Method</h4>
                     <div class="checkout-payment-method">

                        <!-- <div class="single-method">
                           <input type="radio" id="payment_cash" onclick="paymentThrough()" name="payment_method" value="COD">
                           <label for="payment_cash">Cash on Delivery</label>
                        </div> -->
                        <div class="single-method">
                           <input type="radio" id="payment_paypal" name="payment_method" value="stripe">
                           <label for="payment_paypal">Stripe</label>
                        </div>
                        </div>
                              <!-- <div class="single-method">
                                 <input type="checkbox" id="accept_terms">
                                 <label for="accept_terms">I’ve read and accept the terms &amp; conditions</label>
                              </div> -->
                           </div>
                           <button class="place-order" type="submit">Place order</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>