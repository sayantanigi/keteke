<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller
{
	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model('Apimodel');
		 $this->load->library('cart');
	}

	public function signup_post() 
	{
		
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['user_fname'] = $this->post('user_fname');
			$userData['user_lname'] = $this->post('user_lname');
			$userData['user_emailid'] = $this->post('user_emailid');
			$userData['user_password'] = $this->post('user_password');
			
			$userData['u_type'] = $this->post('u_type');
		}

		$this->form_validation->set_rules('user_fname', 'user_fname', 'trim|required');
		$this->form_validation->set_rules('user_lname', 'user_lname', 'trim|required');
		$this->form_validation->set_rules('user_emailid', 'user_emailid', 'trim|required|is_unique[user_accounts.user_emailid]');
		$this->form_validation->set_rules('user_password', 'user_password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('u_type', 'u_type', 'trim|required');
		$this->form_validation->set_message('min_length', '%s: the minimum of characters is %s');

		$this->form_validation->set_message('is_unique', 'The %s is already taken');
		
		if ($this->form_validation->run() === false) 
		{	
			if(form_error('user_fname')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('user_fname'))
				], 400);
			}		
			if(form_error('user_lname')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('user_lname'))
				], 400);
			}
			if(form_error('user_emailid')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('user_emailid'))
				], 400);
			}
			if(form_error('user_password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('user_password'))
				], 400);
			}
			
			if(form_error('u_type')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('u_type'))
				], 400);
			}
			

		} else {

			$mydata=array(
				'user_fname'=>$userData['user_fname'],
				'user_lname'=>$userData['user_lname'],
				'user_emailid'=>$userData['user_emailid'],
				'user_pasword'=>base64_encode($userData['user_password']),
				'u_type'=>$userData['u_type'],
				'user_status'=> 1,
				'created_at'=>date('Y-m-d H:i:s'),				
			);	
			$result=$this->Apimodel->add_details("user_accounts", $mydata);			

			if($result)
			{			

				$fetchdetails=$this->Apimodel->get_cond('user_accounts', "user_id ='$result'");
			
				$array = [
					'status' => "1",
					'message'=>'You have registered successfully!',
					'user_id' => $fetchdetails->user_id,
				];

				$array = $this->arrcheck($array);
				$this->response($array, 200);
			} else {
				$this->response([
					'status' =>"0",
					'error' => "Some problems occurred, please try again.!"
				], 400);				

			}

		}
	}

	public function login_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['email'] = $this->post('email');
			$userData['password'] = $this->post('password');
		}
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() === false) {

			if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}
			if(form_error('password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('password'))
				], 400);
			}
			
		} else {

			$where = "user_emailid = '".$userData['email']."'";
			if (!$this->Apimodel->get_cond('user_accounts', $where)) 
			{				
				$this->response([
					'status' =>"0",
					'error' => "Invalid Email"
				], 400);			
			}else{
				
				$user = $this->Apimodel->get_cond('user_accounts',$where);
				
				if(base64_encode($userData['password'])!=$user->user_pasword)
				{
					$this->response([
						'status' =>"0",
						'error' => "Invalid Password"
					], 400);

				} else{
					
					$array = [
					'status' =>"1",
					'personalInfo' => [
						'user_id' => $user->user_id ,
						'user_fname' =>$user->user_fname,
						'user_lname'=>$user->user_lname,
						'user_emailid' => $user->user_emailid,
						'user_status' => $user->user_status,
						'u_type' => $user->u_type,
						'created_at' => $user->created_at,													
					]
				];

				$array = $this->arrcheck($array);

				$this->response($array, 200);

				}
			}
		}

	}

	public function forgotPassword_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['email'] = $this->post('email');
		}
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		
		if ($this->form_validation->run() === false) {

			if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}
			
		} else {

			$where = "user_emailid = '".$userData['email']."'";
			if(!$this->Apimodel->get_cond('user_accounts', $where)) 
			{				
				$this->response([
					'status' =>"0",
					'error' => "Invalid Email"
				], 400);			
			}else{
				$user = $this->Apimodel->get_cond('user_accounts',$where);
				$rand=rand(111111,999999);
				 $subject = 'Your Password has been reset by Keteke';
                $imagePath = base_url('fassets/images/logos/headertransparentlogo.png');
                $message = "
                <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
                <tbody>
                <tr>
                <td align='center'>
                <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-top:2px solid #232323'>
                <tbody>
                <tr>
                <td height='35'></td>
                </tr>
                <tr>
                <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'><img src='" . $imagePath . "'/></td>
                </tr>
                <tr>
                <td height='35'></td>
                </tr>
                <tr>
                <td align='left' style='padding:5px 10px;font-family: Raleway, sans-serif; font-size:16px; font-weight: bold; color:#2a3a4b;'>Hello ".$user->user_fname."&nbsp;".$user->user_lname.",</td>
                </tr>
                <tr>
                <td height='10'></td>
                </tr>
                <tr>
                <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>
                We have successfully generated a new password upon your request.
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                <tr>
                <td align='center'>
                <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9; border-bottom:2px solid #232323'>
                <tbody>
                <tr>
                <td height='10'></td>
                </tr>
                <tr>
                <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: 400;'>
                Your new generated password is: <strong style='font-weight:bold;'>".$rand."</strong>
                </td>
                </tr>
                <tr>
                <td height='10'></td>
                </tr>
                <tr>
                <td height='10'></td>
                </tr>
                <tr>
                <td align='left' style='padding:5px 10px;font-family: Lato, sans-serif; font-size:16px; color:#444; line-height:24px; font-weight: bold;'>
                Email: " . $user->user_emailid . "<br/>
                </td>
                </tr>
                <tr>
                <td height='30'></td>
                </tr>
                <tr>
                <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:16px; color:#232323; line-height:24px; font-weight: 700;'>
                Thank you!
                </td>
                </tr>
                <tr>
                <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>
                Sincerely
                </td>
                </tr>
                <tr>
                <td align='left' style='padding:0 10px;font-family: Lato, sans-serif; font-size:14px; color:#232323; line-height:24px; font-weight: 700;'>
                Team Keteke
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>";

                 $config = array(
      'protocol' => 'ssmtp',
    'smtp_host' => 'mail.mentorpark.com',
    'smtp_port' => 587,
    'smtp_user' => 'no-reply@mentorpark.com',
    'smtp_pass' => 'b(#x8Cn;PEWu',
    'smtp_crypto' => 'security',
    'mailtype' => 'html',
    'smtp_timeout' => '4',
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
  );

  $this->email->initialize($config);
  $this->email->from('no-reply@mentorpark.com','Keteke');
  $this->email->to($userData['email']);
  $this->email->subject($subject);
  $this->email->message($message);
  
                   if($this->email->send()){
				$data=array(
					'user_pasword'=>base64_encode($rand),
				);
				$update=$this->Apimodel->update_cond('user_accounts', "user_id='".@$user->user_id."'", $data);
				if($update)
				{
					$this->response([
						'status'=>"1",
						'message' => 'Email sent successfully.',
					], 200);
				} 
			}
				else {
					$this->response([
						'status' => "0",
						'error' => "Some problems occurred, please try again."
					], 400);
				}	
			}
		}

	}

	public function productList_get() 
	{

		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;
		}
		
		$list = $this->Apimodel->get_cond_all('products',"status='1'");

		if(!empty($list)) 
		{
			foreach ($list as $key)
			{
			$primgs=$this->Apimodel->get_cond('product_images','productId="'.@$key->productId.'"');
			$avg_rating=$this->Apimodel->fetch_single_join("SELECT AVG(rating) AS rate from product_review WHERE product_id='".$key->productId."'");
		if(!empty($avg_rating->rate)) {
		for ($i = 0; $i < $avg_rating->rate; $i++) {
			$rating=' <i class="ion-android-star active"></i>';
		}} else{
			$rating=' <i class="ion-android-star"></i>';
		}
				$arr =array();
				if(!empty($primgs->productImage))
					{
						$productImage = base_url().'assets/images/products/'.$primgs->productImage;
					} else {
						$productImage = '';
					}
				$array[] = [
					'productImage' =>$productImage,
					'productId' => $key->productId ,
					'productName' => $key->productName ,
					'offprice'=>@$key->offprice,
					'maxPrice'=>@$key->maxPrice,
					'slug'=>@$key->slug,
					'rating'=>@$rating,
				];				
			}

			$array = $this->arrcheck($array);
			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No Data found.'
			], 400);
		}
		
	}

	public function searchProductList_post() 
	{

		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		}
		else {
			$userData['keyword'] = $this->post('keyword');
		}
		$this->form_validation->set_rules('keyword', 'keyword', 'trim|required');
		if ($this->form_validation->run() === false) {

			if(form_error('keyword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('keyword'))
				], 400);
			}
			
		}
		else{
		
			if($userData['keyword']!="")
			{
			$searchdata = $this->db->query('SELECT * FROM products AS pd JOIN mrkt_category AS mk ON mk.id=pd.category WHERE (mk.name LIKE "%'.$userData['keyword'].'%" OR pd.productName LIKE "%'.$userData['keyword'].'%" OR pd.tags LIKE "%'.$userData['keyword'].'%")')->result();
		 }
		 else{
		 	$searchdata = $this->db->query('SELECT * FROM products AS pd JOIN mrkt_category AS mk ON mk.id=pd.category WHERE pd.status="1"')->result();
		 }
			
		if(!empty($searchdata)) 
		{
			foreach ($searchdata as $key)
			{
              
				$primgs=$this->Apimodel->get_cond('product_images','productId="'.$key->productId.'"');

				$arr =array();
				if($primgs->productImage!="")
					{
						$productImage = base_url().'assets/images/products/'.$primgs->productImage;
					} else {
						$productImage ='';
					}
				$array[] = [
					'productImage' =>$productImage,
					'productId' => $key->productId ,
					'productName' => $key->productName ,
					'offprice'=>@$key->offprice,
					'maxPrice'=>@$key->maxPrice,
					'slug'=>@$key->slug,
				];				
			}
			$array = $this->arrcheck($array);
			$this->response([
				'status'=>"1",
				'productList'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No Data found.'
			], 400);
		}

		
		}
		
	}

	public function productDetail_post() 
	{

		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		}
		else {
			$userData['slug'] = $this->post('slug');
		}
		$this->form_validation->set_rules('slug', 'slug', 'trim|required');
		if ($this->form_validation->run() === false) {

			if(form_error('slug')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('slug'))
				], 400);
			}
			
		}
		else{
		
			$prodetail =$this->Apimodel->get_cond('products','slug="'.$userData['slug'].'"');
		if(!empty($prodetail)) 
		{
			$primgs=$this->Apimodel->get_cond_all('product_images','productId="'.$prodetail->productId.'"');
			
		$avg_rating=$this->Apimodel->fetch_single_join("SELECT AVG(rating) AS rate from product_review WHERE product_id='".$prodetail->productId."'");
		if(!empty($avg_rating->rate)) {
		for ($i = 0; $i < $avg_rating->rate; $i++) {
			$rating=' <i class="ion-android-star active"></i>';
		}} else{
			$rating=' <i class="ion-android-star"></i>';
		}
				$arr =array();
				if($primgs[0]->productImage!="")
					{
						$productImage = base_url().'assets/images/products/'.$primgs[0]->productImage;
					} else {
						$productImage = '';
					}
					$productDetail =array(
					'productImage' =>$productImage,
					'productId' => $prodetail->productId ,
					'productName' => $prodetail->productName ,
					'offprice'=>@$prodetail->offprice,
					'maxPrice'=>@$prodetail->maxPrice,											
					'discount'=>@$prodetail->disc_percent,											
					'productCode'=>@$prodetail->prcode,											
					'brandName'=>@$prodetail->brand_name,											
					'variants'=>@$prodetail->variants,											
					'sku'=>@$prodetail->sku,											
					'description'=>@$prodetail->description,											
					'rating'=>@$rating,											
				);
				if(!empty($primgs))
				{
					foreach($primgs as $img)
				{
					if($img->productImage!="")
					{
						$productImage = base_url().'assets/images/products/'.$img->productImage;
					} else {
						$productImage = '';
					}
					$array[] = [
					'productImage' =>$productImage,
					'productImageId' => $img->productImageId  ,
					];	
				 }
				}
					
			$array = $this->arrcheck($array);
			$productDetail = $this->arrcheck($productDetail);
			$this->response([
				'status'=>"1",
				'productDetail'=>$productDetail,
				'imageList'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No Data found.'
			], 400);
		}

		
		}
		
	}

	public function bannerList_get() 
	{

		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;
		}
		
		$list = $this->Apimodel->get_cond_all('banner',"status='1'");

		if(!empty($list)) 
		{
			foreach ($list as $key)
			{
				
				$arr =array();

				if($key->image!="")
					{
						$image = base_url().'assets/images/banner/'.$key->image;
					} else {
						$image = '';
					}
				if($key->banner_type=='mbanner')
				{
				$banner[] = [
					'image' =>$image,
					'id' => $key->id ,
					'bannerType' => $key->banner_type ,
					'link'=>@$key->link,
				];	
				}
				if($key->banner_type=='adv')
				{
				$ads[] = [
					'image' =>$image,
					'id' => $key->id ,
					'bannerType' => $key->banner_type ,
					'link'=>@$key->link,
				];	
				}			
			}

			$banner = $this->arrcheck($banner);
			$ads = $this->arrcheck($ads);
			$this->response([
				'status'=>"1",
				'bannerList'=>$banner,
				'adsList'=>$ads,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No Data found.'
			], 400);
		}
		
	}

	public function profile_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
		}
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');

		if ($this->form_validation->run() === false) {
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
		} else {

			$user = $this->Apimodel->get_cond('user_accounts', "user_id='".$userData['userId']."'");
			if(!empty($user)) 
			{
				if($user->image!="")
				{
					$profileImage = base_url().'assets/images/products/'.$user->image;
				} else {
					$profileImage = '';
				}

				$array = [
					'status' =>"1",
					'personalInfo' => [
						'userId' => $user->user_id,
						'fname' =>$user->user_fname,
						'lname' =>$user->user_lname,
						'email'=>$user->user_emailid,
						'status' => $user->user_status,
						'userType' => $user->u_type,
						'profileImage' => $profileImage,
						'messageType' => $user->messageType,
					]
				];

				$array = $this->arrcheck($array);

				$this->response($array, 200);
			} else {
				$this->response([
					'status' => "0",
					'error' => 'No user was found.'
				], 400);
			}
		}
	}

	public function editProfile_post() 
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['fname'] = $this->post('fname');
			$userData['lname'] = $this->post('lname');
			$userData['email'] = $this->post('email');
			$userData['utype'] = $this->post('utype');
			
			$userData['messageType'] = $this->post('messageType');
		}

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('fname', 'fname', 'trim|required');
		$this->form_validation->set_rules('lname', 'lname', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('utype', 'utype', 'trim|required');
		//$this->form_validation->set_rules('image', 'image', 'trim|required');
		$this->form_validation->set_rules('messageType', 'messageType', 'trim|required');		

		if($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}

			if(form_error('fname')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('fname'))
				], 400);
			}	
			if(form_error('lname')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('lname'))
				], 400);
			}		

			if(form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}
			if(form_error('utype')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('utype'))
				], 400);
			}
			
			if(form_error('messageType')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('messageType'))
				], 400);
			}

		} else {

			$userId = $userData['userId'];			
				$mydata = array(
					'user_fname' =>$userData['fname'],
					'user_lname' =>$userData['lname'],
					'user_emailid' =>$userData['email'],
					'u_type' =>$userData['utype'],
					'messageType' =>$userData['messageType'],		
				); 

				$where="user_id=$userId";
				$update=$this->Apimodel->update_cond('user_accounts', $where, $mydata);

				$user = $this->Apimodel->get_cond('user_accounts', "user_id=$userId");

				if($user->image!="")
					{
						$profileImage = base_url().'assets/images/profile/'.$user->image;
					} else {
						$profileImage ='';
					}

				$arr= array(
					'userId' => $user->user_id,
					'fname' =>$user->user_fname,
					'lname' =>$user->user_lname,
					'email'=>$user->user_emailid,
					'utype' => $user->u_type,
					'messageType' => $user->messageType,
					'profileImage' => $profileImage,
					'status' => $user->user_status,
					'created' => $user->created_at,
					
				);
				$arr = $this->arrcheck($arr);

				if($update)
				{
					$this->response([
						'status'=>"1",
						'message' => 'Profile updated successfully.',
						'personalInfo'=>$arr
					], 200);
				} else {
					$this->response([
						'status' => "0",
						'error' => "Some problems occurred, please try again."
					], 400);
				}

			} 
	}

	public function updateProfileImage_post() 
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['profileImage'] = $this->post('profileImage');
		}		

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');

		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);

			}

		} else {

			$userId = $userData['userId']; 

			if(empty($_FILES['profileImage']['name'])){
				$this->response([
					'status' => "0",
					'error' => "Please insert profileImage"
				], 400);

			} 
			else {

				$dataraw = $this->Apimodel->get_cond('user_accounts', "user_id=$userId");

			if(!empty($dataraw))
			{
				$config['upload_path'] = './assets/images/profile/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 204800;
				$config['max_width'] = 30000;
				$config['max_height'] = 20000;
				$config['file_name'] = uniqid();
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('profileImage'))
				{
					$error = array('error' => $this->upload->display_errors());
					@$image = $dataraw->image;

				} else {
					$file_data = $this->upload->data();
					$image = $file_data['file_name'];

				} 

					$data = array(
						'image'=>$image
					); 

					$where = array('user_id' => $userId);

					$update = $this->Apimodel->update_cond('user_accounts',$where, $data);

					$path = base_url()."assets/images/profile/".$image;

					if($update){
						$this->response([
							'status' => "1",
							'profileImage' => $path,
							'message' => 'Profile Image updated successfully.'
						], 200);

					} else {
						$this->response([
							'status' => "0",
							'error' => "Some problems occurred, please try again."
							 ], 400);
					}

				} else {
					$this->response([
						'status' => "0",
						'error' => 'userId is invalid.'

					], 400);
				}
			}
		}
	}

	public function changePassword_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['userId'] = $this->post('userId');
			$userData['oldPassword'] = $this->post('oldPassword');
			$userData['newPassword'] = $this->post('newPassword');
		}

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('oldPassword', 'oldPassword', 'trim|required');
		$this->form_validation->set_rules('newPassword', 'newPassword', 'trim|required|min_length[6]');		

		if ($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}

			if(form_error('oldPassword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('oldPassword'))
				], 400);
			}

			if(form_error('newPassword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('newPassword'))
				], 400);
			}

		} else {	

			$encrptpass = $this->enc_password($userData['oldPassword']);			
			
			$userId = $userData['userId'];		
			$where = "user_id = '$userId'";
			
			$details = $this->Apimodel->get_cond('user_accounts', $where);

			if($details) 
			{
				if(base64_encode($userData['oldPassword'])!=$details->user_pasword) 
				{
					$this->response([
						'status' => "0",
						'error' => 'Old password is not matched!'
					], 400);

				}

				$data = array(
					'user_pasword' => base64_encode($userData['newPassword'])
				); 		

				$where="user_id = $userId";

				$update=$this->Apimodel->update_cond('user_accounts', $where, $data);	
				
				if($update)
				{

					$this->response([
						'status' => "1",
						'userId' =>$userId,
						'message' => 'Password updated successfully.'
					], 200);

				} else {
					$this->response([
						'status' => "0",
						'error' => 'Some problems occurred, please try again.!'
					], 400);
				
				}
			} else {
				$this->response([
					'status' => "0",
					'error' => 'User not found!'
				], 400);

			}

		}
	}


	public function categoryList_get() 
	{

		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_GET = (array) $obj;
			$userData = $_GET;
		}		
		
		
		$list = $this->Apimodel->get_cond_all('category',"status='1'");

		if(!empty($list)) 
		{
			foreach ($list as $cat)
			{
				$arr =array();

				$array[] = [
					'id' => $cat->id,
					'name'=>@$cat->name,
				];				
			}

			$array = $this->arrcheck($array);
			$this->response([
				'status'=>"1",
				'list'=>$array,

			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No Data found.'
			], 400);
		}
		
	}

	public function subcategoryList_post() 
	{

		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['categoryId'] = $this->post('categoryId');
		}	
		
		$this->form_validation->set_rules('categoryId', 'categoryId', 'trim|required');

		if ($this->form_validation->run() === false) {
			if(form_error('categoryId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('categoryId'))
				], 400);
			}
		}
		else {
		$subcategory = $this->Apimodel->get_cond_all('listing_category',"status='1' and id='".@$userData['categoryId']."'");
		if(!empty($subcategory)) 
		{
			foreach($subcategory as $sub)
			{
			$list = $this->Apimodel->get_cond_all('products',"status='1' and category='".@$sub->catid."'");
				$arr =array();
				$productList =array();
				if(!empty($list))
				{
					foreach($list as $key)
					{
					$productImage = $this->Apimodel->get_cond('product_images',"productId='".@$key->productId."'");

				if($productImage->productImage!="")
					{
						$productImage = base_url().'assets/images/products/'.$productImage->productImage;
					} else {
						$productImage = '';
					}
					$productList[] =array(
					'productImage' =>$productImage,
					'productId'=>$key->productId,
					'productName'=>$key->productName,
					'slug'=>$key->slug,
				);	
					}
				}		
				$subcategoryList[] = [
					'subCategoryName'=>$sub->name,
					'productList'=>$productList,

				];
					
			}
			$subcategoryList = $this->arrcheck($subcategoryList);
			//$productList = $this->arrcheck($productList);
			$this->response([
				'status'=>"1",
				'subcategoryList'=>$subcategoryList,
				//'productList'=>$productList,

			], 200);
		}
		 else {
			$this->response([
				'status' => "0",
				'error' => 'No Data found.'
			], 400);
		}
	}
		
	}

	function addReview_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['productId'] = $this->post('productId');
			$userData['rating'] = $this->post('rating');
			$userData['name'] = $this->post('name');
			$userData['subject'] = $this->post('subject');
			$userData['message'] = $this->post('message');
		}

		$this->form_validation->set_rules('productId', 'productId', 'trim|required');
		$this->form_validation->set_rules('rating', 'rating', 'trim|required');
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('subject', 'subject', 'trim|required');
		$this->form_validation->set_rules('message', 'message', 'trim|required');

		if ($this->form_validation->run() === false) 
		{	
			if(form_error('productId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('productId'))
				], 400);
			}		
			if(form_error('rating')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('rating'))
				], 400);
			}
			if(form_error('name')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('name'))
				], 400);
			}
			if(form_error('subject')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('subject'))
				], 400);
			}
			
			if(form_error('message')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('message'))
				], 400);
			}
			

		} else {

			$mydata=array(
				'product_id'=>$userData['productId'],
				'rating'=>$userData['rating'],
				'name'=>$userData['name'],
				'subject'=>$userData['subject'],
				'message'=>$userData['message'],
				'add_date'=>date('Y-m-d H:i:s'),				
			);	
			$result=$this->Apimodel->add_details("product_review", $mydata);			

			if($result)
			{			
				$array = [
					'status' => "1",
					'message'=>'Added review successfully!',
				];

				$array = $this->arrcheck($array);
				$this->response($array, 200);
			} else {
				$this->response([
					'status' =>"0",
					'error' => "Some problems occurred, please try again.!"
				], 400);				

			}

		}
	}

	function addtoCart_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['productId'] = $this->post('productId');
			$userData['qty'] = $this->post('qty');
			$userData['productName'] = $this->post('productName');
			$userData['price'] = $this->post('price');
			$userData['image'] = $this->post('image');
		}

		$this->form_validation->set_rules('productId', 'productId', 'trim|required');
		$this->form_validation->set_rules('qty', 'qty', 'trim|required');
		$this->form_validation->set_rules('productName', 'productName', 'trim|required');
		$this->form_validation->set_rules('price', 'price', 'trim|required');
		$this->form_validation->set_rules('image', 'image', 'trim|required');

		if ($this->form_validation->run() === false) 
		{	
			if(form_error('productId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('productId'))
				], 400);
			}		
			if(form_error('qty')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('qty'))
				], 400);
			}
			if(form_error('productName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('productName'))
				], 400);
			}
			if(form_error('price')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('price'))
				], 400);
			}
			
			if(form_error('image')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('image'))
				], 400);
			}
			

		} else {

			 $data = array(
            'id'      => $userData['productId'],
            'qty'     => $userData['qty'],
            'name'   => $userData['productName'],
            'price'=> $userData['price'],
            'image'=> $userData['image']
        );
        
        if($this->cart->insert($data))
			{			
				$array = [
					'status' => "1",
					'message'=>'Added add to cart successfully!',
				];

				$array = $this->arrcheck($array);
				$this->response($array, 200);
			} else {
				$this->response([
					'status' =>"0",
					'error' => "Some problems occurred, please try again.!"
				], 400);				

			}

		}
	}

	public function cartList_post() 
	{

		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
		}	
		
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');

		if ($this->form_validation->run() === false) {
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
		}
		else {
		$cartlist = $this->cart->contents();
		if(!empty($cartlist)) 
		{
			foreach($cartlist as $crt)
			{
				$subtotal += $crt["subtotal"];
				$grtotal = $subtotal;
			$shipchrge=$this->Apimodel->get_cond('products',"productId='".$crt['id']."'");
			if(!empty($crt['image']))
			{
				$productImage = base_url().'assets/images/products/'.$crt['image'];
			}
			else{
				$productImage='';
			}
				$arr =array();	
				$cartList[] = [
					'productImage'=>$productImage,
					'productName'=>$crt['name'],
					'price'=>$crt['price'],
					'quantity'=>$crt['qty'],
					'cartId'=>$crt['rowid'],
					'subTotal'=>$crt['subtotal'],
				];
					
			}
			$cartSummary = [
						'subTotal' => $subtotal,
						'discountTotal' =>$subtotal,
						'grandTotal' =>$grtotal,
					];
			$cartList = $this->arrcheck($cartList);
			$cartSummary = $this->arrcheck($cartSummary);
			$this->response([
				'status'=>"1",
				'cartList'=>$cartList,
				'cartSummary'=>$cartSummary,
				
			], 200);
		}
		 else {
			$this->response([
				'status' => "0",
				'error' => 'No Data found.'
			], 400);
		}
	}
		
	}
	
	
	public function generate_url_slug($string, $table, $field='link', $key=NULL, $value=NULL)
	{
		$t =& get_instance();
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params[$field] = $slug;

		if($key)$params["$key !="] = $value; 

		while ($t->db->where($params)->get($table)->num_rows())
		{   
			if (!preg_match ('/-{1}[0-9]+$/', $slug ))
				$slug .= '-' . ++$i;
			else
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );

			$params [$field] = $slug;
		}   
		return $slug;   
	}
	public function generate_numbers($start, $count, $digits)
	{
		$result = array();
		for ($n = $start; $n < $start + $count; $n++) {
			$result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
		}
		return $result;
	}

	public function generate_otp($length)
	{
		$characters = '123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) 
		{
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function arrcheck($array)
	{
		array_walk_recursive($array, function (&$array, $key){
			$array = (null === $array)? '' : $array;
		}); 
		return $array;
	}

	public function hash($string) 
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}

	public function enc_password($password)
	{
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		return $encrypted_password;
	}
}
