<?php

// Include Stripe PHP library 
require APPPATH .'third_party/stripe-php/init.php'; 

use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\ApiOperations\Create;
use \Stripe\Charge;

class Stripe_lib
{

    public function __construct()
    {
        $this->apiKey = STRIPE_PUBLISHABLE_KEY;
        $this->stripeService = new \Stripe\Stripe();
        $this->stripeService->setVerifySslCerts(false);
        $this->stripeService->setApiKey(STRIPE_API_KEY);
    }
    public function addCustomer($email, $token){ 
        try { 
            // Add customer to stripe 
            $customer = \Stripe\Customer::create(array( 
                'email' => $email, 
                'source'  => $token 
            )); 
            return $customer; 
        }catch(Exception $e) { 
            $this->api_error = $e->getMessage(); 
            return false; 
        } 
    } 


    function createCharge($customerId, $itemName, $itemPrice, $orderID){ 
        // Convert price to cents 
        $itemPriceCents = ($itemPrice*100); 
        $currency = 'USD'; 
         
        try { 
            // Charge a credit or a debit card 
            $charge = \Stripe\Charge::create(array( 
                'customer' => $customerId, 
                'amount'   => $itemPriceCents, 
                'currency' => $currency, 
                'description' => $itemName, 
                'metadata' => array( 
                'order_id' => $orderID 
                ) 
            )); 
             
            // Retrieve charge details 
            $chargeJson = $charge->jsonSerialize(); 
            return $chargeJson; 
        }catch(Exception $e) { 
            $this->api_error = $e->getMessage(); 
            return false; 
        } 
    } 

}
