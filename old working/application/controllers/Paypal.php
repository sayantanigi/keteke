<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paypal extends AI_Controller{

   function  __construct(){
    parent::__construct();
    $this->load->library('session'); 
    $this->load->library('paypal_lib'); 
      
}

function success(){
    
    if(isprologin()){
            $userid = userid2();
            $this->data['udetail'] = $user = $this->db->get_where('users',array('id'=>$userid))->row();
            
        }

    $paypalInfo= $this->input->post();
         //echo "<pre>";die;
         
         //print_r($paypalInfo);die;

    if(@$paypalInfo["payment_status"]=='Completed'){

        $id=$paypalInfo['custom'];
        $txn_id=$paypalInfo['txn_id'];
        $amount=$paypalInfo['payment_gross'];
        $status=$paypalInfo['payment_status'];
        $orderId = $paypalInfo['item_name1'];
        $created_at=$paypalInfo['payment_date'];


        $arr = array(
            'user_id'=>$id,
            'txn_id'=>$txn_id,
            'order_id'=>$orderId,
            'payment_gross'=>$amount,
            'payment_status'=>$status,
        );

        $this->db->insert('payments',$arr);

        $arr1 = array(
            'pr_status'=>1
        );
        $this->db->where('id',$orderId);
        $this->db->update('listing',$arr1);
        $_SESSION['userids'] = $id;
        $this->session->set_flashdata('success', 'Preferred Listing Submitted Successfully.');
    }

    if(@$paypalInfo["payment_status"]=='Pending'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update payments set payment_status='0' where id=$id");
        $this->artwork_shipping($id);

        $this->session->set_flashdata('error', 'Payment is Pending');


    }

    if(@$paypalInfo["payment_status"]=='Denied'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update payments set payment_status='2' where id=$id");

        $this->session->set_flashdata('error', 'Payment has denied');

    }

    if(@$paypalInfo["payment_status"]=='Failed'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update payments set payment_status='3' where id=$id");

        $this->session->set_flashdata('error', 'Payment has been Failed');

    }

    if(@$paypalInfo["payment_status"]=='Refused'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update payments set payment_status='4' where id=$id");
        $this->session->set_flashdata('error', 'Payment has been Refused');

    }

    $this->data['status']=@$paypalInfo['payment_status'];
    $this->data['load'] = 'listing_create';
    $this->load->front_view('default', $this->data);

}

function ipn(){
        // Paypal posts the transaction data
    $paypalInfo = $this->input->post();

    if(!empty($paypalInfo)){
            // Validate and get the ipn response
        $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

            // Check whether the transaction is valid
        if($ipnCheck){
                // Insert the transaction data in the database
            $data['user_id']        = $paypalInfo["custom"];
            //$data['product_id']        = $paypalInfo["item_number"];
            $data['txn_id']            = $paypalInfo["txn_id"];
            $data['payment_gross']    = $paypalInfo["mc_gross"];
            $data['currency_code']    = $paypalInfo["mc_currency"];
            $data['payer_email']    = $paypalInfo["payer_email"];
            $data['payment_status'] = $paypalInfo["payment_status"];

            $this->product->insertTransaction($data);
        }
    }
}
function regsuccess(){
    
   

    $paypalInfo= $this->input->post();
         //echo "<pre>";die;
         //print_r($_GET);
         //print_r($_POST);die;

    if(@$paypalInfo["payment_status"]=='Completed'){

        //$id=$paypalInfo['custom'];
        $txn_id=$paypalInfo['txn_id'];
        $amount=$paypalInfo['payment_gross'];
        $status=$paypalInfo['payment_status'];
        $orderId = $paypalInfo['custom'];
        $created_at=$paypalInfo['payment_date'];


        $arrr = array(
            
            'txn_id'=>$txn_id,
            'order_id'=>$orderId,
            'payment_gross'=>$amount,
            'payment_status'=>$status,
        );

        $this->db->insert('reg_fee_payments',$arrr);

        $arrr1 = array(
            'payment_status'=>1,
            'status'=>1
        );
        $this->db->where('id',$orderId);
        $this->db->update('users',$arrr1);
        $this->session->set_flashdata('success', 'Payment is Successfully done!Account Created... Please Signin.');
        redirect(site_url('login'));
    }

    if(@$paypalInfo["payment_status"]=='Pending'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update reg_fee_payments set payment_status='0' where id=$id");

        $this->session->set_flashdata('error', 'Payment is Pending');
         redirect(site_url('login'));


    }

    if(@$paypalInfo["payment_status"]=='Denied'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update reg_fee_payments set payment_status='2' where id=$id");

        $this->session->set_flashdata('error', 'Payment has denied');
         redirect(site_url('login'));

    }

    if(@$paypalInfo["payment_status"]=='Failed'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update reg_fee_payments set payment_status='3' where id=$id");

        $this->session->set_flashdata('error', 'Payment has been Failed');
         redirect(site_url('login'));

    }

    if(@$paypalInfo["payment_status"]=='Refused'){
        $id=$paypalInfo['custom'];
            //$txn_id=$paypalInfo['txn_id'];
        $this->db->query("update reg_fee_payments set payment_status='4' where id=$id");
        $this->session->set_flashdata('error', 'Payment has been Refused');

    }

    $this->data['status']=@$paypalInfo['payment_status'];
    redirect(site_url('login'));

}
}