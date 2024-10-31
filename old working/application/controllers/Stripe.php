<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stripe extends AI_Controller{

   function  __construct(){
    parent::__construct();
    $this->load->library('session');
    $this->load->library('Stripe_lib');
    $this->load->model('Master_model'); 
    $this->load->library('cart');
      
}

 public function stripe_payment() {
        // If payment form is submitted with token 
        if($this->input->post('stripeToken')){ 
            // Retrieve stripe token, card and user info from the submitted form data 
            $postData = $this->input->post(); 
            
            // Make payment 
            $paymentID = $this->payment($postData); 
             
            // If payment successful 
            if($paymentID){ 
            $orderId=$this->db->get_where('payments',array('id'=>$paymentID))->row();
            $products=$this->db->get_where('productorders',array('orderid'=>$orderId->order_id))->result();
            foreach ($products as $prds) {
               $this->db->update('productorders',array('payment_status'=>1,'order_status'=>'processing'),array('id'=>$prds->id));
            }
                redirect(site_url('stripe/payment_status/'.base64_encode($paymentID))); 
            }else{ 
                $apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':''; 
               $this->data['error_msg'] = 'Transaction has been failed!'.$apiError; 
            } 
        } 
         
       
    }
     function payment($postData){ 
         
        // If post data is not empty 
        if(!empty($postData)){ 
            // Retrieve stripe token, card and user info from the submitted form data 
            $token  = $postData['stripeToken']; 
            $userid = $postData['userid'];
            if($userid=="guest"){
              $email= $postData['billemail']; 
            }
            else{
              $usdl=$this->db->get_where('user_accounts',array('user_id'=>$userid))->row();
               $email = @$usdl->user_emailid;   
            }
            
            $chname = $postData['cardholdername']; 
            $card_number = $postData['card_number']; 
            $card_number = preg_replace('/\s+/', '', $card_number); 
            $card_exp_month = $postData['card_exp_month']; 
            $card_exp_year = $postData['card_exp_year']; 
            $card_cvc = $postData['card_cvc']; 
            $prorder_id = $postData['order_id'];
            $paidPrice = $postData['paidPrice'];
             
            // Unique order ID 
            $orderID = strtoupper(str_replace('.','',uniqid('', true))); 
             
            // Add customer to stripe 
            $customer = $this->stripe_lib->addCustomer($email, $token); 
             
            if($customer){ 
                // Charge a credit or a debit card 
                $charge = $this->stripe_lib->createCharge($customer->id,$prorder_id,$paidPrice, $orderID); 

                 
                if($charge){ 
                    // Check whether the charge is successful 
                    if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){ 
                        // Transaction details 
                        $transactionID = $charge['balance_transaction']; 
                        $paidAmount = $charge['amount']; 
                        $paidAmount = ($paidAmount/100); 
                        $paidCurrency = $charge['currency']; 
                        $payment_status = $charge['status']; 
                         
                         
                        // Insert tansaction data into the database 
                        $orderData = array( 
                            'user_id'=> $userid,
                            'txn_id' => $transactionID,
                            'order_id'=> $prorder_id,
                            'cardholder_name'=> $chname,
                            'payment_gross' => $paidAmount,
                            'payment_status' => $payment_status 
                        ); 
                        $orderID = $this->db->insert('payments',$orderData); 
                        //echo $this->db->last_query();die;
                         
                        // If the order is successful 
                        if($payment_status == 'succeeded'){
                            $this->cart->destroy();
                            return $orderID; 
                        } 
                    } 
                } 
            } 
        } 
        return false; 
    }

    function payment_status($orderid=false)
    { 
        $this->data['title'] = 'Keteke | Marketplace | Payment Status';
        $ordid=base64_decode($orderid);
        $this->data['orders']= $order=$this->db->get_where('payments',array('id'=>$ordid))->row();
        $this->data['products']=$this->db->get_where('productorders',array('orderid'=>$order->order_id))->result();
        
        $this->data['load'] = 'marketplace/pr_payment_status';
        $this->load->front_view('marketplace/mdefault', $this->data);
    } 

public function draftstripe_payment() {
        // If payment form is submitted with token 
        if($this->input->post('stripeToken')){ 
            // Retrieve stripe token, card and user info from the submitted form data 
            $postData = $this->input->post(); 
            
            // Make payment 
            $paymentID = $this->draftpayment($postData); 
             
            // If payment successful 
            if($paymentID){ 
            $orderId=$this->db->get_where('payments',array('id'=>$paymentID))->row();
            $products=$this->db->get_where('draft_orders',array('draftpayment_orderid'=>$orderId->id))->result();
            foreach ($products as $prds) {
               $this->db->update('draft_orders',array('payment_status'=>1,'order_status'=>'processing'),array('id'=>$prds->id));
            }
                redirect(site_url('stripe/draftpayment_status/'.base64_encode($paymentID))); 
            }else{ 
                $apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':''; 
               $this->data['error_msg'] = 'Transaction has been failed!'.$apiError; 
            } 
        } 
         
       
    }
     function draftpayment($postData){ 
        // If post data is not empty 
        if(!empty($postData)){ 
            // Retrieve stripe token, card and user info from the submitted form data 
            $token  = $postData['stripeToken']; 
            $userid = $postData['userid'];
            $email= $postData['billemail'];

            $chname = $postData['cardholdername']; 
            $card_number = $postData['card_number']; 
            $card_number = preg_replace('/\s+/', '', $card_number); 
            $card_exp_month = $postData['card_exp_month']; 
            $card_exp_year = $postData['card_exp_year']; 
            $card_cvc = $postData['card_cvc']; 
            $prorder_id = $postData['order_id'];
            $paidPrice = $postData['paidPrice'];
             
            // Unique order ID 
            $orderID = strtoupper(str_replace('.','',uniqid('', true))); 
             
            // Add customer to stripe 
            $customer = $this->stripe_lib->addCustomer($email, $token); 
             
            if($customer){ 
                // Charge a credit or a debit card 
                $charge = $this->stripe_lib->createCharge($customer->id,$prorder_id,$paidPrice, $orderID); 

                 
                if($charge){ 
                    // Check whether the charge is successful 
                    if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){ 
                        // Transaction details 
                        $transactionID = $charge['balance_transaction']; 
                        $paidAmount = $charge['amount']; 
                        $paidAmount = ($paidAmount/100); 
                        $paidCurrency = $charge['currency']; 
                        $payment_status = $charge['status']; 
                         
                         
                        // Insert tansaction data into the database 
                        $orderData = array(
                            'txn_id' => $transactionID,
                            'cardholder_name'=> $chname,
                            'payment_gross' => $paidAmount,
                            'payment_status' => $payment_status,
                            'tran_date'=>date('Y-m-d H:i:s')
                        ); 
                        $orderID = $this->db->update('draftorders_payment',$orderData,array('id'=>$prorder_id)); 
                        
                         
                        // If the order is successful 
                        if($payment_status == 'succeeded'){
                            $this->cart->destroy();
                            return $orderID; 
                        } 
                    } 
                } 
            } 
        } 
        return false; 
    }

    function draftpayment_status($orderid=false)
    { 
        $this->data['title'] = 'Keteke | Marketplace | Payment Status';
        $ordid=base64_decode($orderid);
        $this->data['orders']= $order=$this->Master_model->getSingleRow('id',$ordid,'draftorders_payment');
        
        $this->data['draftproducts']=$this->Product_model->getAllResult('draft_orders','draftpayment_orderid',$order->id);
       
        $this->data['load'] = 'marketplace/draft_payment_status';
        $this->load->front_view('marketplace/mdefault', $this->data);
    } 
   
}