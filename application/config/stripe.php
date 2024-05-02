<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
/* 
| ------------------------------------------------------------------- 
|  Stripe API Configuration 
| ------------------------------------------------------------------- 
| 
| You will get the API keys from Developers panel of the Stripe account 
| Login to Stripe account (https://dashboard.stripe.com/) 
| and navigate to the Developers >> API keys page 
| 
|  stripe_api_key            string   Your Stripe API Secret key. 
|  stripe_publishable_key    string   Your Stripe API Publishable key. 
|  stripe_currency           string   Currency code. 
*/ 


/*-------------------STRIPE-----------------*/
$config['stripe_key'] = 'pk_test_51H7bbSE2RcKvfXD4D';
$config['stripe_secret'] = 'sk_test_51H7bbSE2RcKvfX';
$config['stripe_currency']        = 'usd';

?>