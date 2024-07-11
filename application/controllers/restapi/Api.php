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
            $stringLength = strlen($userData['keyword']);
            if($stringLength > 3) {
                $userData['keyword'] = substr($userData['keyword'], 0, 3);
            } else {
                $userData['keyword'] = $userData['keyword'];
            }
			if ($userData['keyword'] != "") {
                $searchdata = $this->db->query('SELECT * FROM products AS pd JOIN mrkt_category AS mk ON mk.id=pd.category WHERE (pd.productName LIKE "%'.$userData['keyword'].'%" OR pd.tags LIKE "%'.$userData['keyword'].'%")')->result();
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
    public function tabWisefilterproduct_post() {
		try {
			$form_data = json_decode(file_get_contents('php://input'), true);
			$tab_name = $form_data['tab_name'];
            $query = "SELECT * FROM products WHERE status = '1'";
            if($tab_name == "newest") {
                $query .= " ORDER BY productId DESC";
            } else if($tab_name == "popular") {
                $query .= " ORDER BY RAND()";
            } else {
                $query .= " ORDER BY productId ASC";
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
		} catch (Exception $th) {
			$response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
	}
    public function business_home_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $lat = $formdata['lati'];
            $lon = $formdata['longi'];
            $categoryList = $this->db->query("SELECT * FROM category WHERE `status` = '1'")->result_array();
            if(!empty($categoryList)) {
                $resultData = array();
                foreach ($categoryList as $key => $cat) {
                    $resultData[$key]['categoryId'] = @$cat['id'];
                    $resultData[$key]['categoryName'] = @$cat['name'];
                }
                $resultcat = $resultData;
            } else {
                $resultcat = "";
            }
            $data['category_list'] = $resultcat;

            $coupons = $this->db->query("SELECT * FROM coupon_details WHERE coupon_status = '1' LIMIT 6")->result_array();
            if(!empty($coupons)) {
                foreach ($coupons as $key => $coup) {
                    if(!empty($coup['coupon_img']) && file_exists('assets/images/coupons/'.$coup['coupon_img'])) {
                        $coupons[$key]['images'] = base_url().'assets/images/coupons/'.$coup['coupan_img'];
                    } else {
                        $coupons[$key]['images'] = base_url().'assets/images/no-image.png';
                    }
                }
                $resultcoup = $coupons;
            } else {
                $resultcoup = "";
            }
            $data['coupons'] = $resultcoup;

            $searchSql = "SELECT *, (6367 * acos( cos(radians('".$lat."')) * cos(radians(lati)) * cos(radians(longi) - radians('".$lon."')) + sin( radians('".$lat."')) * sin(radians(`lati`)))) AS distance FROM listing having distance < 500  AND (status = '1' OR prefer_list = '1' ) ORDER BY  distance ASC LIMIT 3";
            $chlist = $this->db->query($searchSql)->result_array();
            if(!empty($chlist)) {
                foreach ($chlist as $key => $list) {
                    if(!empty($list['images']) && file_exists('assets/images/directory/'.$list['images'])) {
                        $chlist[$key]['images'] = base_url().'assets/images/directory/'.$list['images'];
                    } else {
                        $chlist[$key]['images'] = base_url().'assets/images/no-image.png';
                    }
                }
                $resultlist = $chlist;
            } else {
                $resultlist = "";
            }
            $data['listing'] = $resultlist;
            $response = array('status' => 'success', 'result' => $data);
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage);
        }
        echo json_encode($response);
    }
    public function classification_get(){
        try {
            $categoryList = $this->db->query("SELECT * FROM category WHERE status = '1'")->result_array();
            if(!empty($categoryList)) {
                $resultData = array();
                foreach ($categoryList as $key => $value) {
                    $resultData[$key]['categoryId'] = @$value['id'];
                    $resultData[$key]['categoryName'] = @$value['name'];
                }
                $response = array('status' => 'success', 'result' => $resultData);
            } else {
                $response = array('status' => 'error', 'result' => 'No data found');
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage);
        }
        echo json_encode($response);
    }
    public function classification_sub_post(){
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $getsubcatList = $this->db->query("SELECT * FROM listing_category WHERE catid = '".$formdata['category_id']."' AND status = '1'")->result_array();
            if(!empty($getsubcatList)) {
                $resultData = array();
                foreach ($getsubcatList as $key => $value) {
                    $resultData[$key]['subcategoryId'] = @$value['id'];
                    $resultData[$key]['subcategoryName'] = @$value['name'];
                }
                $response = array('status' => 'success', 'result' => $resultData);
            } else {
                $response = array('status' => 'error', 'result' => 'No data found');
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage);
        }
        echo json_encode($response);
    }
    public function addbusinesstolist_post() {
        try{
            $data = array(
                'userid' => $this->input->post('user_id'),
                'title' => $this->input->post('business_name'),
                'busi_classi' => $this->input->post('classification'),
                'other_classi' => $this->input->post('other_classi'),
                'keywords' => $this->input->post('keywords'),
                'category' => $this->input->post('category'),
                'subcategory' => $this->input->post('subcategory'),
                'street_addr' => $this->input->post('street_address'),
                'lati' => $this->input->post('lati'),
                'longi' => $this->input->post('longi'),
                'city' => $this->input->post('business_city'),
                'country' => $this->input->post('business_country'),
                'website' => $this->input->post('website_url'),
                'email' => $this->input->post('company_email'),
                'phone' => $this->input->post('company_phno'),
                'fblink' => $this->input->post('facebook_link'),
                'twlink' => $this->input->post('twitter_link'),
                'status' => '1',
                'created' => date("Y-m-d H:i:s"),
            );
            $this->db->insert('listing', $data);
            $insert_id = $this->db->insert_id();
            if(!empty($insert_id)) {
                if ($_FILES['images']['name'] != '') {
                    $src = $_FILES['images']['tmp_name'];
                    $filEnc = time();
                    $avatar = rand(0000, 9999) . "_" . $_FILES['images']['name'];
                    $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
                    $dest = getcwd() . '/assets/images/directory/' . $avatar1;
                    if (move_uploaded_file($src, $dest)) {
                        $file1  = $avatar1;
                    }
                    $uploadData = array(
                        'images'=> $file1
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('listing', $uploadData);
                }
            }
            $response = array('status' => 'success', 'result' => 'Business added successfully');
		} catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function editbusinesstolist_post() {
		try{
			$formdata = json_decode(file_get_contents('php://input'), true);
			$business_data = $this->db->query("SELECT * FROM listing WHERE id = '".$formdata['business_id']."'")->row();
			if(!empty($business_data->images) && file_exists('assets/images/directory/'.$business_data->images)) {
				$business_data->images = base_url().'assets/images/directory/'.$business_data->images;
			} else {
                $business_data->images = base_url().'assets/images/no-image.png';
            }
			$response = array('status'=> 'success', 'result'=> $business_data);
		} catch(\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}
    public function updatebusinesstolist_post() {
        try{
            $data = array(
                'title' => $this->input->post('business_name'),
                'busi_classi' => $this->input->post('classification'),
                'other_classi' => $this->input->post('other_classi'),
                'keywords' => $this->input->post('keywords'),
                'category' => $this->input->post('category'),
                'subcategory' => $this->input->post('subcategory'),
                'street_addr' => $this->input->post('street_address'),
                'lati' => $this->input->post('lati'),
                'longi' => $this->input->post('longi'),
                'city' => $this->input->post('business_city'),
                'country' => $this->input->post('business_country'),
                'website' => $this->input->post('website_url'),
                'email' => $this->input->post('company_email'),
                'phone' => $this->input->post('company_phno'),
                'fblink' => $this->input->post('facebook_link'),
                'twlink' => $this->input->post('twitter_link'),
                'status' => '1',
                'created' => date("Y-m-d H:i:s"),
            );
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('listing', $data);
            $insert_id = $this->db->insert_id();
            if ($_FILES['images']['name'] != '') {
                $src = $_FILES['images']['tmp_name'];
                $filEnc = time();
                $avatar = rand(0000, 9999) . "_" . $_FILES['images']['name'];
                $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
                $dest = getcwd() . '/assets/images/directory/' . $avatar1;
                if (move_uploaded_file($src, $dest)) {
                    $file1  = $avatar1;
                }
                $uploadData = array('images'=> $file1);
                $this->db->where('id', $insert_id);
                $this->db->update('listing', $uploadData);
            } else {
                $uploadData = array('images' => $this->input->post('images'));
                $this->db->where('id', $insert_id);
                $this->db->update('listing', $uploadData);
            }
            $response = array('status' => 'success', 'result' => 'Business updated successfully');
		} catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function business_list_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            if(!empty($formdata['user_id'])) {
                $businessList = $this->db->query("SELECT * FROM listing WHERE userid = '".$formdata['user_id']."' AND status = '1'")->result_array();
            } else {
                $businessList = $this->db->query("SELECT * FROM listing WHERE status = '1'")->result_array();
            }
            if(!empty($businessList)) {
                $business_list = array();
                foreach ($businessList as $key => $value) {
                    $business_list[$key]['businessId'] = $value['id'];
                    $category = $this->db->query("SELECT * FROM category WHERE id = '".$value['category']."'")->row();
                    $business_list[$key]['businessType'] = $category->name;
                    $business_list[$key]['businessName'] = $value['title'];
                    $business_list[$key]['businessAddress'] = $value['street_addr'];
                    $business_list[$key]['businessPhone'] = $value['phone'];
                    $business_list[$key]['businessEmail'] = $value['email'];
                    if(!empty($value['images']) && file_exists('assets/images/directory/'.$value['images'])) {
                        $business_list[$key]['businessImage'] = base_url().'assets/images/directory/'.$value['images'];
                    } else {
                        $business_list[$key]['businessImage'] = base_url() . 'assets/images/no-image.png';
                    }
                    $businessratingCount = $this->db->query("SELECT COUNT(id) as count FROM user_listreview WHERE business_id = '".$value['id']."'")->row();
                    $business_list[$key]['businessRatingCount'] = $value['rating']." (".$businessratingCount->count.")";
                }
                $response = array('status' => 'success', 'result' => $business_list);
            } else {
                $response = array('status'=> 'error', 'result'=> 'No business found');
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function filter_business_list_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            if($formdata['keyword'] == 'a-z') {
                $businessList = $this->db->query("SELECT * FROM listing WHERE status = '1' ORDER BY title ASC")->result_array();
            } else if($formdata['keyword'] == 'rating') {
                $businessList = $this->db->query("SELECT * FROM listing WHERE status = '1' ORDER BY rating DESC")->result_array();
            } else {
                $businessList = $this->db->query("SELECT * FROM listing WHERE status = '1' ORDER BY id DESC")->result_array();
            }
            if(!empty($businessList)) {
                $business_list = array();
                foreach ($businessList as $key => $value) {
                    $business_list[$key]['businessId'] = $value['id'];
                    $category = $this->db->query("SELECT * FROM category WHERE id = '".$value['category']."'")->row();
                    $business_list[$key]['businessType'] = $category->name;
                    $business_list[$key]['businessName'] = $value['title'];
                    $business_list[$key]['businessAddress'] = $value['street_addr'];
                    $business_list[$key]['businessPhone'] = $value['phone'];
                    $business_list[$key]['businessEmail'] = $value['email'];
                    if(!empty($value['images']) && file_exists('assets/images/directory/'.$value['images'])) {
                        $business_list[$key]['businessImage'] = base_url().'assets/images/directory/'.$value['images'];
                    } else {
                        $business_list[$key]['businessImage'] = base_url() . 'assets/images/no-image.png';
                    }
                    $businessratingCount = $this->db->query("SELECT COUNT(id) as count FROM user_listreview WHERE business_id = '".$value['id']."'")->row();
                    $business_list[$key]['businessRatingCount'] = $value['rating']." (".$businessratingCount->count.")";
                }
                $response = array('status' => 'success', 'result' => $business_list);
            } else {
                $response = array('status'=> 'error', 'result'=> 'No business found');
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function search_business_list_post() {
       try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $business_List = $this->db->query("SELECT * FROM listing WHERE title LIKE '%".$formdata['keyword']."%' AND status = '1' ORDER BY id DESC")->result_array();
            if(!empty($business_List)) {
                $businesslist = array();
                foreach ($business_List as $key => $roww) {
                    $businesslist[$key]['businessId'] = $roww['id'];
                    $businesslist[$key]['businessName'] = $roww['title'];
                    $businesslist[$key]['businessAddress'] = $roww['street_addr'];
                }
                $response = array('status' => 'success', 'result' => $businesslist);
            } else {
                $response = array('status'=> 'error', 'result'=> 'No business found');
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function addbusinessreview_post() {
        try {
            $form_data = json_decode(file_get_contents('php://input'), true);
            $arrreview = array(
                'user_id' => $form_data['user_id'],
                'business_id' => $form_data['business_id'],
                'username' => $form_data['fullname'],
                'subject' => $form_data['subject'],
                'comments' => $form_data['comment'],
                'rating' => $form_data['rating'],
                'added_date' => date('Y-m-d H:i:s')
            );
            $rvinsert = $this->db->insert('user_listreview', $arrreview);
            if ($rvinsert == TRUE) {
                $getquery = $this->db->query("SELECT AVG(rating) as avg_rating FROM user_listreview WHERE business_id = '".$form_data['business_id']."'")->row();
                $this->db->query("UPDATE listing SET rating = '".round($getquery->avg_rating, 1)."' WHERE id = '".$form_data['business_id']."'");
                $response = array('status' => 'success', 'result' => "Successfully Reviwed");
            } else {
                $response = array('status'=> 'error', 'result'=> 'Something went wrong. Please try again later.');
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function get_business_review_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $business_ratingList = $this->db->query("SELECT * FROM user_listreview WHERE business_id = '".$formdata['business_id']."'")->result_array();
            if(!empty($business_ratingList)) {
                $business_review = array();
                foreach ($business_ratingList as $key => $business) {
                    $business_review['business_review'][$key]['businessId'] = $business['business_id'];
                    $business_review['business_review'][$key]['username'] = $business['username'];
                    $business_review['business_review'][$key]['subject'] = $business['subject'];
                    $business_review['business_review'][$key]['comments'] = $business['comments'];
                    $business_review['business_review'][$key]['rating'] = $business['rating'];
                    $business_review['business_review'][$key]['added_date'] = $business['added_date'];
                }
                $sumofRating5 = $this->db->query("SELECT COUNT(id) as sum FROM user_listreview WHERE business_id ='".$formdata['business_id']."' AND rating = '5'")->row();
                $countofadence5 = $this->db->query("SELECT COUNT(id) as total FROM user_listreview WHERE business_id ='".$formdata['business_id']."'")->row();
                if(empty($countofadence5->total)) {
                    $val5 = "0";
                } else {
                    $val5 = ($sumofRating5->sum/$countofadence5->total)*100;
                }
                $sumofRating4 = $this->db->query("SELECT COUNT(id) as sum FROM user_listreview WHERE business_id ='".$formdata['business_id']."' AND rating = '4'")->row();
                $countofadence4 = $this->db->query("SELECT COUNT(id) as total FROM user_listreview WHERE business_id ='".$formdata['business_id']."'")->row();
                if(empty($countofadence4->total)) {
                    $val4 = "0";
                } else {
                    $val4 = ($sumofRating4->sum/$countofadence4->total)*100;
                }
                $sumofRating3 = $this->db->query("SELECT COUNT(id) as sum FROM user_listreview WHERE business_id ='".$formdata['business_id']."' AND rating = '3'")->row();
                $countofadence3 = $this->db->query("SELECT COUNT(id) as total FROM user_listreview WHERE business_id ='".$formdata['business_id']."'")->row();
                if(empty($countofadence3->total)) {
                    $val3 = "0";
                } else {
                    $val3 = ($sumofRating3->sum/$countofadence3->total)*100;
                }
                $sumofRating2 = $this->db->query("SELECT COUNT(id) as sum FROM user_listreview WHERE business_id ='".$formdata['business_id']."' AND rating = '2'")->row();
                $countofadence2 = $this->db->query("SELECT COUNT(id) as total FROM user_listreview WHERE business_id ='".$formdata['business_id']."'")->row();
                if(empty($countofadence2->total)) {
                    $val2 = "0";
                } else {
                    $val2 = ($sumofRating2->sum/$countofadence2->total)*100;
                }
                $sumofRating1 = $this->db->query("SELECT COUNT(id) as sum FROM user_listreview WHERE business_id ='".$formdata['business_id']."' AND rating = '1'")->row();
                $countofadence1 = $this->db->query("SELECT COUNT(id) as total FROM user_listreview WHERE business_id ='".$formdata['business_id']."'")->row();
                if(empty($countofadence1->total)) {
                    $val1 = "0";
                } else {
                    $val1 = ($sumofRating1->sum/$countofadence1->total)*100;
                }
                $business_review['business_rating'] = array('5' => round($val5, 1), '4' => round($val4, 1), '3' => round($val3, 1), '2' => round($val2, 1), '1' => round($val1, 1));
                $response = array('status' => 'success', 'result' => $business_review);
            } else {
                $response = array('status'=> 'error', 'result'=> 'No business found');
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function filter_business_review_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            if($formdata['keyword'] == 'newest') {
                $business_ratingList = $this->db->query("SELECT * FROM user_listreview WHERE business_id = '".$formdata['business_id']."' ORDER BY id DESC")->result_array();
            } else if($formdata['keyword'] == 'highest') {
                $business_ratingList = $this->db->query("SELECT * FROM user_listreview WHERE business_id = '".$formdata['business_id']."' ORDER BY rating DESC")->result_array();
            } else {
                $business_ratingList = $this->db->query("SELECT * FROM user_listreview WHERE business_id = '".$formdata['business_id']."' ORDER BY rating ASC")->result_array();
            }
            if(!empty($business_ratingList)) {
                $business_review = array();
                foreach ($business_ratingList as $key => $business) {
                    $business_review['business_review'][$key]['businessId'] = $business['business_id'];
                    $business_review['business_review'][$key]['username'] = $business['username'];
                    $business_review['business_review'][$key]['subject'] = $business['subject'];
                    $business_review['business_review'][$key]['comments'] = $business['comments'];
                    $business_review['business_review'][$key]['rating'] = $business['rating'];
                    $business_review['business_review'][$key]['added_date'] = $business['added_date'];
                }
                $response = array('status' => 'success', 'result' => $business_review);
            } else {
                $response = array('status'=> 'error', 'result'=> 'No business found');
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function addbusinesscomment_post() {
        try {
            $form_data = json_decode(file_get_contents('php://input'), true);
            $arrremessage = array(
                'userid' => $form_data['user_id'],
                'business_id' => $form_data['business_id'],
                'fname' => $form_data['fullname'],
                'email' => $form_data['email'],
                'mobile' => $form_data['phone'],
                'descr' => $form_data['message'],
                'created_at' => date('Y-m-d H:i:s')
            );
            $rvinsert = $this->db->insert('business_message', $arrremessage);
            if ($rvinsert == TRUE) {
                $response = array('status' => 'success', 'result' => "Thank you for your message. We will get back to you soon.");
            } else {
                $response = array('status'=> 'error', 'result'=> 'Something went wrong. Please try again later.');
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function add_customer_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $created_by = $formdata['created_by'];
            $user_fname = $formdata['user_fname'];
            $user_lname = $formdata['user_lname'];
            $user_emailid = $formdata['user_emailid'];
            $user_pasword = $formdata['user_pasword'];
            $user_status = $formdata['user_status'];
            $u_type = $formdata['u_type'];
            $checkEmail = $this->db->query("SELECT * FROM user_accounts WHERE user_emailid = '".$user_emailid."'")->result();
            if(!empty($checkEmail)) {
                $response = array('status' => 'error', 'result' => 'Email already exists');
            } else {
                $arrremessage = array(
                    'created_by' => $created_by,
                    'user_fname' => $user_fname,
                    'user_lname' => $user_lname,
                    'user_emailid' => $user_emailid,
                    'user_pasword' => base64_encode($user_pasword),
                    'user_status' => '1',
                    'u_type' => '4',
                    'created_at' => date('Y-m-d H:i:s')
                );
                $rvinsert = $this->db->insert('user_accounts', $arrremessage);
                if ($rvinsert == TRUE) {
                    $response = array('status' => "success", 'result' => "User added successfully");
                } else {
                    $response = array('status'=> "error", 'result'=> "Something went wrong. Please try again later");
                }
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function customer_list_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $user_id = $formdata['user_id'];
            $customer_list = $this->db->query("SELECT * FROM user_accounts WHERE created_by = '".$user_id."'")->result_array();
            if(!empty($customer_list)) {
                $customerList = [];
                foreach ($customer_list as $key => $list) {
                    $customerList[$key]['user_id'] = $list['user_id'];
                    $customerList[$key]['user_fname'] = $list['user_fname'];
                    $customerList[$key]['user_lname'] = $list['user_lname'];
                    $customerList[$key]['user_emailid'] = $list['user_emailid'];
                    $customerList[$key]['user_pasword'] = $list['user_pasword'];
                    $customerList[$key]['u_type'] = $list['u_type'];
                    $customerList[$key]['messageType'] = $list['messageType'];
                    if(!empty($list['image']) && file_exists('assets/images/profile/'.$list['image'])) {
                        $customerList[$key]['profileimage'] = base_url('assets/images/profile/'.$list['image']);
                    } else {
                        $customerList[$key]['profileimage'] = base_url('assets/images/profile/user-icon.png');
                    }
                    $customerList[$key]['created_at'] = $list['created_at'];
                }
                $response = array('status' => 'success', 'result' => $customerList);
            } else {
                $response = array('status' => 'error', 'result' => 'No data found');
            }
        } catch (\Throwable $th){
            $response = array('status' => 'error', 'result' => $th->getMessage());
		}
		echo json_encode($response);
    }
    public function edit_customer_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $customer_id = $formdata['customer_id'];
            $getCustomerDetails = $this->db->query("SELECT * FROM user_accounts WHERE user_id = '".$customer_id."' AND user_status = '1'")->result();
            //print_r($getCustomerDetails); die();
            if(!empty($getCustomerDetails)) {
                $CustomerDetails = [];
                foreach ($getCustomerDetails as $record) {
                    $CustomerDetails['user_id'] = $record->user_id;
                    $CustomerDetails['user_fname'] = $record->user_fname;
                    $CustomerDetails['user_lname'] = $record->user_lname;
                    $CustomerDetails['user_emailid'] = $record->user_emailid;
                    $CustomerDetails['user_pasword'] = base64_decode($record->user_pasword);
                }
                $response = array('status' => 'success', 'result' => $CustomerDetails);
            } else {
                $response = array('status' => 'error', 'result' => 'Something went wrong! Please try again later');
            }
        } catch (\Throwable $th) {
            $response = array('status'=> 'error', 'result'=> $th->getMessage());
        }
        echo json_encode($response);
    }
    public function update_customer_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $updateData = array(
                'user_fname' => $formdata['user_fname'],
                'user_lname' => $formdata['user_lname'],
                'user_emailid' => $formdata['user_emailid'],
                'user_pasword' => base64_encode($formdata['user_pasword']),
            );
            $checkEmail = $this->db->query("SELECT * FROM user_accounts WHERE user_emailid = '".$formdata['user_emailid']."' AND user_id != '".$formdata['user_id']."'")->row();
            if(!empty($checkEmail)) {
                $response = array('status' => 'success', 'result' => 'Email already exist');
            } else {
                $this->db->where('user_id', $formdata['user_id']);
                $this->db->update('user_accounts', $updateData);
                $response = array('status' => 'success', 'result' => 'Customer updated successfully');
            }
        } catch(\Throwable $th) {
            $response = array('status'=> 'error', 'result'=> $th->getMessage());
        }
        echo json_encode($response);
    }
    public function delete_customer_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $this->db->where('user_id', $formdata['user_id']);
            $this->db->delete('user_accounts');
            $response = array('status' => 'success', 'result' => 'Customer deleted successfully');
        } catch(\Throwable $th) {
            $response = array('status'=> 'error', 'result'=> $th->getMessage());
        }
        echo json_encode($response);
    }
    public function product_category_get() {
        try {
            $category = $this->db->get_where('mrkt_category', array('status' => 1))->result_array();
            if(!empty($category)) {
                $categoryList = [];
                foreach ($category as $key => $cat) {
                    $categoryList[$key]['id'] = $cat['id'];
                    $categoryList[$key]['name'] = $cat['name'];
                }
                $response = array('status' => 'success', 'result' => $categoryList);
            } else {
                $response = array('status' => 'error', 'result' => 'No category found');
            }
        } catch (\Throwable $th) {
            $response = array('status'=> 'error', 'result'=> $th->getMessage());
        }
        echo json_encode($response);
    }
    public function product_subcategory_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $subcategory = $this->db->get_where('marketplace_submenu', array('cat_id'=> $formdata['cat_id'], 'status' => 1))->result_array();
            if(!empty($subcategory)) {
                $subcategoryList = [];
                foreach ($subcategory as $key => $subcat) {
                    $subcategoryList[$key]['id'] = $subcat['submenuId'];
                    $subcategoryList[$key]['name'] = $subcat['name'];
                }
                $response = array('status' => 'success', 'result' => $subcategoryList);
            } else {
                $response = array('status' => 'error', 'result' => 'No subcategory found');
            }
        } catch (\Throwable $th) {
            $response = array('status'=> 'error', 'result'=> $th->getMessage());
        }
        echo json_encode($response);
    }
    public function add_product_post() {
        try{
            $slug = $this->input->post('productName');
            if (empty($slug) || $slug == '') {
                $slug = $this->input->post('productName');
            }
            $slug = strtolower(url_title($slug));
            $slug_url = $this->Cms_model->get_unique_url($slug, $id);
            $data = array(
                'userid' => $this->input->post('user_id'),
                'category' => $this->input->post('category'),
                'prsubmenuId' => $this->input->post('prsubmenuId'),
                'productName' => $this->input->post('productName'),
                'prcode' => $this->input->post('prcode'),
                'product_type' => $this->input->post('product_type'),
                'brand_name' => $this->input->post('brand_name'),
                'maxPrice' => $this->input->post('maxPrice'),
                'disc_percent' => $this->input->post('disc_percent'),
                'sku' => $this->input->post('sku'),
                'inventory' => $this->input->post('inventory'),
                'collections' => $this->input->post('collections'),
                'tags' => $this->input->post('tags'),
                'shipping_info' => $this->input->post('shipping_info'),
                'slug' => $slug_url,
                'description' => $this->input->post('description'),
                'shipping_charge' => $this->input->post('shipping_charge'),
                'variants' => $this->input->post('variants'),
                'seo_title' => $this->input->post('seo_title'),
                'seo_descr' => $this->input->post('seo_descr'),
                'return_day' => $this->input->post('return_day'),
                'prefer_list' => '1',
                'status' => '1',
                'created' => date("Y-m-d H:i:s"),
            );
            $this->db->insert('products', $data);
            $insert_id = $this->db->insert_id();
            if(!empty($insert_id)) {
                if (!empty($_FILES['prod_image']['size'])) {
                    $filesCount = count($_FILES['prod_image']['name']);
					for($i=0; $i < $filesCount; $i++) {
                        $src = $_FILES['prod_image']['tmp_name'][$i];
                        $filEnc = time();
                        $avatar = rand(0000, 9999) . "_" . $_FILES['prod_image']['name'][$i];
                        $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
                        $dest = getcwd() . '/assets/images/products/' . $avatar1;
                        if (move_uploaded_file($src, $dest)) {
                            $file1 = $avatar1;
                        }
                        if(!empty($file1)) {
                            $pfile = $file1;
                        } else {
                            $pfile = "";
                        }
                        $uploadData = array(
                            'productImage' => $pfile,
                            'productId' => $insert_id
                        );
                        $insert = $this->db->insert('product_images', $uploadData);
                    }
                }
                $response = array('status' => 'success', 'result' => 'Product added successfully');
            } else {
                $response = array('status' => 'error', 'result' => 'Something went wrong. Please try again later');
            }
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
        }
        echo json_encode($response);
    }
    public function product_list_post() {
        try{
			$formdata = json_decode(file_get_contents('php://input'), true);
			$user_id = $formdata['user_id'];
			$product_list = $this->db->query("SELECT * FROM products WHERE userid = '".$user_id."' AND status = 1")->result_array();
			if(!empty($product_list)) {
				$productList = array();
				foreach ($product_list as $key => $list) {
					$productList[$key]['product_id'] = $list['productId'];
					$productList[$key]['user_id'] = $list['userid'];
					$productList[$key]['prod_name'] = $list['productName'];
					$productList[$key]['created'] = $list['created'];
                    if($list['status'] == '1') {
                        $productList[$key]['status'] = 'Active';
                    } else {
                        $productList[$key]['status'] = 'Inactive';
                    }
				}
				$response = array('status'=> 'success', 'result'=> $productList);
			} else {
				$response = array('status'=> 'error', 'result'=> 'No data found');
			}
		} catch(\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
    }
    public function edit_product_post() {
		try{
			$formdata = json_decode(file_get_contents('php://input'), true);
			$prod_id = $formdata['prod_id'];
			$product_data = $this->db->query("SELECT * FROM products WHERE productId = '".$prod_id."' AND status = 1")->result();
			if(!empty($product_data)) {
				$productData = array();
				foreach ($product_data as $key => $data) {
					$productData[$key]['productId'] = $data->productId;
                    $productData[$key]['category'] = $data->category;
                    $productData[$key]['prsubmenuId'] = $data->prsubmenuId;
                    $productData[$key]['productName'] = $data->productName;
                    $productData[$key]['prcode'] = $data->prcode;
                    $productData[$key]['product_type'] = $data->product_type;
                    $productData[$key]['brand_name'] = $data->brand_name;
                    $productData[$key]['maxPrice'] = $data->maxPrice;
                    $productData[$key]['disc_percent'] = $data->disc_percent;
                    $productData[$key]['sku'] = $data->sku;
                    $productData[$key]['inventory'] = $data->inventory;
                    $productData[$key]['collections'] = $data->collections;
                    $productData[$key]['tags'] = $data->tags;
                    $productData[$key]['shipping_info'] = $data->shipping_info;
                    $productData[$key]['description'] = $data->description;
                    $productData[$key]['shipping_charge'] = $data->shipping_charge;
                    $productData[$key]['variants'] = $data->variants;
                    $productData[$key]['seo_title'] = $data->seo_title;
                    $productData[$key]['seo_descr'] = $data->seo_descr;
                    $productData[$key]['return_day'] = $data->return_day;
					$pro_Img = $this->db->query("SELECT * FROM product_images where productId = '".$data->productId."'")->result_array();
					foreach ($pro_Img as $img) {
                        if(!empty($img['productImage']) && file_exists('assets/images/products/'.$img['productImage'])) {
                            $productData[$key]['prod_image'][] = base_url('assets/images/products/'.$img['productImage']);
                        } else {
                            $productData[$key]['prod_image'][] = base_url('assets/images/no-image.png');
                        }
					}
				}
				$response = array('status'=> 'success', 'result'=> $productData);
			} else {
				$response = array('status'=> 'error', 'result'=> 'No data found');
			}
		} catch(\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}
    public function update_product_post() {
		try{
			$data = array(
                'userid' => $this->input->post('user_id'),
                'category' => $this->input->post('category'),
                'prsubmenuId' => $this->input->post('prsubmenuId'),
                'productName' => $this->input->post('productName'),
                'prcode' => $this->input->post('prcode'),
                'product_type' => $this->input->post('product_type'),
                'brand_name' => $this->input->post('brand_name'),
                'maxPrice' => $this->input->post('maxPrice'),
                'disc_percent' => $this->input->post('disc_percent'),
                'sku' => $this->input->post('sku'),
                'inventory' => $this->input->post('inventory'),
                'collections' => $this->input->post('collections'),
                'tags' => $this->input->post('tags'),
                'shipping_info' => $this->input->post('shipping_info'),
                'description' => $this->input->post('description'),
                'shipping_charge' => $this->input->post('shipping_charge'),
                'variants' => $this->input->post('variants'),
                'seo_title' => $this->input->post('seo_title'),
                'seo_descr' => $this->input->post('seo_descr'),
                'return_day' => $this->input->post('return_day'),
                'status' => '1',
                'created' => date("Y-m-d H:i:s"),
            );
            $this->db->where('productId', $this->input->post('productId'));
            $this->db->update('products', $data);
            if (!empty($_FILES['prod_image']['size'])) {
                $filesCount = count($_FILES['prod_image']['name']);
                for($i=0; $i < $filesCount; $i++) {
                    $src = $_FILES['prod_image']['tmp_name'][$i];
                    $filEnc = time();
                    $avatar = rand(0000, 9999) . "_" . $_FILES['prod_image']['name'][$i];
                    $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
                    $dest = getcwd() . '/assets/images/products/' . $avatar1;
                    if (move_uploaded_file($src, $dest)) {
                        $file1 = $avatar1;
                    }
                    if(!empty($file1)) {
                        $pfile = $file1;
                    } else {
                        $pfile = "";
                    }
                    $uploadData = array(
                        'productImage' => $pfile,
                        'productId' => $this->input->post('productId')
                    );
                    $this->db->insert('product_images', $uploadData);
                }
            }
            $response = array('status'=> 'success', 'result'=> 'Product updated');
		} catch(\Exception $e) {
			$response = array('status'=> 'error', 'result'=> $e->getMessage());
		}
		echo json_encode($response);
	}
    public function delete_product_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $product_id = $formdata['prod_id'];
            $checkImg = $this->db->query("SELECT * FROM product_images WHERE productId  = '".$product_id."'")->result_array();
            if(!empty($checkImg)){
                $this->db->where('productId', $product_id);
                $this->db->delete('product_images');
                $this->db->where('productId', $product_id);
                $this->db->delete('products');
            } else {
                $this->db->where('productId', $product_id);
                $this->db->delete('products');
            }
            $response = array('status'=> 'success', 'result'=> 'Product deleted');
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
        }
        echo json_encode($response);
    }
    public function filter_user_product_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $cat_id = $formdata['cat_id'];
            $user_id = $formdata['user_id'];
            $product_list = $this->db->query("SELECT * FROM products WHERE category = '".$cat_id."' AND userid = '".$user_id."'")->result_array();
            if(!empty($product_list)) {
				$productList = array();
				foreach ($product_list as $key => $list) {
					$productList[$key]['product_id'] = $list['productId'];
					$productList[$key]['user_id'] = $list['userid'];
					$productList[$key]['prod_name'] = $list['productName'];
					$productList[$key]['created'] = $list['created'];
                    if($list['status'] == '1') {
                        $productList[$key]['status'] = 'Active';
                    } else {
                        $productList[$key]['status'] = 'Inactive';
                    }
				}
				$response = array('status'=> 'success', 'result'=> $productList);
			} else {
				$response = array('status'=> 'error', 'result'=> 'No data found');
			}
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
        }
        echo json_encode($response);
    }
    public function create_draft_order_post() {
        try {
            $formdata = json_decode(file_get_contents('php://input'), true);
            $user_id = $formdata['user_id'];
            $draftpayarray = array(
				'pay_user_id' => $formdata['customer_id'],
				'paid_amount' => $formdata['price'],
				'payment_status' => 'Not paid',
				'payment_created_by' => $user_id,
				'payment_created_date' =>date('Y-m-d h:i:s')
			);
			$this->Master_model->save($draftpayarray,'draftorders_payment');
			$Payorderid=$this->db->insert_id();

            $prdid = $formdata['product_id'];
            //echo "<pre>"; print_r($prdid); die();
			for($i = 0; $i < count($prdid); $i++){
				$productDetails = $this->Master_model->getSingleRow('productId',$prdid[$i],'products');
				$insdrft = array(
                    'userid' => $formdata['customer_id'],
					'draftpayment_orderid' => $Payorderid,
					'product_id' => $prdid[$i],
					'qty' => $formdata['qty'],
					'price' => $productDetails->offprice,
					'shipping_charge' => $productDetails->shipping_charge,
					'created_by' => $user_id,
					'created_at' => date('Y-m-d h:i:s'),
					'payment_status' => '0');
				$this->Master_model->save($insdrft,'draft_orders');
			}
            $response = array('status' => 'success', 'result' => "Draft Order created successfully");
        } catch (\Throwable $th) {
            $response = array('status' => 'error', 'result' => $th->getMessage());
        }
        echo json_encode($response);
    }
}