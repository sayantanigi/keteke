<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller
{
	public function __construct() 
	{ 
		parent::__construct();
		$this->load->model('Apimodel');
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

			if($result) {

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
						'user_id ' => $user->user_id ,
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

	public function forgot_post()
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
                 $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: KETEKE CONTACT PAGE' . "\r\n";

              //  mail($user->user_emailid,$subject,$message,$headers);
				$data=array(
					'user_password'=>base64_encode($rand),
				);
				$update=$this->Apimodel->update_cond('user_accounts', "user_id='".@$user->user_id."'", $data);
				if($update)
				{
					$this->response([
						'status'=>"1",
						'message' => 'Email sent successfully.',
					], 200);
				} else {
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
			$primgs=$this->Apimodel->get_cond('product_images','productId="'.$key->productId.'"');

				$arr =array();
				if($primgs->productImage!="")
					{
						$productImage = base_url().'assets/images/products/'.$primgs->productImage;
					} else {
						$productImage = base_url().'uploads/nouser.png';
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
						$productImage = base_url().'uploads/nouser.png';
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

				$arr =array();
				if($primgs[0]->productImage!="")
					{
						$productImage = base_url().'assets/images/products/'.$primgs[0]->productImage;
					} else {
						$productImage = base_url().'uploads/nouser.png';
					}
					$productDetail =array(
					'productImage' =>$productImage,
					'productId' => $prodetail->productId ,
					'productName' => $prodetail->productName ,
					'offprice'=>@$prodetail->offprice,
					'maxPrice'=>@$prodetail->maxPrice,											
				);
				if(!empty($primgs))
				{
					foreach($primgs as $img)
				{
					if($img->productImage!="")
					{
						$productImage = base_url().'assets/images/products/'.$img->productImage;
					} else {
						$productImage = base_url().'uploads/nouser.png';
					}
					$array[] = [
					'productImage' =>$productImage,
					'productImageId ' => $img->productImageId  ,
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
						$image = base_url().'uploads/nouser.png';
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

	public function updateProfile_post() 
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['name'] = $this->post('name');
			$userData['dob'] = $this->post('dob');
			$userData['gender'] = $this->post('gender');
			$userData['countryId'] = $this->post('countryId');
			$userData['stateId'] = $this->post('stateId');
			$userData['cityId'] = $this->post('cityId');
			$userData['region'] = $this->post('region');
			$userData['professionId'] = $this->post('professionId');
			$userData['websiteUrl'] = $this->post('websiteUrl');
			$userData['bio'] = $this->post('bio');
			$userData['bookingInfo'] = $this->post('bookingInfo');
			$userData['profileMode'] = $this->post('profileMode');
			$userData['profileSetting'] = $this->post('profileSetting');
			$userData['profilePic'] = $this->post('profilePic');
		}

		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('dob', 'dob', 'trim|required');
		$this->form_validation->set_rules('gender', 'gender', 'trim|required');
		$this->form_validation->set_rules('countryId', 'countryId', 'trim|required');
		$this->form_validation->set_rules('stateId', 'stateId', 'trim|required');
		$this->form_validation->set_rules('cityId', 'cityId', 'trim|required');		
		$this->form_validation->set_rules('professionId', 'professionId', 'trim|required');
		$this->form_validation->set_rules('websiteUrl', 'websiteUrl', 'trim|required');
		$this->form_validation->set_rules('bio', 'bio', 'trim|required');
		$this->form_validation->set_rules('bookingInfo', 'bookingInfo', 'trim|required');
		$this->form_validation->set_rules('profileMode', 'profileMode', 'trim|required');
		$this->form_validation->set_rules('profileSetting', 'profileSetting', 'trim|required');

		if($this->form_validation->run() === false) 
		{
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}

			if(form_error('name')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('name'))
				], 400);
			}	
			if(form_error('dob')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('dob'))
				], 400);
			}		

			if(form_error('gender')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('gender'))
				], 400);
			}
			if(form_error('countryId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('countryId'))
				], 400);
			}
			if(form_error('stateId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('stateId'))
				], 400);
			}
			if(form_error('cityId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('cityId'))
				], 400);
			}
			if(form_error('professionId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('professionId'))
				], 400);
			}
			if(form_error('websiteUrl')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('websiteUrl'))
				], 400);
			}
			if(form_error('bio')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('bio'))
				], 400);
			}
			if(form_error('bookingInfo')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('bookingInfo'))
				], 400);
			}
			if(form_error('profileMode')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('profileMode'))
				], 400);
			}
			if(form_error('profileSetting')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('profileSetting'))
				], 400);
			}


		} else {

			$userId = $userData['userId'];			
			$dataraw = $this->Apimodel->get_cond('users', "userId=$userId");

			if(!empty($dataraw))
			{
				$config['upload_path'] = './uploads/users/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 204800;
				$config['max_width'] = 30000;
				$config['max_height'] = 20000;
				$config['file_name'] = uniqid();
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('profilePic'))
				{
					$error = array('error' => $this->upload->display_errors());
					@$image = $dataraw->profilePic;

				} else {
					$file_data = $this->upload->data();
					$image = $file_data['file_name'];

				} 

				$mydata = array(
					'name' =>$userData['name'],
					'dob' =>$userData['dob'],
					'profileMode' =>$userData['profileMode'],
					'profileSetting' =>$userData['profileSetting'],
					'gender' =>$userData['gender'],
					'country' =>$userData['countryId'],
					'state' =>$userData['stateId'],
					'city' =>$userData['cityId'],
					'region' =>@$userData['region'],
					'profession' =>$userData['professionId'],
					'website' =>$userData['websiteUrl'],
					'bio' =>$userData['bio'],
					'bookingInfo' =>$userData['bookingInfo'],
					'profilePic'=>$image,
				); 

				$where="userId=$userId";
				$update=$this->Apimodel->update_cond('users', $where, $mydata);

				$user = $this->Apimodel->get_cond('users', "userId=$userId");

				if($user->profilePic!="")
					{
						$pic = base_url().'uploads/users/'.$user->profilePic;
					} else {
						$pic = base_url().'uploads/noimg.png';
					}

				$arr= array(
					'userId' => $user->userId,
					'name' =>$user->name,
					'email'=>$user->email,
					'userName' => $user->username,
					'mobile' => $user->mobile,
					'email' => $user->email,
					'dob' => $user->dob,					
					'profileMode' => $user->profileMode,
					'profileSetting' => $user->profileSetting,
					'gender' => $user->gender,
					'countryId' => $user->country,
					'stateId' => $user->state,
					'cityId' => $user->city,
					'region' => $user->region,
					'professionId' => $user->profession,
					'website' => $user->website,
					'bio' => $user->bio,
					'bookingInfo' => $user->bookingInfo,
					'profilePic' => $pic,
					'created' => $user->created,
					'modified' => $user->modified,	
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

			} else {
				$this->response([
					'status' => "0",
					'error' => 'No user found.'
				], 400);

			}

		}
	}

	public function profilePic_post() 
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['profilePic'] = $this->post('profilePic');
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

			if(empty($_FILES['profilePic']['name'])){
				$this->response([
					'status' => "0",
					'error' => "Please insert profilePic"
				], 400);

			} else {

				$query = $this->db->query("SELECT * FROM `users` WHERE `userId`= '".$userId."'");
				$num_rows = $query->num_rows();
				$dataraw = $query->result();

				if($num_rows>0) {

					$config['upload_path'] = './uploads/users/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = 204800;
					$config['max_width'] = 30000;
					$config['max_height'] = 20000;
					$config['file_name'] = uniqid();
					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('profilePic')) {
						$error = array('error' => $this->upload->display_errors());
						$image = @$dataraw->profilePic;

					} else {
						$file_data = $this->upload->data();
						$image = $file_data['file_name'];

					} 

					$data = array(
						'profilePic'=>$image
					); 

					$where = array('userId' => $userId);

					$update = $this->Apimodel->update_cond('users',$where, $data);

					$path = base_url()."uploads/users/".$image;

					if($update){
						$this->response([
							'status' => "1",
							'profilePic' => $path,
							'message' => 'Profile pic updated successfully.'
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

	
	
	public function userInfo_post()
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

			$user = $this->Apimodel->get_cond('users', "userId='".$userData['userId']."'");
			if(!empty($user)) 
			{
				if($user->profilePic!="")
				{
					$pic = base_url().'uploads/users/'.$user->profilePic;
				} else {
					$pic = base_url().'uploads/noimg.png';
				}

				$musicInfo = $this->Apimodel->get_cond("user_music_stores", "userId='".$userData['userId']."'");

				$professionInfo = $this->Apimodel->get_cond("profession", "professionId='".$user->profession."'");

				$followerList = $this->Apimodel->get_cond_all("followings", "userId='".$userData['userId']."'");

				$followingList = $this->Apimodel->get_cond_all("followings", "followingId='".$userData['userId']."'");

				$countryInfo = $this->Apimodel->get_cond("countries", "id='".$user->country."'");
				$stateInfo = $this->Apimodel->get_cond("states", "id='".$user->state."'");
				$cityInfo = $this->Apimodel->get_cond("cities", "id='".$user->city."'");


				$array = [
					'status' =>"1",
					'personalInfo' => [
						'userId' => $user->userId,
						'name' =>$user->name,
						'email'=>$user->email,
						'userName' => $user->username,
						'mobile' => $user->mobile,
						'email' => $user->email,
						'dob' => $user->dob,					
						'profileMode' => $user->profileMode,
						'profileSetting' => $user->profileSetting,
						'gender' => $user->gender,
						'countryId' => $user->country,
						'countryName' => @$countryInfo->name,
						'stateId' => $user->state,
						'stateName' => @$stateInfo->name,
						'cityId' => $user->city,
						'cityName' => @$cityInfo->name,
						'region' => $user->region,
						'professionId' => $user->profession,
						'professionTitle'=>$professionInfo->title,
						'totalFollowerList' =>count($followerList),
						'totalFollowingList' =>count($followingList),
						'website' => $user->website,
						'bio' => $user->bio,
						'bookingInfo' => $user->bookingInfo,
						'facebook' => $user->facebook,
						'twitter' => $user->twitter,
						'instagram' => $user->instagram,
						'linkedin' => $user->linkedin,
						'pinterest' => $user->pinterest,
						'tiktok' => $user->tiktok,
						'onlyfans' => $user->onlyfans,
						'youtube' =>$user->youtube,
						'profilePic' => $pic,
						'created' => $user->created,
						'modified' => $user->modified,
						'music'=>@$musicInfo->music,
						'spotify'=>@$musicInfo->spotify,								
						'youtubeMusic'=>@$musicInfo->youtube,
						'tiktokMusic'=>@$musicInfo->tiktok,
						'googleplay'=>@$musicInfo->googleplay,
						'amazon'=>@$musicInfo->amazon,
						'deezer'=>@$musicInfo->deezer,
						'pandora'=>@$musicInfo->pandora,
						'sahazam'=>@$musicInfo->sahazam,
						'digital'=>@$musicInfo->digital,
						'kkbox'=>@$musicInfo->kkbox,
						'linemusic'=>@$musicInfo->linemusic,
						'anghami'=>@$musicInfo->anghami,
						'boomplay'=>@$musicInfo->boomplay,
						'tencent'=>@$musicInfo->tencent,
						'mediant'=>@$musicInfo->mediant,
						'tunecore'=>@$musicInfo->tunecore,
						'unitedmaster'=>@$musicInfo->unitedmaster,
						'cdbabay'=>@$musicInfo->cdbabay,
						'music1'=>@$musicInfo->music1,
						'music2'=>@$musicInfo->music2,
						'music3'=>@$musicInfo->music3,
						'music4'=>@$musicInfo->music4,
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
			$where = "userId = '$userId'";
			
			$details = $this->Apimodel->get_cond('users', $where);

			if($details) 
			{
				if (password_verify($userData['oldPassword'], $details->password) == 0) 
				{
					$this->response([
						'status' => "0",
						'error' => 'Old password is not matched!'
					], 400);

				}

				$data = array(
					'password' => $this->enc_password($userData['newPassword'])
				); 		

				$where="userId = $userId";

				$update=$this->Apimodel->update_cond('users', $where, $data);	
				
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
					'categoryId' => $cat->categoryId,
					'categoryName'=>@$cat->categoryName,
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

	function addvideo_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);

		if(is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;

		} else {
			$userData['title'] = $this->post('title');
			$userData['userId'] = $this->post('userId');
			$userData['type'] = $this->post('type');
			$userData['url'] = $this->post('url');
			
			$userData['description'] = $this->post('description');
			$userData['videoType'] = $this->post('videoType');
			$userData['tags'] = $this->post('tags');
			$userData['category'] = $this->post('category');
			$userData['coverImage'] = $this->post('coverImage');
		}
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		$this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('type', 'type must be selected dailymotion,youtube,other', 'trim|required');
		
		$this->form_validation->set_rules('tags', 'tags', 'trim|required');
		$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('category', 'category', 'trim|required');
		$this->form_validation->set_rules('videoType', 'videoType', 'trim|required');
		
		
		if ($this->form_validation->run() === false) 
		{	
			if(form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}		
			if(form_error('title')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('title'))
				], 400);
			}
			if(form_error('type')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('type'))
				], 400);
			}
			
			if(form_error('tags')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('tags'))
				], 400);
			}
			if(form_error('description')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('description'))
				], 400);
			}
			if(form_error('category')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('category'))
				], 400);
			}
			if(form_error('videoType')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('videoType'))
				], 400);
			}
			

		} 
		else {
			$type=$userData['type'];
			if($type=='dailymotion')
			{
				$this->form_validation->set_rules('url', 'url', 'trim|required');
				if ($this->form_validation->run() === false) 
			{
			
				if(form_error('url')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('url'))
				], 400);
			}
		}
			$url =$userData['url'];
			$path = parse_url($url, PHP_URL_PATH);
			$pieces = explode('/', $path);

			$thumb=$this->mymodel->getDailymotionThumb($pieces[2],'thumbnail_medium_url');			

			}elseif($type=='metacafe') {
				if ($this->form_validation->run() === false) 
			{
				if(form_error('url')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('url'))
				], 400);
			}
		}
			$url =$userData['url'];
			$path = parse_url($url, PHP_URL_PATH);
			$pieces = explode('/', $path);
			$thumb = $this->mymodel->getMetacafeThumb($pieces[2], $pieces[3]);
					
			}elseif($type=='youtube') {
			$this->form_validation->set_rules('url', 'url', 'trim|required');
			if ($this->form_validation->run() === false) 
		{
			
				if(form_error('url')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('url'))
				], 400);
			}
		}
			$myurl =$userData['url'];
			$url = $this->mymodel->getYoutubeEmbedUrl($myurl);
			$youtubeId = $this->mymodel->getYouTubeThumb($myurl);
			$thumb = "https://img.youtube.com/vi/".$youtubeId."/hqdefault.jpg";				
			}
			elseif($type=='other'){
				if (empty($_FILES['coverImage']['name']))
		{
			$this->form_validation->set_rules('coverImage', 'coverImage', 'trim|required');
		}
		if (empty($_FILES['video']['name']))
		{
			$this->form_validation->set_rules('video', 'video', 'trim|required');
		}
			if ($this->form_validation->run() === false) 
		{
				if(form_error('coverImage')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('coverImage'))
				], 400);
			}
			if(form_error('video')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('video'))
				], 400);
			}
		}
			$config['upload_path'] = './uploads/videos/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] =204800;
			$config['file_name'] = uniqid();
			
			$this->load->library('upload', $config);
			if (! $this->upload->do_upload('coverImage'))
			{
				$error = strip_tags($this->upload->display_errors());
				$msg = '["'.$error.'", "error", "#DD6B55"]';

			}

			$data = $this->upload->data();
			$thumb =  $data['file_name'];

			$configVideo['upload_path'] = './uploads/videos/'; 
			$configVideo['max_size'] = 204800;
			$configVideo['allowed_types'] = 'mp4';
			$configVideo['overwrite'] = FALSE;
			$configVideo['remove_spaces'] = TRUE;
			$video_name = uniqid();
			$configVideo['file_name'] = $video_name;
			$this->load->library('upload', $configVideo);
			$this->upload->initialize($configVideo);
			if(!$this->upload->do_upload('video'))
			{
			    $error = strip_tags($this->upload->display_errors());
				$msg = '["'.$error.'", "error", "#DD6B55"]';
				
			}
			$data = $this->upload->data();			
			$url = $data['file_name'];
		}
			$url_slug=$this->mymodel->generate_slug($userData['title'],'videos');
			
			$mydata=array(
				'userId'=>$userData['userId'],
				'title'=>$userData['title'],
				'type' =>$userData['type'],
			    'url' =>$url,
				'coverImage' =>$thumb,
				'tags'=>$userData['tags'],
				'description'=>$userData['description'],
				'category'=>$userData['category'],
				'videoType'=>$userData['videoType'],
				'slug' =>$url_slug,
				'created'=>date('Y-m-d H:i:s'),				
				'status'=>0
			);	
			$result=$this->Apimodel->add_details("videos", $mydata);			

			if($result)
			{			

				$array = [
					'status' => "1",
					'message'=>'Created video successfully!',
					
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

	
	function editphoto_post()
	{
		$json = file_get_contents('php://input');
		$obj = json_decode($json,true);
		if(is_array($obj)) 
		{
			$_POST = (array) $obj;
			$userData = $_POST;
		}
		else {
			$userData['phId'] = $this->post('phId');
			$userData['title'] = $this->post('title');
			$userData['bannerImage'] = $this->post('bannerImage');
		}
		$this->form_validation->set_rules('phId', 'phId', 'trim|required');
		$this->form_validation->set_rules('title', 'title', 'trim|required');
		if (empty($_FILES['bannerImage']['name']))
		{
		$this->form_validation->set_rules('bannerImage', 'bannerImage', 'trim|required');
		}
		if($this->form_validation->run() === false) {

			if(form_error('phId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('phId'))
				], 400);
			}
			if(form_error('title')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('title'))
				], 400);
			}
			if(form_error('bannerImage')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('bannerImage'))
				], 400);
			}
			
		}
		else{
			$dataraw = $this->Apimodel->get_cond('photos', "phId='".$userData['phId']."'");

			if(!empty($dataraw))
			{
				$config['upload_path'] = './uploads/users/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 204800;
				$config['file_name'] = uniqid();
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('bannerImage'))
				{
					$error = array('error' => $this->upload->display_errors());
					@$image = $dataraw->bannerImage;

				} else {
					$file_data = $this->upload->data();
					$image = $file_data['file_name'];

				} 
			$mydata = array(
					'title' =>$userData['title'],
					'images' =>$image,
				);
			$where="phId='".$userData['phId']."'";
				$result=$this->Apimodel->update_cond('photos',$where,$mydata);	
		
			if($result)
				{
					$this->response([
						'status'=>"1",
						'message' => 'Updated photo successfully',
						'phId' =>$userData['phId'],
					], 200);
				} else {
					$this->response([
						'status' => "0",
						'error' => "Some problems occurred, please try again."
					], 400);
				}
			}
			else {
				$this->response([
					'status' => "0",
					'error' => 'No Photos found.'
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
