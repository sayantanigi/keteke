<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends AI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		
	}
	public function seller_accountsettings() {
		$this->data['title'] = 'Keteke | Marketplace';
		$this->data['load'] = 'marketplace/seller_acc_settings'; 
		$userrol=userrole();
		if($userrol!=3)
		{
			$this->session->set_flashdata('error','Login or Sign up to list your business');
			redirect(site_url('login'));
		}else
		{  
			$user = userid2();
			$this->data['udetail'] = $this->Master_model->getSingleRow('user_id',$user,'user_accounts');
		}
		$this->form_validation->set_rules('user_fname', 'First Name', 'required');
		$this->form_validation->set_rules('user_lname', 'Last Name', 'required');

		if ($this->form_validation->run() == TRUE) {
			$new_pass=base64_encode($this->input->post('new_pass'));
			$confirm_pass=base64_encode($this->input->post('con_pass'));
			$ufname=$this->input->post('user_fname');
			$ulname=$this->input->post('user_lname');
			if($this->input->post('user_fname')){
				$this->db->where('user_id',$user)->update('user_accounts',array('user_fname'=>$ufname,'user_lname'=>$ulname));
				$this->session->set_flashdata("success", "Profile updated Successfully");
			}
			if ($new_pass==$confirm_pass) {
				$this->db->where('user_id',$user)->update('user_accounts',array('user_pasword'=>$confirm_pass));
				$this->session->set_flashdata("success", "Password Changed Successfully");
				redirect(site_url('account-settings'));
			}else{
				$this->session->set_flashdata('error', 'New password confirm password does not matched');
				redirect(site_url('account-settings'));
			}
		}
		$this->load->front_view('marketplace/mdefault', $this->data);
	}
	public function view_order($ProductId=false)
	{
		$ProductId=base64_decode($ProductId);
		$this->data['title'] = 'Keteke | Marketplace';
		$this->data['load'] = 'marketplace/seller_ind_orders';
		$this->data['slord']=$slord=$this->Master_model->getSellerOrderDetails($ProductId);
		$this->data['userdetl']=$this->Master_model->getSingleRow('user_id',$slord->userid,'user_accounts');
		$this->data['shadr']=$this->Master_model->getSingleRow('order_id',$slord->orderid,'customer_shipping_addrs');

		$this->data['primgs']=$this->Master_model->getSingleRow('productId',$ProductId,'product_images');

		$this->data['bladr']=$this->Master_model->getSingleRow('order_id',$slord->orderid,'customer_billing_addrs');
		$this->load->front_view('marketplace/mdefault', $this->data);

	}
	public function view_customers($ProductId=false)
	{
		$userrol=userrole();
		if($userrol!=3)
		{
			$this->session->set_flashdata('error','Login or Sign up to list your business');
			redirect(site_url('login')); 
		}else
		{  
			$user = userid2();
			$this->data['udetail'] = $this->Master_model->getSingleRow('user_id',$user,'user_accounts');
		}
		$this->data['title'] = 'Keteke | Marketplace';
		$this->data['load'] = 'marketplace/seller_view_customers';
		$this->data['slcustomers']=$this->Master_model->getSellerCustomerDetails($user);


		$this->load->front_view('marketplace/mdefault', $this->data);

	}
	public function customer_add()
	{
		$userrol=userrole();
		if($userrol!=3)
		{
			$this->session->set_flashdata('error','Login or Sign up to list your business');
			redirect(site_url('login')); 
		}else
		{  
			$user = userid2();
			$this->data['udetail'] = $this->Master_model->getSingleRow('user_id',$user,'user_accounts');
		}
		$this->data['title'] = 'Keteke | Marketplace';
		$this->data['load'] = 'marketplace/seller_add_customer';
		$this->form_validation->set_rules('frm[user_fname]', 'First Name', 'required');
		$this->form_validation->set_rules('frm[user_lname]', 'Last Name', 'required');
		$this->form_validation->set_rules('frm[user_emailid]', 'Email', 'required|is_unique[user_accounts.user_emailid]');
		$this->form_validation->set_rules('frm[user_pasword]', 'Password', 'required');
		if ($this->form_validation->run()) {

			$formdata = $this->input->post('frm');
			$formdata['user_id'] = $id;
			$formdata['u_type'] = '4';
			$formdata['user_pasword'] = base64_encode($formdata['user_pasword']);
			$formdata['user_status'] =1;
			$formdata['created_by']= $user;
			$formdata['created_at']=date('Y-m-d h:i:s');
			$this->Master_model->save($formdata,'user_accounts');

			$this->session->set_flashdata("success", "Customer created successfully");
			redirect(site_url('shop/view_customers'));

		}
		$this->load->front_view('marketplace/mdefault', $this->data);
	}
	public function customeredit($id=false)
	{
		$userrol=userrole();
		if($userrol!=3)
		{
			$this->session->set_flashdata('error','Login or Sign up to list your business');
			redirect(site_url('login')); 
		}else
		{  
			$user = userid2();
			$this->data['udetail'] = $this->Master_model->getSingleRow('user_id',$user,'user_accounts');
		}
		$this->data['title'] = 'Keteke | Marketplace';
		$this->data['load'] = 'marketplace/seller_edit_customer';
		$this->data['customer'] = $this->Master_model->getNew('user_accounts');
		if ($id) {
			$this->data['customer'] = $pages = $this->Master_model->getSingleRow('user_id',$id,'user_accounts');
			if(!isset($pages)){
				redirect(site_url('404_override'));
				exit();
			}
		}

		$this->form_validation->set_rules('frm[user_fname]', 'First Name', 'required');
		$this->form_validation->set_rules('frm[user_lname]', 'Last Name', 'required');
		$this->form_validation->set_rules('frm[user_pasword]', 'Password', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');

			$formdata['user_id'] = $id;
			$formdata['u_type'] = '4';
			$formdata['user_pasword'] = base64_encode($formdata['user_pasword']);
			$formdata['user_status'] =1;
			$formdata['created_by']= $user;
			$formdata['created_at']=date('Y-m-d h:i:s');
			$this->db->update('user_accounts',$formdata,array('user_id'=>$id));

			$this->session->set_flashdata("success", "Customer details updated");
			redirect(site_url('edit-customer/' . $id));

		}
		$this->load->front_view('marketplace/mdefault', $this->data);
	}

	function customerdelete($id){
		if ($id > 0) {
			$this->db->delete('user_accounts',array('user_id'=>$id));
			$this->session->set_flashdata('success', 'Customer deleted successfully');
		}
		redirect(site_url('seller-customers'));
	}

	public function abandoned_Userproduct($prid=false) {
		$userrol=userrole();
		if($userrol!=3)
		{
			$this->session->set_flashdata('error','Login or Sign up to list your business');
			redirect(site_url('login'));
		}else
		{  
			$user = userid2();
			$this->data['udetail'] = $this->Master_model->getSingleRow('user_id',$user,'user_accounts');
		}
		$this->data['title'] = 'Keteke | Marketplace';
		$this->data['load'] = 'marketplace/seller_abadoned_checkout';
		$this->data['chkroducts'] = $this->Product_model->abadonedProducts($user);
		$this->load->front_view('marketplace/mdefault', $this->data);
	}
	public function view_abandonorders($ProductId=false)
	{
		$ProductId=base64_decode($ProductId);
		$userrol=userrole();
		if($userrol!=3)
		{
			$this->session->set_flashdata('error','Login or Sign up to list your business');
			redirect(site_url('login')); 
		}else
		{  
			$user = userid2();
			$this->data['udetail'] = $this->Master_model->getSingleRow('user_id',$user,'user_accounts');
		}
		$this->data['title'] = 'Keteke | Marketplace';
		$this->data['load'] = 'marketplace/seller_abandoned_orders';
		$this->data['slord']=$slord=$this->Product_model->getabandonedOrderDetails($ProductId);
		$this->data['userdetl']=$this->Master_model->getSingleRow('user_id',$slord->userid,'user_accounts');
		$this->data['shadr']=$this->Master_model->getSingleRow('order_id',$slord->orderid,'customer_shipping_addrs');

		$this->data['primgs']=$this->Master_model->getSingleRow('productId',$ProductId,'product_images');

		$this->data['bladr']=$this->Master_model->getSingleRow('order_id',$slord->orderid,'customer_billing_addrs');
		$this->load->front_view('marketplace/mdefault', $this->data);

	}
	public function draftorders() {
		$this->data['title'] = 'Keteke | Marketplace';
		$this->data['load'] = 'marketplace/draft_orders_list';
		$userrol=userrole();
		if($userrol!=3)
		{
			$this->session->set_flashdata('error','Login or Sign up to list your business');
			redirect(site_url('login')); 
		}else
		{  
			$user = userid2();
			$this->data['udetail'] = $this->Master_model->getSingleRow('user_id',$user,'user_accounts');
		}
		$this->data['sellerdrftorders']=$this->Product_model->getAlldraftOrders($user);

		$this->load->front_view('marketplace/mdefault', $this->data);
	}
	public function create_draftorder()
	{
		$userrol=userrole();
		if($userrol!=3)
		{
			$this->session->set_flashdata('error','Login or Sign up to list your business');
			redirect(site_url('login')); 
		}else
		{  
			$user = userid2();
			$this->data['udetail'] = $this->Master_model->getSingleRow('user_id',$user,'user_accounts');
		}
		$this->data['title'] = 'Keteke | Marketplace';
		$this->data['load'] = 'marketplace/seller_creaftdraftorder';
		$this->data['customers'] = $this->Product_model->getAll_customers($user);
		$this->data['products'] = $this->Product_model->getAllProducts($user);


		$this->form_validation->set_rules('frm[userid]', 'Customer Name', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			///draft order payment creation//////////////
			$draftpayarray=array(
				'pay_user_id'=>$formdata['userid'],
				'paid_amount'=>$formdata['price'],
				'payment_status'=>'Not paid',
				'payment_created_by'=>$user,
				'payment_created_date'=>date('Y-m-d h:i:s')
			);
			$this->Master_model->save($draftpayarray,'draftorders_payment');
			$Payorderid=$this->db->insert_id();

			///order creation////
			$prdid=$this->input->post('product_id');
			for($i=0;$i<count($prdid);$i++){
				$productDetails=$this->Master_model->getSingleRow('productId',$prdid[$i],'products');
				$insdrft=array('userid'=>$formdata['userid'],
					'draftpayment_orderid'=>$Payorderid,
					'product_id'=>$prdid[$i],
					'qty'=>$formdata['qty'],
					'price'=>$productDetails->offprice,
					'shipping_charge'=>$productDetails->shipping_charge,
					'created_by'=>$user,
					'created_at'=>date('Y-m-d h:i:s'),
					'payment_status'=>'0');
				$this->Master_model->save($insdrft,'draft_orders');
			}
			
			$this->session->set_flashdata("success", "Draft Order created successfully");
			redirect(site_url('draft-orders'));

		}
		$this->load->front_view('marketplace/mdefault', $this->data);
	}

	public function dreftOrderMailsend($orderId=false){
		$ordID=base64_decode($orderId);
		$draftordr=$this->Master_model->getSingleRow('id',$ordID,'draftorders_payment');
		$userdetl=$this->Master_model->getSingleRow('user_id',$draftordr->pay_user_id,'user_accounts');
		$userId=$userdetl->user_id;
		$price=$draftordr->paid_amount;
		$drraftlink = "".base_url()."seller/draft_checkoutorders?UID=$userId&price=$price&OrdId=$orderId";
		
		//echo $drraftlink;die;
		$subject = "Draft Order Invoice From Keteke";
		$htmlContent = "
		<body style='background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;'>
		<table style='max-width:600px;margin:20px auto 10px;background-color:#fff;padding:20px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #000000;'>
		<thead>
		<tr>
		<th style='text-align:left;'><img style='max-width: 150px;' src='".site_url('fassets/images/logos/headertransparentlogo.png')."' alt='Keteke'></th>
		<th style='text-align:right;font-weight:400;'>".date('d M Y')."</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td colspan='2' style='height:2px;background:#232323'></td>
		</tr>
		<tr>
		<td colspan='2' style='padding:20px 0'><h3 style='margin;0;color:green'>Hi ".$userdetl->user_fname.",</h3>
		<p>Great being able to work with you</p>
		<p>Go ahead and complete your purchase at this link: <a href='".$drraftlink."'>https://keteke.net/seller/draft_checkoutorders</a> </p>
		</td>
		</tr>

		<tr>
		<td style='width:50%;padding:0;vertical-align:top'>
		<br>
		Best Regards,<br>
		Keteke <br><br>
		This is an automated response, please DO NOT reply.
		</td>
		</tr>
		<tr>
		<td style='height:15px;'></td>
		</tr>

		</tbody>
		</table>
		</body>
		";
        //print_r($htmlContent);die;
		$email=$userdetl->user_emailid;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
		$headers .= 'From: KETEKE Draft Orders' . "\r\n";

		if(mail($email,$subject,$htmlContent,$headers)){
			$emailarr=array('email_sent'=>1,
				'email_date'=>date('Y-m-d H:i:s'));
			$this->db->update('draftorders_payment',$emailarr,array('id'=>$ordID));
			$this->session->set_flashdata("success", "Draft Orders Mail has been sent successfully.");
			redirect(site_url('draft-orders'));
		}
	}
	public function view_draftorder($orderId=false)
	{
		$ordId=base64_decode($orderId);
		$this->data['title'] = 'Keteke | Marketplace';
		$this->data['load'] = 'marketplace/seller_ind_draftorders';
		$this->data['sldrftord']= $slord=$this->Product_model->getSellerdraftOrderDetails($ordId);
		$this->data['draftdetl']=$this->Master_model->getSingleRow('id',$ordId,'draftorders_payment');
		//echo $this->db->last_query();die;
		$this->data['userdetl']=$this->Master_model->getSingleRow('user_id',$slord->userid,'user_accounts');
		
		$this->load->front_view('marketplace/mdefault', $this->data);

	}
	public function productPriceAjax()
	{
		$productId=$this->input->post('productId');
		if(count($productId)>0){
			$sfee=0;
			$subtotal=0;
			$grtotal=0;
			foreach ($productId as $crt) {
				$productDetails=$this->Master_model->getSingleRow('productId',$crt,'products');
				$subtotal += $productDetails->offprice;
				if($productDetails->shipping_charge !=NULL){
					$scharge=$productDetails->shipping_charge;
					$sfee += @$scharge;
				}else{
					$sfee += 0;
				}
				$grtotal = $subtotal+$sfee; 
			} }

			echo $grtotal;

		}
		public function draft_checkoutorders()
		{ 
			$this->data['title'] = 'Keteke | Marketplace';
			$this->data['load'] = 'marketplace/draftorder_checkout';
			$user = $_GET['UID'];
			$OrdId = base64_decode($_GET['OrdId']);
			$price = $_GET['price'];
			$maildetls=$this->Master_model->getSingleRow('id',$OrdId,'draftorders_payment');
			// $cr_time=date("Y-m-d H:i:s");
   //          $dayc = (strtotime($cr_time)-strtotime($maildetls->email_date)) / (60 * 60 * 12);
   //          $days= round($dayc);
   //          if($days > 7){
   //          	echo"<script>alert('link expired')</script>";
   //          	echo '<script type="text/JavaScript"> </script>';
   //          }

			$this->data['udetail'] = $this->Master_model->getSingleRow('user_id',$user,'user_accounts');

			$this->data['DraftorderId']=$OrdId;
			$this->data['draftItems'] = $this->Product_model->getAllResult('draft_orders','draftpayment_orderid',$OrdId);

			$this->load->front_view('marketplace/mdefault', $this->data);
		}

		public function placeOrders(){

			$paidprice = $this->input->post('total_paid_price');
			$drordId=$this->input->post('draftorderId');
			$payerid=$this->input->post('draftuserId');

			if($this->input->post('billing_phone') !=''){
				$billaddr=1;
				$bfname=$this->input->post('billingfname');
				$blname=$this->input->post('billinglname');
				$bemail=$this->input->post('billing_email');
				$bphone=$this->input->post('billing_phone');
				$baddr=$this->input->post('billing_address');
				$bcity=$this->input->post('billing_city');
				$bstate=$this->input->post('billing_state');
				$bcountry=$this->input->post('billing_country');
				$bzip=$this->input->post('billing_zip');
				$baddrd=array(
					'order_id'=>$drordId,
					'user_id'=>$payerid,
					'billing_fname'=>$bfname,
					'billing_lname'=>$blname,
					'billing_email'=>$bemail,
					'billing_phone'=>$bphone,
					'billing_address'=>$baddr,
					'billing_city'=>$bcity,
					'billing_state'=>$bstate,
					'billing_country'=>$bcountry,
					'billing_zip'=>$bzip,
					'created'=>date('Y-m-d H:i:s')
				);
				$this->db->insert('customer_billing_addrs',$baddrd);
			}
			if($this->input->post('shipaddress')==1){
				$shippaddr=1;
				$sfname=$this->input->post('shipping_fname');
				$slname=$this->input->post('shipping_lname');
				$semail=$this->input->post('shipping_email');
				$sphone=$this->input->post('shipping_phone');
				$saddr=$this->input->post('shipping_address');
				$scity=$this->input->post('shipping_city');
				$sstate=$this->input->post('shipping_state');
				$scountry=$this->input->post('shipping_country'); 
				$szip=$this->input->post('shipping_zip');
				$saddrd=array(
					'order_id'=>$drordId,
					'user_id'=>$payerid,
					'shipping_fname'=>$sfname,
					'shipping_lname'=>$slname,
					'shipping_email'=>$semail,
					'shipping_phone'=>$sphone,
					'shipping_address'=>$saddr,
					'shipping_city'=>$scity,
					'shipping_state'=>$sstate,
					'shipping_country'=>$scountry,
					'shipping_zip'=>$szip,
					'created'=>date('Y-m-d H:i:s')
				);
				$this->db->insert('customer_shipping_addrs',$saddrd);
			}
			$draftorderdetails=array(
				'bemail'=>$bemail,
				'userid'=>$payerid,
				'orderid'=>$drordId,
				'gross_amount'=>$paidprice);
			$this->draftstripePayment($draftorderdetails);

		}

		public function draftstripePayment($orderdetails) {
			$this->data['title'] = 'Keteke | Stripe Payment';
			$this->data['load'] = 'marketplace/draft_stripe_payment';
			$this->data['billingemail'] = $orderdetails['bemail'];
			$this->data['priceTotal'] = $orderdetails['gross_amount'];
			$this->data['userid'] = $orderdetails['userid'];
			$this->data['orderId'] = $orderdetails['orderid'];
			$this->load->front_view('marketplace/mdefault', $this->data);
		}

	}

	/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */