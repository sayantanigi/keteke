<div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">

  <div class="container">

    <div class="row">

      <div class="col-lg-12">

        <!--=======  breadcrumb content  =======-->

        

        <div class="breadcrumb-content">

         <h2>Cart</h2>

         <ul>

          <li class="has-child"><a href="<?=site_url('shop/index')?>">Shop</a></li>

          <li>Cart</li>

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

</div>

<div class="col-12">

  <form action="#">

   <!--=======  cart table  =======-->

   <div class="cart-table table-responsive mb-40">

    <table class="table">

     <thead>

      <tr>

       <th class="pro-thumbnail">Image</th>

       <th class="pro-title">Product</th>

       <th class="pro-price">Price</th>

       <th class="pro-quantity">Quantity</th>

       <th class="pro-subtotal">Total</th>

       <th class="pro-remove">Remove</th>

     </tr>

   </thead>

   <tbody>

    <?php if(count($cartItems)>0){

      //$sfee=0;

      $grtotal=0;

      $subtotal=0;

      foreach ($cartItems as $crt) {

        $shipchrge=$this->Master_model->getSingleRow('productId',$crt['id'],'products');

       

        ?>

        <tr>

         <td class="pro-thumbnail"> 

          <a href="#">

           <img src="<?=site_url('assets/images/products/'.$crt['image'])?>" class="img-fluid" alt="">

         </a>

       </td>

       <td class="pro-title"><a href="#"><?=$crt['name']?></a></td>

       <td class="pro-price"><span>$ <?=$crt['price']?>.00</span></td>

        <td class="pro-quantity">

        <div class="pro-qty m-0">

          <input type="text" id="pquant" class="qtyval" value="<?=$crt['qty']?>"><a href="#" class="inc qty-btn">+</a>

          <input type="hidden" class="cartrowId" value="<?=$crt['rowid']?>">

          <a href="#" class="dec qty-btn">-</a>

        </div>

     </td>

       

      <td class="pro-subtotal"><span>$ <?= $crt['subtotal']?>.00</span></td>

      <td class="pro-remove"> <a href="<?= base_url('shop/removeItem/'.$crt['rowid'])?>" class="icon" ><i class="fa fa-trash-o"></i></a></td>

    </tr>

    <?php 

    

    $subtotal += $crt["subtotal"];

    //$sfee += $scharge;

    //$grtotal = $subtotal+$sfee;

    $grtotal = $subtotal;

  } }else{ ?>

   <tr>

     <th colspan="6" class="text-center" style="color:grey">

       <h5>No item in your cart...</h5>

     </th>

   </tr>

 <?php } ?>

 

</tbody>

</table>

</div>

<!--=======  End of cart table  =======-->

</form>

<div class="row">

 <div class="col-lg-6 col-12">

  

  <!--=======  Discount Coupon  =======-->

  <div class="discount-coupon">

   <h4>Discount Coupon Code</h4>

   <form action="javascript:void(0)" onsubmit="check_coupon()">

    <div class="row">

     <div class="col-md-6 col-12 mb-25">

      <input type="text" placeholder="Coupon Code" autocomplete="off" id="coupon_code">

      <p id="discmessage"></p>

    </div>

    <div class="col-md-6 col-12 mb-25">

      <input type="submit" value="Apply Code">

    </div>

  </div>

</form>


</div>

<!--=======  End of Discount Coupon  =======-->

</div>

<div class="col-lg-6 col-12 d-flex"> 

  <!--=======  Cart summery  =======-->

  <div class="cart-summary">

   <div class="cart-summary-wrap">

    <h4>Cart Summary</h4>

    <input type="hidden" id="sv" value="<?=$subtotal?>">

    <p>Sub Total <span>$<?=$subtotal?>.00</span></p>

    <p>Discounted Total <span id="disamnt">$<?=$subtotal?>.00</span></p>

    <h2>Grand Total <span id="disamntgrtotal">$<?=$grtotal?>.00</span></h2>

  </div>

  <form action="<?=site_url('shop/pr_checkout'); ?>" method="POST">

  <div class="form-group text-left">

    <h4><label class="font-weight-normal"><input type="checkbox" <?php if(!userid2()){echo"required";} ?> name="check_guest" value="1"> Checkout as a Guest </label></h4>

  </div>

  <div class="cart-summary-button">

    <div class="row">

      <div class="col-12 text-left">
        <a href="<?=base_url('shop')?>" class="btn btn-primary btncontinue"><i class="fa fa-arrow-left"></i> Continue Shopping</a>
         <button onclick="clear_cart()" type="button" class="update-btn btn float-left btn-danger">Clear Cart</button>
          <input type="hidden" name="discountedsubtotal" value="" id="discpriceamnt">

    <button type="submit" class="checkout-btn btn" href="">Checkout</button>
      </div>

      

    </div>

   

     

  

   

  </div>

   

  </form>

</div>

<!--=======  End of Cart summery  =======-->

</div>

</div>

</div>

</div>

</div>

</div>

<script>

    function check_coupon(){

    var cp =  $('#coupon_code').val();

    var amt = $('#sv').val();

   

    $.ajax({

      url: '<?= base_url("shop/check_coupon_ajax") ?>',

      type: 'POST',

      dataType: 'html',

      data: {cpn: cp,amt:amt},

  })

    .done(function(total_price) {

       if(total_price==0){

        $('#discmessage').html('<p style="color:red">Invalid coupon code</p>');

    }else{

        $('#discpriceamnt').val(total_price);

        $('#disamnt').text('$'+total_price+'.00');

        $('#disamntgrtotal').text('$'+total_price+'.00');

        $('#discmessage').html('<p style="color:green;">Applied</p>');

    }

});

    

}

</script>