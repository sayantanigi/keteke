<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Api extends REST_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Apimodel');
		$this->load->library('cart');
	}
	public function signup_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
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
		if ($this->form_validation->run() === false) {
			if (form_error('user_fname')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('user_fname'))
				], 400);
			}
			if (form_error('user_lname')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('user_lname'))
				], 400);
			}
			if (form_error('user_emailid')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('user_emailid'))
				], 400);
			}
			if (form_error('user_password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('user_password'))
				], 400);
			}
			if (form_error('u_type')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('u_type'))
				], 400);
			}
		} else {
			$mydata = array(
				'user_fname' => $userData['user_fname'],
				'user_lname' => $userData['user_lname'],
				'user_emailid' => $userData['user_emailid'],
				'user_pasword' => base64_encode($userData['user_password']),
				'u_type' => $userData['u_type'],
				'user_status' => 1,
				'created_at' => date('Y-m-d H:i:s'),
			);
			$result = $this->Apimodel->add_details("user_accounts", $mydata);
			if ($result) {
				$fetchdetails = $this->Apimodel->get_cond('user_accounts', "user_id ='$result'");
				$array = [
					'status' => "1",
					'message' => 'You have registered successfully!',
					'user_id' => $fetchdetails->user_id,
				];
				$array = $this->arrcheck($array);
				$this->response($array, 200);
			} else {
				$this->response([
					'status' => "0",
					'error' => "Some problems occurred, please try again.!"
				], 400);
			}
		}
	}
	public function login_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['email'] = $this->post('email');
			$userData['password'] = $this->post('password');
		}
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		if ($this->form_validation->run() === false) {
			if (form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}
			if (form_error('password')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('password'))
				], 400);
			}
		} else {
			$where = "user_emailid = '" . $userData['email'] . "'";
			if (!$this->Apimodel->get_cond('user_accounts', $where)) {
				$this->response([
					'status' => "0",
					'error' => "Invalid Email"
				], 400);
			} else {
				$user = $this->Apimodel->get_cond('user_accounts', $where);
				if (base64_encode($userData['password']) != $user->user_pasword) {
					$this->response([
						'status' => "0",
						'error' => "Invalid Password"
					], 400);
				} else {
					$checkorder_details = $this->db->query("SELECT * FROM productorders WHERE userid = '".$userData['email']."'")->result_array();
	                if(!empty($checkorder_details)) {
	                    $update1 = $this->db->query("UPDATE customer_billing_addrs SET user_id = '".$user->user_id."' WHERE user_id = '".$userData['email']."'");
	                    $update2 = $this->db->query("UPDATE customer_shipping_addrs SET user_id = '".$user->user_id."' WHERE user_id = '".$userData['email']."'");
	                    $update3 = $this->db->query("UPDATE user_address SET user_id = '".$user->user_id."' WHERE user_id = '".$userData['email']."'");
	                    $update4 = $this->db->query("UPDATE productorders SET userid = '".$user->user_id."' WHERE userid = '".$userData['email']."'");
	                }
					$array = [
						'status' => "1",
						'personalInfo' => [
							'user_id' => $user->user_id,
							'user_fname' => $user->user_fname,
							'user_lname' => $user->user_lname,
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
	public function forgotPassword_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['email'] = $this->post('email');
		}
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		if ($this->form_validation->run() === false) {
			if (form_error('email')) {
				$this->response(['status' => "error", 'result' => strip_tags(form_error('email'))], 400);
			}
		} else {
			$where = "user_emailid = '" . $userData['email'] . "'";
			if (!$this->Apimodel->get_cond('user_accounts', $where)) {
				$this->response(['status' => "error",'result' => "Invalid Email"], 400);
			} else {
				$frmemail=theme_option('email');
				$user = $this->Apimodel->get_cond('user_accounts', $where);
				$rand = rand(111111, 999999);
				$subject = 'Forgot password recovery';
				$headers = "From: KETEKE <".$frmemail.">\r\n"; 
		        //$headers .= "Reply-To: ".strip_tags($frmemail) . "\r\n"; 
		        $headers .= "MIME-Version: 1.0\r\n";
		        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				//$imagePath = base_url('fassets/images/logos/headertransparentlogo.png');
				$message = "<table align='center' style='width:650px; text-align:center; background:#F9F9F9;'>
		        <tbody>
		        <tr style='height:50px;background-color:#f2f2f2;'><td valign='middle' style='color:white;'><img src='" . site_url(). "fassets/images/logos/headertransparentlogo.png' alt='KETEKE' title='Keteke'  style='width:210px;height:auto' /></td></tr>
		        <tr>
		        <td valign='top' align='center' colspan='2'>
		        <table align='' style='height:380px; color:#000; width:600px;'>
		        <tbody>
		        <td valign='top' align='' colspan='2'>
		        <table align='' style='color:#000; width:600px;'>
		        <tbody>
		        <br>
		        <p>Dear ".$user->user_fname.", <br>
		        <p>You are requesting for forgot password.<br><br>
		        Please click below link to update your password:<br><br>
		        <a href=".base_url('update-forgot-password/'.base64_encode($user->user_id))." target='blank'><b>click here</b></a><br><br>
		        Thank You,<br><br>
		        Keteke Team </p><br>
		        </tbody>
		        </table>     
		        <strong>Email: </strong>".$frmemail."<br><br>
		        This is an automated response, please <b>DO NOT</b> reply.
		        </td>
		        </tr>
		        </tbody>
		        </table>
		        </td>
		        </tr>
		        </tbody>
		        </table>";
				if (mail($userData['email'], $subject, $message, $headers)) {
					$data = array(
						'user_pasword' => base64_encode($rand),
					);
					$update = $this->Apimodel->update_cond('user_accounts', "user_id='" . @$user->user_id . "'", $data);
					if ($update) {
						$this->response(['status' => "success", 'result' => 'Email sent successfully.', 'Link' => base_url('update-forgot-password/'.$user->user_id)], 200);
					}
				} else {
					$this->response(['status' => "error",'result' => "Some problems occurred, please try again."], 400);
				}
			}
		}
	}
	public function productList_get() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_GET = (array) $obj;
			$userData = $_GET;
		}
		$list = $this->Apimodel->get_cond_all('products', "status='1'");
		if (!empty($list)) {
			foreach ($list as $key) {
				$primgs = $this->Apimodel->get_cond('product_images', 'productId="' . @$key->productId . '"');
				$avg_rating = $this->Apimodel->fetch_single_join("SELECT AVG(rating) AS rate from product_review WHERE product_id='" . $key->productId . "'");
				if (!empty($avg_rating->rate)) {
					for ($i = 0; $i < $avg_rating->rate; $i++) {
						$rating = ' <i class="ion-android-star active"></i>';
					}
				} else {
					$rating = ' <i class="ion-android-star"></i>';
				}
				$arr = array();
				if (!empty($primgs->productImage)) {
					$productImage = base_url() . 'assets/images/products/' . $primgs->productImage;
				} else {
					$productImage = '';
				}
				$array[] = [
					'productImage' => $productImage,
					'productId' => $key->productId,
					'productName' => $key->productName,
					'offprice' => @$key->offprice,
					'maxPrice' => @$key->maxPrice,
					'slug' => @$key->slug,
					'rating' => @$rating,
				];
			}
			$array = $this->arrcheck($array);
			$this->response([
				'status' => "1",
				'list' => $array,
			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No Data found.'
			], 400);
		}
	}
	public function searchProductList_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['keyword'] = $this->post('keyword');
		}
		$this->form_validation->set_rules('keyword', 'keyword', 'trim|required');
		if ($this->form_validation->run() === false) {
			if (form_error('keyword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('keyword'))
				], 400);
			}
		} else {
			if ($userData['keyword'] != "") {
				$searchdata = $this->db->query('SELECT * FROM products AS pd JOIN mrkt_category AS mk ON mk.id=pd.category WHERE (mk.name LIKE "%' . $userData['keyword'] . '%" OR pd.productName LIKE "%' . $userData['keyword'] . '%" OR pd.tags LIKE "%' . $userData['keyword'] . '%")')->result();
			} else {
				$searchdata = $this->db->query('SELECT * FROM products AS pd JOIN mrkt_category AS mk ON mk.id=pd.category WHERE pd.status="1"')->result();
			}
			if (!empty($searchdata)) {
				foreach ($searchdata as $key) {
					$primgs = $this->Apimodel->get_cond('product_images', 'productId="' . $key->productId . '"');
					$arr = array();
					if ($primgs->productImage != "") {
						$productImage = base_url() . 'assets/images/products/' . $primgs->productImage;
					} else {
						$productImage = '';
					}
					$array[] = [
						'productImage' => $productImage,
						'productId' => $key->productId,
						'productName' => $key->productName,
						'offprice' => @$key->offprice,
						'maxPrice' => @$key->maxPrice,
						'slug' => @$key->slug,
					];
				}
				$array = $this->arrcheck($array);
				$this->response([
					'status' => "1",
					'productList' => $array,
				], 200);
			} else {
				$this->response([
					'status' => "0",
					'error' => 'No Data found.'
				], 400);
			}
		}
	}
	public function productDetail_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['slug'] = $this->post('slug');
		}
		$this->form_validation->set_rules('slug', 'slug', 'trim|required');
		if ($this->form_validation->run() === false) {
			if (form_error('slug')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('slug'))
				], 400);
			}
		} else {
			$prodetail = $this->Apimodel->get_cond('products', 'slug="' . $userData['slug'] . '"');
			if (!empty($prodetail)) {
				$primgs = $this->Apimodel->get_cond_all('product_images', 'productId="' . $prodetail->productId . '"');
				$avg_rating = $this->Apimodel->fetch_single_join("SELECT AVG(rating) AS rate from product_review WHERE product_id='" . $prodetail->productId . "'");
				if (!empty($avg_rating->rate)) {
					for ($i = 0; $i < $avg_rating->rate; $i++) {
						$rating = ' <i class="ion-android-star active"></i>';
					}
				} else {
					$rating = ' <i class="ion-android-star"></i>';
				}
				$arr = array();
				if ($primgs[0]->productImage != "") {
					$productImage = base_url() . 'assets/images/products/' . $primgs[0]->productImage;
				} else {
					$productImage = '';
				}
				if(!empty(@$prodetail->brand_name)) {
					$query = $this->db->query("SELECT * FROM product_brand WHERE id = '".@$prodetail->brand_name."'")->row();
					$brand_name = $query->brand_name;
				} else {
					$brand_name = 'None';
				}
				$productDetail = array(
					'productImage' => $productImage,
					'productId' => $prodetail->productId,
					'productName' => $prodetail->productName,
					'offprice' => @$prodetail->offprice,
					'maxPrice' => @$prodetail->maxPrice,
					'discount' => @$prodetail->disc_percent,
					'productCode' => @$prodetail->prcode,
					'brandName' => @$brand_name,
					'variants' => @$prodetail->variants,
					'sku' => @$prodetail->sku,
					'description' => @$prodetail->description,
					'rating' => @$rating,
				);
				if (!empty($primgs)) {
					foreach ($primgs as $img) {
						if ($img->productImage != "") {
							$productImage = base_url() . 'assets/images/products/' . $img->productImage;
						} else {
							$productImage = '';
						}
						$array[] = [
							'productImage' => $productImage,
							'productImageId' => $img->productImageId,
						];
					}
				}
				$array = $this->arrcheck($array);
				$review = $this->db->query("SELECT * FROM product_review WHERE product_id='".$prodetail->productId."'")->result_array();
				if(!empty($review)) {
					foreach ($review as $key => $rw) {
						$reviewList[$key]['id'] = $rw['id'];
						$reviewList[$key]['name'] = $rw['name'];
						$reviewList[$key]['subject'] = $rw['subject'];
						$reviewList[$key]['message'] = $rw['message'];
						$reviewList[$key]['rating'] = $rw['rating'];
					}
				} else {
					$reviewList = "No Review";
				}
				$sumofRating5 = $this->db->query("SELECT COUNT(rating) as sum FROM product_review WHERE product_id='".$prodetail->productId."' AND rating = '5'")->row();
                $countofadence5 = $this->db->query("SELECT COUNT(id) as total FROM product_review WHERE product_id='".$prodetail->productId."'")->row();
                if(empty($countofadence5->total)) {
                    $val5 = "0";
                } else {
                    $val5 = ($sumofRating5->sum/$countofadence5->total)*100;
                }
                $sumofRating4 = $this->db->query("SELECT COUNT(rating) as sum FROM product_review WHERE product_id='".$prodetail->productId."' AND rating = '4'")->row();
                $countofadence4 = $this->db->query("SELECT COUNT(id) as total FROM product_review WHERE product_id='".$prodetail->productId."'")->row();
                if(empty($countofadence4->total)) {
                    $val4 = "0";
                } else {
                    $val4 = ($sumofRating4->sum/$countofadence4->total)*100;
                }
                $sumofRating3 = $this->db->query("SELECT COUNT(rating) as sum FROM product_review WHERE product_id='".$prodetail->productId."' AND rating = '3'")->row();
                $countofadence3 = $this->db->query("SELECT COUNT(id) as total FROM product_review WHERE product_id='".$prodetail->productId."'")->row();
                if(empty($countofadence3->total)) {
                    $val3 = "0";
                } else {
                    $val3 = ($sumofRating3->sum/$countofadence3->total)*100;
                }
                $sumofRating2 = $this->db->query("SELECT COUNT(rating) as sum FROM product_review WHERE product_id='".$prodetail->productId."' AND rating = '2'")->row();
                $countofadence2 = $this->db->query("SELECT COUNT(id) as total FROM product_review WHERE product_id='".$prodetail->productId."'")->row();
                if(empty($countofadence2->total)) {
                    $val2 = "0";
                } else {
                    $val2 = ($sumofRating2->sum/$countofadence2->total)*100;
                }
                $sumofRating1 = $this->db->query("SELECT COUNT(rating) as sum FROM product_review WHERE product_id='".$prodetail->productId."' AND rating = '1'")->row();
                $countofadence1 = $this->db->query("SELECT COUNT(id) as total FROM product_review WHERE product_id='".$prodetail->productId."'")->row();
                if(empty($countofadence1->total)) {
                    $val1 = "0";
                } else {
                    $val1 = ($sumofRating1->sum/$countofadence1->total)*100;
                }
                $ratingList = array('5' => $val5, '4' => $val4, '3' => $val3, '2' => $val2, '1' => $val1);
				$this->response([
					'status' => "1",
					'productDetail' => $productDetail,
					'imageList' => $array,
					'reviewList' => $reviewList,
					'ratingList' => $ratingList,
				], 200);
			} else {
				$this->response([
					'status' => "0",
					'error' => 'No Data found.'
				], 400);
			}
		}
	}
	public function bannerList_get() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_GET = (array) $obj;
			$userData = $_GET;
		}
		$list = $this->Apimodel->get_cond_all('banner', "status='1'");
		if (!empty($list)) {
			foreach ($list as $key) {
				$arr = array();
				if ($key->image != "") {
					$image = base_url() . 'assets/images/banner/' . $key->image;
				} else {
					$image = '';
				}
				if ($key->banner_type == 'mbanner') {
					$banner[] = [
						'image' => $image,
						'id' => $key->id,
						'bannerType' => $key->banner_type,
						'link' => @$key->link,
					];
				}
				if ($key->banner_type == 'adv') {
					$ads[] = [
						'image' => $image,
						'id' => $key->id,
						'bannerType' => $key->banner_type,
						'link' => @$key->link,
					];
				}
			}
			$banner = $this->arrcheck($banner);
			$ads = $this->arrcheck($ads);
			$this->response([
				'status' => "1",
				'bannerList' => $banner,
				'adsList' => $ads,
			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No Data found.'
			], 400);
		}
	}
	public function profile_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
		}
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		if ($this->form_validation->run() === false) {
			if (form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
		} else {
			$user = $this->Apimodel->get_cond('user_accounts', "user_id='" . $userData['userId'] . "'");
			if (!empty($user)) {
				if ($user->image != "") {
					$profileImage = base_url() . 'assets/images/profile/' . $user->image;
				} else {
					$profileImage = '';
				}
				$array = [
					'status' => "1",
					'personalInfo' => [
						'userId' => $user->user_id,
						'fname' => $user->user_fname,
						'lname' => $user->user_lname,
						'email' => $user->user_emailid,
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
	public function editProfile_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
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
		if ($this->form_validation->run() === false) {
			if (form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			if (form_error('fname')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('fname'))
				], 400);
			}
			if (form_error('lname')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('lname'))
				], 400);
			}
			if (form_error('email')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('email'))
				], 400);
			}
			if (form_error('utype')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('utype'))
				], 400);
			}
			if (form_error('messageType')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('messageType'))
				], 400);
			}
		} else {
			$userId = $userData['userId'];
			$mydata = array(
				'user_fname' => $userData['fname'],
				'user_lname' => $userData['lname'],
				'user_emailid' => $userData['email'],
				'u_type' => $userData['utype'],
				'messageType' => $userData['messageType'],
			);
			$where = "user_id=$userId";
			$update = $this->Apimodel->update_cond('user_accounts', $where, $mydata);
			$user = $this->Apimodel->get_cond('user_accounts', "user_id=$userId");
			if ($user->image != "") {
				$profileImage = base_url() . 'assets/images/profile/' . $user->image;
			} else {
				$profileImage = '';
			}
			$arr = array(
				'userId' => $user->user_id,
				'fname' => $user->user_fname,
				'lname' => $user->user_lname,
				'email' => $user->user_emailid,
				'utype' => $user->u_type,
				'messageType' => $user->messageType,
				'profileImage' => $profileImage,
				'status' => $user->user_status,
				'created' => $user->created_at,
			);
			$arr = $this->arrcheck($arr);
			if ($update) {
				$this->response([
					'status' => "1",
					'message' => 'Profile updated successfully.',
					'personalInfo' => $arr
				], 200);
			} else {
				$this->response([
					'status' => "0",
					'error' => "Some problems occurred, please try again."
				], 400);
			}
		}
	}
	public function updateProfileImage_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
			$userData['profileImage'] = $this->post('profileImage');
		}
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		if ($this->form_validation->run() === false) {
			if (form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
		} else {
			$userId = $userData['userId'];
			if (empty($_FILES['profileImage']['name'])) {
				$this->response([
					'status' => "0",
					'error' => "Please insert profileImage"
				], 400);
			} else {
				$dataraw = $this->Apimodel->get_cond('user_accounts', "user_id=$userId");
				if (!empty($dataraw)) {
					$config['upload_path'] = './assets/images/profile/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = 204800;
					$config['max_width'] = 30000;
					$config['max_height'] = 20000;
					$config['file_name'] = uniqid();
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('profileImage')) {
						$error = array('error' => $this->upload->display_errors());
						@$image = $dataraw->image;
					} else {
						$file_data = $this->upload->data();
						$image = $file_data['file_name'];
					}
					$data = array(
						'image' => $image
					);
					$where = array('user_id' => $userId);
					$update = $this->Apimodel->update_cond('user_accounts', $where, $data);
					$path = base_url() . "assets/images/profile/" . $image;
					if ($update) {
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
	public function changePassword_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
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
		if ($this->form_validation->run() === false) {
			if (form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
			if (form_error('oldPassword')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('oldPassword'))
				], 400);
			}
			if (form_error('newPassword')) {
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
			if ($details) {
				if (base64_encode($userData['oldPassword']) != $details->user_pasword) {
					$this->response([
						'status' => "0",
						'error' => 'Old password is not matched!'
					], 400);
				}
				$data = array(
					'user_pasword' => base64_encode($userData['newPassword'])
				);
				$where = "user_id = $userId";
				$update = $this->Apimodel->update_cond('user_accounts', $where, $data);
				if ($update) {
					$this->response([
						'status' => "1",
						'userId' => $userId,
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
	public function categoryList_get() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_GET = (array) $obj;
			$userData = $_GET;
		}
		$list = $this->Apimodel->get_cond_all('category', "status='1'");
		if (!empty($list)) {
			foreach ($list as $cat) {
				$arr = array();
				$array[] = [
					'id' => $cat->id,
					'name' => @$cat->name,
				];
			}
			$array = $this->arrcheck($array);
			$this->response([
				'status' => "1",
				'list' => $array,
			], 200);
		} else {
			$this->response([
				'status' => "0",
				'error' => 'No Data found.'
			], 400);
		}
	}
	public function subcategoryList_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['categoryId'] = $this->post('categoryId');
		}
		$this->form_validation->set_rules('categoryId', 'categoryId', 'trim|required');
		if ($this->form_validation->run() === false) {
			if (form_error('categoryId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('categoryId'))
				], 400);
			}
		} else {
			$subcategory = $this->Apimodel->get_cond_all('listing_category', "status='1' and id='" . @$userData['categoryId'] . "'");
			if (!empty($subcategory)) {
				foreach ($subcategory as $sub) {
					$list = $this->Apimodel->get_cond_all('products', "status='1' and category='" . @$sub->catid . "'");
					$arr = array();
					$productList = array();
					if (!empty($list)) {
						foreach ($list as $key) {
							$productImage = $this->Apimodel->get_cond('product_images', "productId='" . @$key->productId . "'");
							if ($productImage->productImage != "") {
								$productImage = base_url() . 'assets/images/products/' . $productImage->productImage;
							} else {
								$productImage = '';
							}
							$productList[] = array(
								'productImage' => $productImage,
								'productId' => $key->productId,
								'productName' => $key->productName,
								'slug' => $key->slug,
							);
						}
					}
					$subcategoryList[] = [
						'subCategoryName' => $sub->name,
						'productList' => $productList,
					];
				}
				$subcategoryList = $this->arrcheck($subcategoryList);
				//$productList = $this->arrcheck($productList);
				$this->response([
					'status' => "1",
					'subcategoryList' => $subcategoryList,
					//'productList'=>$productList,
				], 200);
			} else {
				$this->response([
					'status' => "0",
					'error' => 'No Data found.'
				], 400);
			}
		}
	}
	public function addReview_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
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
		if ($this->form_validation->run() === false) {
			if (form_error('productId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('productId'))
				], 400);
			}
			if (form_error('rating')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('rating'))
				], 400);
			}
			if (form_error('name')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('name'))
				], 400);
			}
			if (form_error('subject')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('subject'))
				], 400);
			}
			if (form_error('message')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('message'))
				], 400);
			}
		} else {
			$mydata = array(
				'product_id' => $userData['productId'],
				'rating' => $userData['rating'],
				'name' => $userData['name'],
				'subject' => $userData['subject'],
				'message' => $userData['message'],
				'add_date' => date('Y-m-d H:i:s'),
			);
			$result = $this->Apimodel->add_details("product_review", $mydata);
			if ($result) {
				$array = [
					'status' => "1",
					'message' => 'Added review successfully!',
				];
				$array = $this->arrcheck($array);
				$this->response($array, 200);
			} else {
				$this->response([
					'status' => "0",
					'error' => "Some problems occurred, please try again.!"
				], 400);
			}
		}
	}
	public function addtoCart_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
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
		if ($this->form_validation->run() === false) {
			if (form_error('productId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('productId'))
				], 400);
			}
			if (form_error('qty')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('qty'))
				], 400);
			}
			if (form_error('productName')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('productName'))
				], 400);
			}
			if (form_error('price')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('price'))
				], 400);
			}
			if (form_error('image')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('image'))
				], 400);
			}
		} else {
			$data = array(
				'id' => $userData['productId'],
				'qty' => $userData['qty'],
				'name' => $userData['productName'],
				'price' => $userData['price'],
				'image' => $userData['image']
			);
			if ($this->cart->insert($data)) {
				$array = [
					'status' => "1",
					'message' => 'Added add to cart successfully!',
				];
				$array = $this->arrcheck($array);
				$this->response($array, 200);
			} else {
				$this->response([
					'status' => "0",
					'error' => "Some problems occurred, please try again.!"
				], 400);
			}
		}
	}
	public function cartList_post() {
		$json = file_get_contents('php://input');
		$obj = json_decode($json, true);
		if (is_array($obj)) {
			$_POST = (array) $obj;
			$userData = $_POST;
		} else {
			$userData['userId'] = $this->post('userId');
		}
		$this->form_validation->set_rules('userId', 'userId', 'trim|required');
		if ($this->form_validation->run() === false) {
			if (form_error('userId')) {
				$this->response([
					'status' => "0",
					'error' => strip_tags(form_error('userId'))
				], 400);
			}
		} else {
			$cartlist = $this->cart->contents();
			if (!empty($cartlist)) {
				foreach ($cartlist as $crt) {
					$subtotal += $crt["subtotal"];
					$grtotal = $subtotal;
					$shipchrge = $this->Apimodel->get_cond('products', "productId='" . $crt['id'] . "'");
					if (!empty($crt['image'])) {
						$productImage = base_url() . 'assets/images/products/' . $crt['image'];
					} else {
						$productImage = '';
					}
					$arr = array();
					$cartList[] = [
						'productImage' => $productImage,
						'productName' => $crt['name'],
						'price' => $crt['price'],
						'quantity' => $crt['qty'],
						'cartId' => $crt['rowid'],
						'subTotal' => $crt['subtotal'],
					];
				}
				$cartSummary = [
					'subTotal' => $subtotal,
					'discountTotal' => $subtotal,
					'grandTotal' => $grtotal,
				];
				$cartList = $this->arrcheck($cartList);
				$cartSummary = $this->arrcheck($cartSummary);
				$this->response([
					'status' => "1",
					'cartList' => $cartList,
					'cartSummary' => $cartSummary,
				], 200);
			} else {
				$this->response([
					'status' => "0",
					'error' => 'No Data found.'
				], 400);
			}
		}
	}
	public function generate_url_slug($string, $table, $field = 'link', $key = NULL, $value = NULL) {
		$t =& get_instance();
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array();
		$params[$field] = $slug;
		if ($key)
			$params["$key !="] = $value;
		while ($t->db->where($params)->get($table)->num_rows()) {
			if (!preg_match('/-{1}[0-9]+$/', $slug))
				$slug .= '-' . ++$i;
			else
				$slug = preg_replace('/[0-9]+$/', ++$i, $slug);
			$params[$field] = $slug;
		}
		return $slug;
	}
	public function generate_numbers($start, $count, $digits) {
		$result = array();
		for ($n = $start; $n < $start + $count; $n++) {
			$result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
		}
		return $result;
	}
	public function generate_otp($length) {
		$characters = '123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public function arrcheck($array) {
		array_walk_recursive($array, function (&$array, $key) {
			$array = (null === $array) ? '' : $array;
		});
		return $array;
	}
	public function hash($string) {
		return hash('sha512', $string . config_item('encryption_key'));
	}
	public function enc_password($password) {
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		return $encrypted_password;
	}
	/* 13th MAy 2023 Sayantan Bhakta */
	public function add_to_cart_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$checkCartData = $this->db->query("SELECT * FROM add_to_cart WHERE product_id = '" . $formdata['product_id'] . "' AND user_id = '" . $formdata['user_id'] . "'")->result_array();
			if (!empty($checkCartData)) {
				$data = array(
					'quantity' => $checkCartData[0]['quantity'] + 1
				);
				$this->db->insert('add_to_cart', $data, "product_id = '" . $formdata['product_id'] . "' AND user_id = '" . $formdata['user_id'] . "'");
				$checkuCartData = $this->db->query("SELECT * FROM add_to_cart WHERE product_id = '" . $formdata['product_id'] . "' AND user_id = '" . $formdata['user_id'] . "'")->result_array();
				$checkpData = $this->db->query("SELECT * FROM products WHERE productId = '" . $formdata['product_id'] . "' AND status = '1'")->result_array();
				$data1 = array(
					'mrp' => $checkuCartData[0]['quantity'] * $checkpData[0]['maxPrice'],
					'discount' => $checkuCartData[0]['quantity'] * ($checkpData[0]['maxPrice'] - $checkpData[0]['offprice']),
					'final_price' => $checkuCartData[0]['quantity'] * $checkpData[0]['offprice'],
				);
				$this->db->insert('add_to_cart', $data1, "product_id = '" . $formdata['product_id'] . "' AND user_id = '" . $formdata['user_id'] . "'");
				$response = array('status' => 'success', 'result' => 'Cart updated');
			} else {
				$productDetails = $this->db->query("SELECT * FROM products WHERE productId = '" . $formdata['product_id'] . "' AND status = '1'")->result_array();
				$data = array(
					'user_id' => @$formdata['user_id'],
					'product_id' => @$formdata['product_id'],
					'quantity' => @$formdata['quantity'],
					'mrp' => @$productDetails[0]['maxPrice'],
					'discount' => @$productDetails[0]['maxPrice'] - $productDetails[0]['offprice'],
					'final_price' => @$productDetails[0]['offprice'],
					'created_date' => date("Y-m-d H:i:s")
				);
				$this->db->insert('add_to_cart', $data);
				$response = array('status' => 'success', 'result' => 'Added to cart');
			}
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function cart_total_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$user_id = $formdata['user_id'];
			$totalCart = $this->db->query("SELECT COUNT(id) AS count FROM add_to_cart WHERE user_id = '" . $user_id . "'")->result_array();
			$response = array('status' => 'success', 'result' => $totalCart);
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function cart_list_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$user_id = $formdata['user_id'];
			$getProductDetails = $this->db->query("SELECT products.productId as prod_id, product_images.productImage, products.productName, category.name as cat_name, product_brand.brand_name, add_to_cart.id as cart_id, add_to_cart.mrp, add_to_cart.quantity, add_to_cart.final_price, add_to_cart.discount FROM products LEFT JOIN category ON products.category = category.id LEFT JOIN product_images ON product_images.productId = products.productId LEFT JOIN add_to_cart ON add_to_cart.product_id = products.productId LEFT JOIN product_brand ON product_brand.id = products.brand_name WHERE add_to_cart.user_id = '" . $user_id . "' GROUP BY products.productId")->result_array();
			if (!empty($getProductDetails)) {
				$getList['cartList'] = array();
				$saved['total_saved'] = array();
				$saved['total_amount'] = array();
				foreach ($getProductDetails as $key => $value) {
					$getList['cartList'][$key]['cart_id'] = $value['cart_id'];
					$getList['cartList'][$key]['prod_id'] = $value['prod_id'];
					if (!empty($value['productImage'])) {
						$getList['cartList'][$key]['pro_image'] = base_url() . 'assets/images/products/' . $value['productImage'];
					} else {
						$getList['cartList'][$key]['pro_image'] = base_url() . 'uploads/no_image.png';
					}
					$getList['cartList'][$key]['pro_name'] = $value['productImage'];
					$getList['cartList'][$key]['category_name'] = $value['cat_name'];
					$getList['cartList'][$key]['brand_name'] = $value['brand_name'];	
					$getList['cartList'][$key]['quantity'] = $value['quantity'];
					$getList['cartList'][$key]['final_price'] = sprintf("%0.2f", $value['final_price']);
					$getList['cartList'][$key]['actual_price'] = sprintf("%0.2f", $value['mrp']);
					$saved['total_amount'][$key] = sprintf("%0.2f", $value['final_price']);
					$saved['total_saved'][$key] = sprintf("%0.2f", ($value['mrp'] - $value['final_price']));
				}
				$ts = sizeof($saved['total_saved']);
				$ta = sizeof($saved['total_amount']);
				$total_saved = $this->sum($saved['total_saved'], $ts);
				$total_amount = $this->sum($saved['total_amount'], $ta);
				$actual_price = array('actual_price' => sprintf("%0.2f", $total_saved+$total_amount));
				$total_saved = array('total_saved' => sprintf("%0.2f", $total_saved));
				$total_amount = array('discounted_amount' => sprintf("%0.2f", $total_amount));
				$res = array_merge($getList, $actual_price, $total_saved, $total_amount);
				$response = array('status' => 'success', 'result' => $res);
			} else {
				$response = array('status' => 'error', 'result' => 'No data found');
			}
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	function sum($arr, $n) {
		$sum = 0;
		for ($i = 0; $i < $n; $i++) {
			$sum += $arr[$i];
		}
		return $sum;
	}
	public function update_cart_list_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$checkCartData = $this->db->query("SELECT * FROM add_to_cart WHERE product_id = '" . $formdata['product_id'] . "' AND user_id = '" . $formdata['user_id'] . "'")->result_array();
			$data = array(
				'quantity' => $checkCartData[0]['quantity'] + $formdata['quantity']
			);
			$this->Apimodel->SaveData('add_to_cart', $data, "product_id = '" . $formdata['product_id'] . "' AND user_id = '" . $formdata['user_id'] . "'");
			$checkuCartData = $this->db->query("SELECT * FROM add_to_cart WHERE product_id = '" . $formdata['product_id'] . "' AND user_id = '" . $formdata['user_id'] . "'")->result_array();
			$checkpData = $this->db->query("SELECT * FROM products WHERE productId = '" . $formdata['product_id'] . "' AND status = '1'")->result_array();
			$data1 = array(
				'mrp' => $checkuCartData[0]['quantity'] * $checkpData[0]['maxPrice'],
				'discount' => $checkuCartData[0]['quantity'] * ($checkpData[0]['maxPrice'] - $checkpData[0]['offprice']),
				'final_price' => $checkuCartData[0]['quantity'] * $checkpData[0]['offprice'],
			);
			$this->Apimodel->SaveData('add_to_cart', $data1, "product_id = '" . $formdata['product_id'] . "' AND user_id = '" . $formdata['user_id'] . "'");
			$response = array('status' => 'success', 'result' => 'Cart updated');
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function remove_cart_list_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$user_id = $formdata['user_id'];
			$product_id = $formdata['product_id'];
			$checkCartDate = $this->db->query("SELECT * FROM add_to_cart WHERE product_id = '" . $product_id . "' AND user_id = '" . $user_id . "'")->result_array();
			//print_r($checkCartDate); die;
			if (!empty($checkCartDate)) {
				$this->db->query("DELETE FROM add_to_cart WHERE product_id = '" . $product_id . "' AND user_id = '" . $user_id . "'");
				$response = array('status' => 'success', 'result' => 'Removed');
			} else {
				$response = array('status' => 'error', 'result' => 'No Data Found');
			}
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function userAddress_list_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$user_id = $formdata["user_id"];
			$getuseraddress = $this->db->query("SELECT * FROM user_address WHERE user_id = '" . $user_id . "'")->result_array();
			if (!empty($getuseraddress)) {
				$addressList = array();
				foreach ($getuseraddress as $key => $value) {
					if($value['shiptodifferadd'] == '1') {
						$addressList[$key]['billing_address']['id'] = $value['id'];
						$addressList[$key]['billing_address']['bfull_name'] = $value['bfull_name'];
						$addressList[$key]['billing_address']['bemail'] = $value['bemail'];
						$addressList[$key]['billing_address']['bphno'] = $value['bphno'];
						$addressList[$key]['billing_address']['baddress'] = $value['baddress'];
						$addressList[$key]['billing_address']['bcountry'] = $value['bcountry'];
						$addressList[$key]['billing_address']['bcity'] = $value['bcity'];
						$addressList[$key]['billing_address']['bstate'] = $value['bstate'];
						$addressList[$key]['billing_address']['bzip'] = $value['bzip'];
						$addressList[$key]['billing_address']['shiptodifferadd'] = $value['shiptodifferadd'];
						$addressList[$key]['shipping_address']['sfull_name'] = $value['sfull_name'];
						$addressList[$key]['shipping_address']['semail'] = $value['semail'];
						$addressList[$key]['shipping_address']['sphno'] = $value['sphno'];
						$addressList[$key]['shipping_address']['saddress'] = $value['saddress'];
						$addressList[$key]['shipping_address']['scountry'] = $value['scountry'];
						$addressList[$key]['shipping_address']['scity'] = $value['scity'];
						$addressList[$key]['shipping_address']['sstate'] = $value['sstate'];
						$addressList[$key]['shipping_address']['szip'] = $value['szip'];
					} else {
						$addressList[$key]['billing_address']['id'] = $value['id'];
						$addressList[$key]['billing_address']['bfull_name'] = $value['bfull_name'];
						$addressList[$key]['billing_address']['bemail'] = $value['bemail'];
						$addressList[$key]['billing_address']['bphno'] = $value['bphno'];
						$addressList[$key]['billing_address']['baddress'] = $value['baddress'];
						$addressList[$key]['billing_address']['bcountry'] = $value['bcountry'];
						$addressList[$key]['billing_address']['bcity'] = $value['bcity'];
						$addressList[$key]['billing_address']['bstate'] = $value['bstate'];
						$addressList[$key]['billing_address']['bzip'] = $value['bzip'];
						$addressList[$key]['billing_address']['shiptodifferadd'] = $value['shiptodifferadd'];
						$addressList[$key]['shipping_address']['sfull_name'] = $value['bfull_name'];
						$addressList[$key]['shipping_address']['semail'] = $value['bemail'];
						$addressList[$key]['shipping_address']['sphno'] = $value['bphno'];
						$addressList[$key]['shipping_address']['saddress'] = $value['baddress'];
						$addressList[$key]['shipping_address']['scountry'] = $value['bcountry'];
						$addressList[$key]['shipping_address']['scity'] = $value['bcity'];
						$addressList[$key]['shipping_address']['sstate'] = $value['bstate'];
						$addressList[$key]['shipping_address']['szip'] = $value['bzip'];
					}

				}
				$response = array('status' => 'success', 'result' => $addressList);
			} else {
				$response = array('status' => 'error', 'result' => 'No data found');
			}
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function add_address_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			if($formdata['shiptodifferadd'] == '1') {
				$data = array(
					'user_id' => $formdata['user_id'],
					'bfull_name' => $formdata['bfirst_name']." ".$formdata['blast_name'],
					'bemail' => $formdata['bemail'],
					'bphno' => $formdata['bphno'],
					'baddress' => $formdata['baddress'],
					'bcountry' => $formdata['bcountry'],
					'bcity' => $formdata['bcity'],
					'bstate' => $formdata['bstate'],
					'bzip' => $formdata['bzip'],
					'shiptodifferadd' => $formdata['shiptodifferadd'],
					'sfull_name' => $formdata['sfirst_name']." ".$formdata['slast_name'],
					'semail' => $formdata['semail'],
					'sphno' => $formdata['sphno'],
					'saddress' => $formdata['saddress'],
					'scountry' => $formdata['scountry'],
					'scity' => $formdata['scity'],
					'sstate' => $formdata['sstate'],
					'szip' => $formdata['szip'],
				);
			} else {
				$data = array(
					'user_id' => $formdata['user_id'],
					'bfull_name' => $formdata['bfirst_name']." ".$formdata['blast_name'],
					'bemail' => $formdata['bemail'],
					'bphno' => $formdata['bphno'],
					'baddress' => $formdata['baddress'],
					'bcountry' => $formdata['bcountry'],
					'bcity' => $formdata['bcity'],
					'bstate' => $formdata['bstate'],
					'bzip' => $formdata['bzip'],
					'shiptodifferadd' => $formdata['shiptodifferadd'],
					'sfull_name' => $formdata['bfirst_name']." ".$formdata['blast_name'],
					'semail' => $formdata['bemail'],
					'sphno' => $formdata['bphno'],
					'saddress' => $formdata['baddress'],
					'scountry' => $formdata['bcountry'],
					'scity' => $formdata['bcity'],
					'sstate' => $formdata['bstate'],
					'szip' => $formdata['bzip'],
				);
			}
			$this->Apimodel->SaveData('user_address', $data);
			$response = array('status' => 'success', 'result' => 'Address Added Successfuly');
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function edit_address_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$id = $formdata["id"];
			$editaddress = $this->db->query("SELECT * FROM user_address WHERE id = '" . $id . "'")->result_array();
			$response = array('status' => 'error', 'result' => $editaddress);
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function update_address_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			if($formdata['shiptodifferadd'] == '1') {
				$data = array(
					'bfull_name' => $formdata['bfirst_name']." ".$formdata['blast_name'],
					'bemail' => $formdata['bemail'],
					'bphno' => $formdata['bphno'],
					'baddress' => $formdata['baddress'],
					'bcountry' => $formdata['bcountry'],
					'bcity' => $formdata['bcity'],
					'bstate' => $formdata['bstate'],
					'bzip' => $formdata['bzip'],
					'shiptodifferadd' => $formdata['shiptodifferadd'],
					'sfull_name' => $formdata['sfirst_name']." ".$formdata['slast_name'],
					'semail' => $formdata['semail'],
					'sphno' => $formdata['sphno'],
					'saddress' => $formdata['saddress'],
					'scountry' => $formdata['scountry'],
					'scity' => $formdata['scity'],
					'sstate' => $formdata['sstate'],
					'szip' => $formdata['szip'],
				);
			} else {
				$data = array(
					'bfull_name' => $formdata['bfirst_name']." ".$formdata['blast_name'],
					'bemail' => $formdata['bemail'],
					'bphno' => $formdata['bphno'],
					'baddress' => $formdata['baddress'],
					'bcountry' => $formdata['bcountry'],
					'bcity' => $formdata['bcity'],
					'bstate' => $formdata['bstate'],
					'bzip' => $formdata['bzip'],
					'shiptodifferadd' => $formdata['shiptodifferadd'],
					'sfull_name' => $formdata['bfirst_name']." ".$formdata['blast_name'],
					'semail' => $formdata['bemail'],
					'sphno' => $formdata['bphno'],
					'saddress' => $formdata['baddress'],
					'scountry' => $formdata['bcountry'],
					'scity' => $formdata['bcity'],
					'sstate' => $formdata['bstate'],
					'szip' => $formdata['bzip'],
				);
			}
			$this->Apimodel->SaveData('user_address', $data, 'id = "' . $formdata['id'] . '"');
			$response = array('status' => 'success', 'result' => 'Address Updated Successfuly');
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function placeorder_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			if($formdata['chk_guest'] == '1') {
				//$user = 'guest_'.strtotime(date("d-m-y h:i:s"));
				$user = $formdata['bemail'];
			} else {
				$user = $formdata['user_id'];
			}
			$prid= $formdata['product_id'];
			if(count(array_filter($prid)) == 0) {
				$response = array('status' => 'error', 'result' => 'Please add product to cart');
			} else {
				$order_id = 'KETEKEPR'.uniqid().date('d-m-Y');
				$shipping_charge = $formdata['shipping_charge'];
				$price = $formdata['prd_price'];
				$prname = $formdata['prd_name'];
				$qty = $formdata['prd_quan'];
				$Payth = $formdata['payment_method'];
				if($formdata['shiptodifferadd'] == '1') {
					$data = array(
						'user_id' => $user,
						'bfull_name' => $formdata['bfirst_name']." ".$formdata['blast_name'],
						'bemail' => $formdata['bemail'],
						'bphno' => $formdata['bphno'],
						'baddress' => $formdata['baddress'],
						'bcountry' => $formdata['bcountry'],
						'bcity' => $formdata['bcity'],
						'bstate' => $formdata['bstate'],
						'bzip' => $formdata['bzip'],
						'shiptodifferadd' => $formdata['shiptodifferadd'],
						'sfull_name' => $formdata['sfirst_name']." ".$formdata['slast_name'],
						'semail' => $formdata['semail'],
						'sphno' => $formdata['sphno'],
						'saddress' => $formdata['saddress'],
						'scountry' => $formdata['scountry'],
						'scity' => $formdata['scity'],
						'sstate' => $formdata['sstate'],
						'szip' => $formdata['szip'],
					);
					$saddrd = array(
						'order_id'=>$order_id,
						'user_id'=>$user,
						'shipping_fname' => $formdata['sfirst_name'],
						'shipping_lname' => $formdata['slast_name'],
						'shipping_email' => $formdata['semail'],
						'shipping_phone' => $formdata['sphno'],
						'shipping_address' => $formdata['saddress'],
						'shipping_city' => $formdata['scity'],
						'shipping_state' => $formdata['sstate'],
						'shipping_country' => $formdata['scountry'],
						'shipping_zip' => $formdata['szip'],
						'created' => date('Y-m-d H:i:s')
					);
					$this->db->insert('customer_shipping_addrs', $saddrd);
					$shipping_addId = $this->db->insert_id();
					$baddrd = array(
						'order_id' => $order_id,
						'user_id' => $user,
						'billing_fname' => $formdata['bfirst_name'],
						'billing_lname' => $formdata['blast_name'],
						'billing_email' => $formdata['bemail'],
						'billing_phone' => $formdata['bphno'],
						'billing_address' => $formdata['baddress'],
						'billing_city' => $formdata['bcity'],
						'billing_state' => $formdata['bstate'],
						'billing_country' => $formdata['bcountry'],
						'billing_zip' => $formdata['bzip'],
						'created' => date('Y-m-d H:i:s')
					);
					$this->db->insert('customer_billing_addrs', $baddrd);
					$billing_addId = $this->db->insert_id();
				} else {
					$data = array(
						'user_id' => $user,
						'bfull_name' => $formdata['bfirst_name']." ".$formdata['blast_name'],
						'bemail' => $formdata['bemail'],
						'bphno' => $formdata['bphno'],
						'baddress' => $formdata['baddress'],
						'bcountry' => $formdata['bcountry'],
						'bcity' => $formdata['bcity'],
						'bstate' => $formdata['bstate'],
						'bzip' => $formdata['bzip'],
						'shiptodifferadd' => $formdata['shiptodifferadd'],
						'sfull_name' => $formdata['bfirst_name']." ".$formdata['blast_name'],
						'semail' => $formdata['bemail'],
						'sphno' => $formdata['bphno'],
						'saddress' => $formdata['baddress'],
						'scountry' => $formdata['bcountry'],
						'scity' => $formdata['bcity'],
						'sstate' => $formdata['bstate'],
						'szip' => $formdata['bzip'],
					);
					$baddrd = array(
						'order_id' => $order_id,
						'user_id' => $user,
						'billing_fname' => $formdata['bfirst_name'],
						'billing_lname' => $formdata['blast_name'],
						'billing_email' => $formdata['bemail'],
						'billing_phone' => $formdata['bphno'],
						'billing_address' => $formdata['baddress'],
						'billing_city' => $formdata['bcity'],
						'billing_state' => $formdata['bstate'],
						'billing_country' => $formdata['bcountry'],
						'billing_zip' => $formdata['bzip'],
						'created' => date('Y-m-d H:i:s')
					);
					$this->db->insert('customer_billing_addrs', $baddrd);
					$billing_addId = $this->db->insert_id();
				}
				$this->Apimodel->SaveData('user_address', $data);
				for($i = 0; $i < count($prid); $i++) {
					$ordersarray = array(
						'userid' => $user,
						'orderid' => $order_id,
						'product_id' => $prid[$i],
						'prd_title' => $prname[$i],
						'quantity' => $qty[$i],
						'amount' => $price[$i],
						'shipping_charge' => $shipping_charge,
						'billing_addr' => $billing_addId,
						'shipping_addr' => $shipping_addId,
						'payment_status' => 0,
						'pay_th' => $Payth
					);
					$query = $this->db->insert('productorders', $ordersarray);
				}
				if($query) {
					$paidprice = $formdata['total_paid_price'];
					$orderdetails = array(
						'bemail' => $bemail,
						'userid' => $user,
						'orderid' => $order_id,
						'gross_amount' => $paidprice
					);
					//$this->stripePayment($orderdetails);
				}
			}
			$response = array('status' => 'success', 'result' => 'Order placed successfully');
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function order_details_post() {
		try {
			$formdata = json_decode(file_get_contents('php://input'), true);
			$user_id = $formdata['user_id'];
			$order_data = $this->db->query("SELECT * FROM productorders WHERE userid = '".$user_id."'")->result_array();
			if(!empty($order_data)) {
				foreach ($order_data as $key => $value) {
					$order_data1[$key]['id'] = $value['id'];
					$order_data1[$key]['orderid'] = $value['orderid'];
					$order_data1[$key]['order_date'] = $value['order_date'];
					$order_data1[$key]['quantity'] = $value['quantity'];
					$order_data1[$key]['amount'] = $value['amount'];
					$order_data1[$key]['shipping_charge'] = $value['shipping_charge'];
					if(!empty($value['order_status'])) {
						$order_data1[$key]['order_status'] = $value['order_status'];
					} else {
						$order_data1[$key]['order_status'] = "Pending";
					}
				}
				$response = array('status' => 'success', 'result' => $order_data1);
			} else {
				$response = array('status' => 'error', 'result' => 'No data found');
			}
		} catch (\Throwable $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function filter_content_get(){
		try {
			$data = array();
			$getBrandName = $this->db->query("SELECT * FROM product_brand WHERE status = '1' AND is_delete = '1'")->result_array();
			if(!empty($getBrandName)) {
				foreach ($getBrandName as $key => $value) {
					$data['brand_name'][$key]['id'] = $value['id'];
					$data['brand_name'][$key]['brand_name'] = $value['brand_name'];
				}
				$response = array('status' => 'success', 'result' => $data);
			} else {
				$response = array('status' => 'error', 'result' => 'No data found');
			}

			$price_query = $this->db->query("SELECT MIN(maxPrice) AS min_price, MAX(maxPrice) AS max_price FROM products")->row();
			if(!empty($price_query)) {
				$data['price']['min_price'] = @$price_query->min_price;
				$data['price']['max_price'] = @$price_query->max_price;
				$response = array('status' => 'success', 'result' => $data);
			} else {
				$response = array('status' => 'error', 'result' => 'No data found');
			}
		} catch (Exception $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
	public function filter_product_post() {
		try {
			$form_data = json_decode(file_get_contents('php://input'), true);
			$brand_name = $form_data['brand_name'];
			$from_price = $form_data['from_price'];
			$to_price = $form_data['to_price'];
			$rating = $form_data['rating'];

			if(!empty(@$brand_name) || !empty(@$from_price) || !empty(@$rating)) {
				$query = "SELECT * FROM products WHERE status = '1'";
				if(isset($brand_name) && !empty($brand_name)) {
	                $query .= " AND brand_name = '".@$brand_name."'";
	            }
	            if(isset($from_price) && !empty($from_price)) {
	                $query .= " AND maxPrice BETWEEN '".$from_price."' and '".$to_price."'";
	            }
	            if(isset($rating) && !empty($rating)) {
	            	$productRated = $this->db->query("SELECT group_concat(product_id) AS product_id FROM product_review WHERE rating = '".@$rating."'")->row();
	                $query .= " AND productId IN (".@$productRated->product_id.")";
	            }
	            $result = $this->db->query($query)->result_array();
	            if(!empty($result)) {
	            	foreach ($result as $key => $value) {
						$primgs = $this->Apimodel->get_cond('product_images', 'productId="' . @$value['productId'] . '"');
						if (!empty($primgs->productImage)) {
							$productImage = base_url() . 'assets/images/products/' . $primgs->productImage;
						} else {
							$productImage = '';
						}

						$avg_rating = $this->Apimodel->fetch_single_join("SELECT AVG(rating) AS rate from product_review WHERE product_id='" . $value['productId'] . "'");
						if (!empty($avg_rating->rate)) {
							for ($i = 0; $i < $avg_rating->rate; $i++) {
								$rating = ' <i class="ion-android-star active"></i>';
							}
						} else {
							$rating = ' <i class="ion-android-star"></i>';
						}
						$resultData[$key]['productId'] = @$value['productId'];
						$resultData[$key]['productImage'] = @$productImage;
						$resultData[$key]['productName'] = @$value['productName'];
						$resultData[$key]['offprice'] = @$value['offprice'];
						$resultData[$key]['maxPrice'] = @$value['maxPrice'];
						$resultData[$key]['slug'] = @$value['slug'];
						$resultData[$key]['rating'] = @$rating;
					}
					$response = array('status' => 'success', 'result' => $resultData);
	            } else {
	            	$response = array('status' => 'error', 'result' => 'No data found');
	            }
			}
		} catch (Exception $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
}