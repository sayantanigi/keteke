<div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <!--=======  breadcrumb content  =======-->

        <div class="breadcrumb-content">
         <h2>Pay <?php echo '$'.$priceTotal; ?> with Stripe</h2>
         <ul>
            <li class="has-child"><a href="<?=site_url('shop/pr_cart')?>">Payment</a></li>
            <li>Stripe</li>
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
         <div class="col-lg-6 offset-lg-3">
            <!-- Checkout Form s-->
            <form id="frmStripePayment" action="<?=site_url('stripe/stripe_payment')?>" method="post" class="checkout-form form-validation">
               <div class="row row-40">
                  <div class="col-12 mb-20">
                    <div class="card-errors"></div>
                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                           <label class='control-label'>Name on Card</label>
                           <input class='form-control'  name="cardholdername" size='4' type='text'>
                           <input type="hidden" name="paidPrice" id="paidPrice" value="<?=$priceTotal?>">
                            <input type="hidden" name="userid"  value="<?=$userid?>">
                             <input type="hidden" name="order_id" id="paidPrice" value="<?=$orderId?>">
                              <input type="hidden" name="billemail" value="<?=$billingemail?>">
                        </div>
                     </div>
                     
                     <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                           <label class='control-label'>Card Number</label>
                           <input autocomplete='off' id='card_number' name="card_number" class='form-control' size='20' placeholder='1234 1234 1234 1234' type='text'>
                        </div>
                     </div>

                     <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                           <label class='control-label'>CVC</label>
                           <input autocomplete='off' class='form-control' name='card_cvc' id='card_cvc' placeholder='ex. 311'
                              size='4' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                           <label class='control-label'>Expiration Month</label>
                           <input class='form-control' name='card_exp_month' id='card_exp_month' placeholder='MM' size='2' type='text'>
                        </div>
                          <div id="date-error" class="error invalid-feedback"></div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                           <label class='control-label'>Expiration Year</label>
                           <input class='form-control' name='card_exp_year' id='card_exp_year' placeholder='YYYY' size='4' type='text'>
                        </div>
                     </div> 
                     <div class="text-center">
                      <button class="place-order" id="payBtn" onClick="stripePay(event);" type="submit" style="float: none;">Pay</button>
                    </div>
                  </div>
     
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script src="https://js.stripe.com/v2/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script>
// Set your publishable key
Stripe.setPublishableKey('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

// Callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        // Enable the submit button
        $('#payBtn').removeAttr("disabled");
        // Display the errors on the form
        $(".card-errors").html('<p>'+response.error.message+'</p>');
    } else {
        var form$ = $("#frmStripePayment");
        // Get token id
        var token = response.id;
        // Insert the token into the form
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
        // Submit form to the server
        form$.get(0).submit();
    }
}

$(document).ready(function() {
    // On form submit
    $("#frmStripePayment").submit(function() {
        // Disable the submit button to prevent repeated clicks
        $('#payBtn').attr("disabled", "disabled");
    
        // Create single-use token to charge the user
        Stripe.createToken({
            number: $('#card_number').val(),
            exp_month: $('#card_exp_month').val(),
            exp_year: $('#card_exp_year').val(),
            cvc: $('#card_cvc').val()
        }, stripeResponseHandler);
    
        // Submit from callback
        return false;
    });
});
</script>