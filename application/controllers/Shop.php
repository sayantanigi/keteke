<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Shop extends AI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("pagination");
        $this->load->model('Master_model');
        $this->load->library('cart');
        //Do your magic here
    }
    public function index() {
        $this->data['title'] = 'Keteke | Marketplace';
        $this->data['load'] = 'marketplace/mhome';
        $this->data['produclist'] = $prdtl = $this->db->limit(8)->get_where('products', array('status' => 1, 'prefer_list' => 1))->result();
        $this->data['banners'] = $this->db->get_where('banner', array('banner_type' => 'mbanner', 'status' => 1))->result();
        $this->data['advs'] = $this->db->order_by('id', 'desc')->limit(2)->get_where('banner', array('banner_type' => 'adv', 'status' => 1))->result();
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function pr_list($catid = false) {
        $this->data['title'] = 'Keteke | Marketplace';
        $this->data['load'] = 'marketplace/product_listing';
        $catid = base64_decode($this->input->get('catId'));
        $this->data['produclist'] = $this->db->get_where('products', array('status' => 1, 'category' => $catid))->result();
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function prsub_list($subcatid = false) {
        $this->data['title'] = 'Keteke | Marketplace';
        $this->data['load'] = 'marketplace/product_listing';
        $subcatid = base64_decode($this->input->get('subcatid'));
        $this->data['produclist'] = $this->db->get_where('products', array('status' => 1, 'prsubmenuId' => $subcatid))->result();
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function pr_details($slug = false) {
        $this->data['title'] = 'Keteke | Marketplace';
        $this->data['load'] = 'marketplace/pr_details';
        $this->data['prodetail'] = $prdtl = $this->db->get_where('products', array('status' => 1, 'slug' => $slug))->row();
        $this->data['prdreview'] = $this->db->get_where('product_review', array('product_id' => $prdtl->productId))->result();
        $this->data['primgs'] = $this->db->get_where('product_images', array('productId' => $prdtl->productId))->result();
        if (isprologin()) {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function pr_checkout()
    {
        $this->data['title'] = 'Keteke | Marketplace';
        $this->data['load'] = 'marketplace/pr_checkout';
        $userrol = userrole();
        //$cartItems = $this->cart->contents();
        $cartItems = $this->db->query("SELECT * FROM add_to_cart WHERE user_id = '".$this->session->userdata('userids')."'")->result_array();
        if (count($cartItems) == 0) {
            $this->session->set_flashdata('error', 'Atleast one item in your cart');
            redirect(site_url('shop/pr_cart'));
        }
        $cartguest = $this->input->post('check_guest');
        if ($cartguest == 1) {
            $this->data['asguest'] = 1;
        }
        if ($userrol == 4) {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $this->data['dispricetotal'] = $this->input->post('discountedsubtotal');
        //$this->data['cartItems'] = $this->cart->contents();
        $this->data['cartItems'] = $this->db->query("SELECT * FROM add_to_cart WHERE user_id = '".$this->session->userdata('userids')."'")->result_array();
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function placeOrders() {
        $userrol = userrole();
        if ($this->input->post('chk_guest') == 1) {
            //$user = 'guest';
            $user = $this->input->post('billing_email');
        } else {
            $user = userid2();
        }
        if ($userrol == 4) {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $prid = $this->input->post('product_id');
        if (count(array_filter($prid)) == 0) {
            $this->session->set_flashdata('error', 'Please Add a product to cart! </div>');
            redirect('shop/pr_cart', 'refresh');
        } else {
            $order_id = 'KETEKEPR' . uniqid() . date('d-m-Y');
            $price = $this->input->post('prd_price');
            $prname = $this->input->post('prd_name');
            $qty = $this->input->post('prd_quan');
            $Payth = $this->input->post('payment_method');
            if ($this->input->post('billing_phone') != '') {
                $billaddr = 1;
                $bfname = $this->input->post('billingfname');
                $blname = $this->input->post('billinglname');
                $bemail = $this->input->post('billing_email');
                $bphone = $this->input->post('billing_phone');
                $baddr = $this->input->post('billing_address');
                $bcity = $this->input->post('billing_city');
                $bstate = $this->input->post('billing_state');
                $bcountry = $this->input->post('billing_country');
                $bzip = $this->input->post('billing_zip');
                $baddrd = array(
                    'order_id' => $order_id,
                    'user_id' => $user,
                    'billing_fname' => $bfname,
                    'billing_lname' => $blname,
                    'billing_email' => $bemail,
                    'billing_phone' => $bphone,
                    'billing_address' => $baddr,
                    'billing_city' => $bcity,
                    'billing_state' => $bstate,
                    'billing_country' => $bcountry,
                    'billing_zip' => $bzip,
                    'created' => date('Y-m-d H:i:s')
                );
                $this->db->insert('customer_billing_addrs', $baddrd);
            }
            if ($this->input->post('shipaddress') == 1) {
                $shippaddr = 1;
                $sfname = $this->input->post('shipping_fname');
                $slname = $this->input->post('shipping_lname');
                $semail = $this->input->post('shipping_email');
                $sphone = $this->input->post('shipping_phone');
                $saddr = $this->input->post('shipping_address');
                $scity = $this->input->post('shipping_city');
                $sstate = $this->input->post('shipping_state');
                $scountry = $this->input->post('shipping_country');
                $szip = $this->input->post('shipping_zip');
                $saddrd = array(
                    'order_id' => $order_id,
                    'user_id' => $user,
                    'shipping_fname' => $sfname,
                    'shipping_lname' => $slname,
                    'shipping_email' => $semail,
                    'shipping_phone' => $sphone,
                    'shipping_address' => $saddr,
                    'shipping_city' => $scity,
                    'shipping_state' => $sstate,
                    'shipping_country' => $scountry,
                    'shipping_zip' => $szip,
                    'created' => date('Y-m-d H:i:s')
                );
                $this->db->insert('customer_shipping_addrs', $saddrd);
            }
            for ($i = 0; $i < count($prid); $i++) {
                $ordersarray = array(
                    'userid' => $user,
                    'orderid' => $order_id,
                    'product_id' => $prid[$i],
                    'prd_title' => $prname[$i],
                    'quantity' => $qty[$i],
                    'amount' => $price[$i],
                    'billing_addr' => $billaddr,
                    'shipping_addr' => $shippaddr,
                    'payment_status' => 0,
                    'pay_th' => $Payth
                );
                $query = $this->db->insert('productorders', $ordersarray);
            }
            if ($query) {
                $paidprice = $this->input->post('total_paid_price');
                $orderdetails = array(
                    'bemail' => $bemail,
                    'userid' => $user,
                    'orderid' => $order_id,
                    'gross_amount' => $paidprice
                );
                $this->stripePayment($orderdetails);
            }
        }
    }
    public function stripePayment($orderdetails)
    {
        $this->data['title'] = 'Keteke | Stripe Payment';
        $this->data['load'] = 'marketplace/pr_stripe_payment';
        $this->data['billingemail'] = $orderdetails['bemail'];
        $this->data['priceTotal'] = $orderdetails['gross_amount'];
        $this->data['userid'] = $orderdetails['userid'];
        $this->data['orderId'] = $orderdetails['orderid'];
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function user_dashboard()
    {
        $this->data['title'] = 'Keteke | Marketplace';
        $this->data['load'] = 'marketplace/user_dashboard';
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function sellerdashboard()
    {
        $this->data['title'] = 'Keteke | Marketplace';
        $this->data['load'] = 'marketplace/seller_dashboard';
        $userrol = userrole();
        if ($userrol != 3) {
            $this->session->set_flashdata('error', 'Login or Sign up to list your business');
            redirect(site_url('login'));
        } else {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function sellerorders()
    {
        $this->data['title'] = 'Keteke | Marketplace';
        $this->data['load'] = 'marketplace/seller_orders';
        $userrol = userrole();
        if ($userrol != 3) {
            $this->session->set_flashdata('error', 'Login or Sign up to list your business');
            redirect(site_url('login'));
        } else {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $this->data['sellorders'] = $this->Master_model->getSellerOrders($user);
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function sellerproductlisting()
    {
        $this->data['title'] = 'Keteke | Marketplace';
        $this->data['load'] = 'marketplace/seller_view_product';
        $userrol = userrole();
        if ($userrol != 3) {
            $this->session->set_flashdata('error', 'Login or Sign up to list your business');
            redirect(site_url('login'));
        } else {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $this->data['mcategoty'] = $this->db->get_where('mrkt_category', array('status' => 1))->result();
        $this->data['mproducts'] = $this->db->get_where('products', array('status' => 1, 'userid' => $user))->result();
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function fetchproduct()
    {
        $mprcat = $this->input->post('caatid');
        $loguid = $this->input->post('loguid');
        if ($mprcat != 0) {
            $this->data['catproducts'] = $this->db->get_where('products', array('category' => $mprcat, 'status' => 1, 'userid' => $loguid))->result();
        } else {
            $this->data['catproducts'] = $this->db->get_where('products', array('status' => 1, 'userid' => $loguid))->result();
        }
        return $this->load->front_view('marketplace/fetchproductlist', $this->data);
    }
    public function seller_addproduct() {
        $userrol = userrole();
        if ($userrol != 3) {
            $this->session->set_flashdata('error', 'Login or Sign up to list your business');
            redirect(site_url('login'));
        } else {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
            $this->data['mcategoty'] = $this->db->get_where('mrkt_category', array('status' => 1))->result();
            $this->data['mcatsubmenu'] = $this->db->get_where('marketplace_submenu', array('cat_id' => 2))->result();
            $this->data['title'] = 'Keteke | Marketplace';
            $this->data['load'] = 'marketplace/seller_add_product';
            $this->form_validation->set_rules('frm[category]', 'Product Category', 'required');
            $this->form_validation->set_rules('frm[productName]', 'Product Name', 'required');
            $this->form_validation->set_rules('frm[prcode]', 'Product Code', 'required');
            $this->form_validation->set_rules('frm[maxPrice]', 'Max Price', 'required');
            $this->form_validation->set_rules('frm[offprice]', 'Offer Price', 'required');
            $this->form_validation->set_rules('frm[sku]', 'Add unique identifier for the product', 'trim|required|is_unique[products.sku]');
            if ($this->form_validation->run() === TRUE) {
                $frm = $this->input->post('frm');
                $frm['userid'] = $user;
                $frm['status'] = 1;
                $frm['created'] = date("Y-m-d h:i:s");
                $slug = $frm['productName'];
                if (empty($slug) || $slug == '') {
                    $slug = $frm['productName'];
                }
                $slug = strtolower(url_title($slug));
                $frm['slug'] = $this->Cms_model->get_unique_url($slug, $id);
                $res = $this->db->insert('products', $frm);
                //echo $this->db->last_query(); die();
                $productId = $this->db->insert_id();
                //print_r($_FILES['files']['size']); die();
                if (!empty($_FILES['files']['size'])) {
                    $filesCount = count($_FILES['files']['name']);
                    for ($i = 0; $i < $filesCount; $i++) {
                        $src = $_FILES['files']['tmp_name'][$i];
                        $filEnc = time();
                        $avatar = rand(0000, 9999) . "_" . $_FILES['files']['name'][$i];
                        $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
                        $dest = getcwd() . '/assets/images/products/' . $avatar1;
                        if (move_uploaded_file($src, $dest)) {
                            $file1  = $avatar1;
                        }
                        $uploadData = array(
                            'productImage'=> $file1,
                            'productId'=> $productId
                        );
                        $insert = $this->db->insert_batch('product_images', $uploadData);
                    }
                    if (!empty($uploadData)) {
                        $this->session->set_flashdata('success', 'Product Submitted successfully!');
                        redirect(site_url('add-product'));
                    } else {
                        $this->session->set_flashdata('error', 'Some error has occured');
                        redirect(site_url('add-product'));
                    }
                }
            }
        }
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function view_product($prid = false)
    {
        $userrol = userrole();
        if ($userrol != 3) {
            $this->session->set_flashdata('error', 'Login or Sign up to list your business');
            redirect(site_url('login'));
        } else {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
            $this->data['mcategoty'] = $this->db->get_where('mrkt_category', array('status' => 1))->result();
            $this->data['mcatsubmenu'] = $this->db->get_where('marketplace_submenu', array('cat_id' => 2))->result();
            $this->data['title'] = 'Keteke | Marketplace';
            $this->data['load'] = 'marketplace/seller_ind_product';
            $this->data['mindprdct'] = $this->db->get_where('products', array('status' => 1, 'productId' => $prid))->row();
            $this->data['mindprdctimg'] = $this->db->get_where('product_images', array('productId' => $prid))->result();
        }
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function seller_editproduct($prodId = false)
    {
        $userrol = userrole();
        if ($userrol != 3) {
            $this->session->set_flashdata('error', 'Login or Sign up to list your business');
            redirect(site_url('login'));
        } else {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
            $this->data['mcategoty'] = $this->db->get_where('mrkt_category', array('status' => 1))->result();
            $this->data['title'] = 'Keteke | Marketplace';
            $this->data['load'] = 'marketplace/seller_edit_product';
            $this->data['mindprdct'] = $this->db->get_where('products', array('status' => 1, 'productId' => $prodId))->row();
            $this->data['mcatsubmenu'] = $this->db->get_where('marketplace_submenu', array('cat_id' => 2))->result();
            $this->data['mindprdctimg'] = $this->db->get_where('product_images', array('productId' => $prodId))->result();
            $this->form_validation->set_rules('frm[productName]', 'Product Name', 'required');
            $this->form_validation->set_rules('frm[prcode]', 'Product Code', 'required');
            $this->form_validation->set_rules('frm[maxPrice]', 'Max Price', 'required');
            $this->form_validation->set_rules('frm[offprice]', 'Offer Price', 'required');
            if ($this->form_validation->run() === TRUE) {
                $frm = $this->input->post('frm');
                $frm['userid'] = $user;
                $frm['status'] = 1;
                $frm['modified'] = date("Y-m-d h:i:s");
                $slug = $frm['productName'];
                if (empty($slug) || $slug == '') {
                    $slug = $frm['productName'];
                }
                $slug = strtolower(url_title($slug));
                $frm['slug'] = $this->Cms_model->get_unique_url($slug, $id);
                $res = $this->db->update('products', $frm, array('productId' => $prodId));
                //echo $this->db->last_query();die;
                if (!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) {
                    $filesCount = count($_FILES['files']['name']);
                    for ($i = 0; $i < $filesCount; $i++) {
                        $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['files']['size'][$i];
                        // File upload configuration
                        $uploadPath = 'assets/images/products/';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('file')) {
                            $fileData = $this->upload->data();
                            $uploadData[$i]['productImage'] = $fileData['file_name'];
                            $uploadData[$i]['productId'] = $prodId;
                        }
                    }
                    $insert = $this->db->insert_batch('product_images', $uploadData);
                }
                if ($res == true || $insert == true) {
                    $this->session->set_flashdata('success', 'Product details updated successfully!');
                    redirect(site_url('view-products'));
                } else {
                    $this->session->set_flashdata('error', 'Some error has occured');
                    redirect(site_url('edit-product/' . $prodId));
                }
            }
        }
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    function delete_product($prdid)
    {
        if ($prdid > 0) {
            $this->db->delete('products', array('productId' => $prdid));
            $this->session->set_flashdata('error', 'Product Deleted successfully ');
        }
        redirect(site_url('view-products'));
    }
    function delete_productImg($prdimgid, $prodid)
    {
        if ($prdimgid > 0) {
            $this->db->delete('product_images', array('productImageId' => $prdimgid));
            $this->session->set_flashdata('error', 'Product Image Deleted successfully ');
        }
        redirect(site_url('edit-product/' . $prodid));
    }
    function addtocart() {
        if ($this->input->post('product_id')) {
            $checkCartData = $this->db->query("SELECT * FROM add_to_cart WHERE product_id = '".$this->input->post('product_id')."' AND user_id = '".$this->input->post('userids')."'")->result_array();
            if(!empty($checkCartData)) {
                $data = array(
					'quantity' => $checkCartData[0]['quantity'] + 1
				);
                $this->db->update('add_to_cart', $data, "product_id = '".$this->input->post('product_id')."' AND user_id = '".$this->input->post('userids')."'");
                $checkuCartData = $this->db->query("SELECT * FROM add_to_cart WHERE product_id = '".$this->input->post('product_id')."' AND user_id = '".$this->input->post('userids')."'")->result_array();
                $checkpData = $this->db->query("SELECT * FROM products WHERE productId = '".$this->input->post('product_id')."' AND status = '1'")->result_array();
                $data1 = array(
					'mrp' => $checkuCartData[0]['quantity'] * $checkpData[0]['maxPrice'],
					'discount' => $checkuCartData[0]['quantity'] * ($checkpData[0]['maxPrice'] - $checkpData[0]['offprice']),
					'final_price' => $checkuCartData[0]['quantity'] * $checkpData[0]['offprice'],
				);
				$this->db->update('add_to_cart', $data1, "product_id = '".$this->input->post('product_id')."' AND user_id = '".$this->input->post('userids')."'");
                redirect(site_url("shop/pr_cart"));
            } else {
                $data = array(
                    'session_id' => $this->input->post('session_id'),
                    'user_id' => $this->input->post('userids'),
                    'product_id' => $this->input->post('product_id'),
                    'quantity' => 1,
                    'name' => $this->input->post('product_name'),
                    'mrp' => $this->input->post('maxPrice'),
                    'final_price' => $this->input->post('offprice'),
                    'discount' => $this->input->post('disc_percent'),
                    'image' => $this->input->post('image'),
                    'created_date' => date('Y-m-d h:i')
                );
                $this->db->insert('add_to_cart', $data);
                $insert_id = $this->db->insert_id();
                if($insert_id > 0) {
                    redirect(site_url("shop/pr_cart"));
                }
            }

        }
    }
    public function pr_cart() {
        $this->data['title'] = 'Keteke | Marketplace';
        $this->data['load'] = 'marketplace/pr_cart';
        //$this->data['cartItems'] = $this->cart->contents();
        //echo "SELECT * FROM add_to_cart WHERE session_id = '".session_id()."'";
        $this->data['cartItems'] = $this->db->query("SELECT * FROM add_to_cart WHERE session_id = '".$this->session->userdata('session_id')."'")->result_array();
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function removeItem($rowid = false) {
        $rowId = $this->uri->segment(3);
        $data = array(
            'rowid' => $rowid,
            'qty' => 0
        );
        $this->cart->update($data);
        redirect(site_url('shop/pr_cart'));
    }
    public function removeCartItem() {
        $cart_id = $this->input->post('cart_id');
        $result = $this->db->query("DELETE FROM add_to_cart WHERE id = '".$cart_id."'");
        echo $result;
    }
    /*public function updateItemQty() {
        $update = 0;
        $rowid = $this->input->post('rowid', TRUE);
        $qty = $this->input->post('qty', TRUE);
        if (!empty($rowid) && !empty($qty)) {
            $data = array(
                'rowid' => $rowid,
                'qty' => $qty,
            );
            $update = $this->cart->update($data);
        }
        if ($update) {
            echo 1;
        } else {
            echo 0;
        }
    }*/
    public function updateItemQty() {
        $cartid = $this->input->post('cartid');
        $newqnty = $this->input->post('newqnty');
        $checkCartData = $this->db->query("SELECT * FROM add_to_cart WHERE id = '".$cartid."'")->row();
        $productprice = $this->db->query("SELECT * FROM products WHERE productId = '".$checkCartData->product_id."'")->row();
        $orgial_price = $productprice->maxPrice * $newqnty;
        $final_price = $productprice->offprice * $newqnty;
        $discount = ($productprice->maxPrice - $productprice->offprice) * $newqnty;
        $data = array(
            'mrp' => $orgial_price,
            'discount' => $discount,
            'final_price' => $final_price,
            'quantity' => $newqnty
        );
        $result = $this->db->update('add_to_cart', $data, array('id' => $cartid));
        echo $result;
    }
    public function clearCart() {
        if ($this->cart->destroy()) {
            echo 1;
        } else {
            echo 0;
        }
    }
    function getproductreviewsubmit()
    {
        $rstar = $this->input->post('rstar');
        $rname = $this->input->post('rname');
        $ruserid = $this->input->post('ruserid');
        $rprdid = $this->input->post('rprdid');
        $rvsub = $this->input->post('rvsub');
        $rcmnts = $this->input->post('rcmnts');
        $prrreview = array(
            'user_id' => $ruserid,
            'product_id' => $rprdid,
            'name' => $rname,
            'rating' => $rstar,
            'subject' => $rvsub,
            'message' => $rcmnts,
            'add_date' => date('Y-m-d H:i:s')
        );
        $rvinsert = $this->db->insert('product_review', $prrreview);
        if ($rvinsert == TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function check_coupon_ajax() {
        $cpn = $this->input->post('cpn');
        $amt = $this->input->post('amt');
        $session_id = $this->input->post('session_id');
        $buttonval = $this->input->post('buttonval');
        if($buttonval == 'Apply Code') {
            $check = $this->db->query("SELECT * FROM `coupon_details` WHERE coupon_code='" . $cpn . "' AND CURDATE() between created_date and expiry_date AND coupon_status=1");
            $count = $check->num_rows();
            $rowdetl = $check->row();
            $couamnt = @$rowdetl->coupon_amount;
            if($couamnt > $amt ) {
                echo "1";
            } else {
                if ($count > 0) {
                    if ($rowdetl->coupon_type == 'amount') {
                        $totaldisc_price = ($amt - $couamnt);
                    } elseif ($rowdetl->coupon_type == 'percent') {
                        $totaldisc_price = $amt - ($amt * $couamnt) / 100;
                        $saved = ($amt * $couamnt) / 100;
                    }
                    $this->db->query("UPDATE add_to_cart SET applied_coupon_id = '".@$rowdetl->coupon_id."', coupon_discount_amnt = '".$saved."', price_after_coupon = '".$totaldisc_price."' WHERE session_id = '".$session_id."'");
                    echo json_encode(array('totaldisc_price' => $totaldisc_price, 'saved' => $saved));
                } else {
                    echo 0;
                }
            }
        } else {
            $this->db->query("UPDATE add_to_cart SET applied_coupon_id = '0', coupon_discount_amnt = '0', price_after_coupon = '0' WHERE session_id = '".$session_id."'");
            echo json_encode(array('totaldisc_price' => $amt, 'saved' => '0'));
        }
    }
    public function search_product($prdname = false)
    {
        $this->data['title'] = 'Keteke | Search product';
        $this->data['load'] = 'marketplace/srchproduct_listing';
        $prname = $this->input->get('prdname');
        $this->data['produclist'] = $this->db->query('SELECT * FROM products AS pd JOIN mrkt_category AS mk ON mk.id=pd.category WHERE (mk.name LIKE "%' . $prname . '%" OR pd.productName LIKE "%' . $prname . '%" OR pd.tags LIKE "%' . $prname . '%")')->result();
        $this->load->front_view('marketplace/mdefault', $this->data);
    }
    public function updateOrderstatus()
    {
        $orderstatus = $this->input->post('orderstatus', TRUE);
        $ordId = $this->input->post('ordId', TRUE);
        if (!empty($orderstatus) && !empty($ordId)) {
            if ($orderstatus == "refunded") {
                $refunddate = date('Y-m-d H:i:s');
                $refundstatus = "refunded";
                $orderstatus = "refunded";
            } elseif ($orderstatus == "completed") {
                $ordercompdate = date('Y-m-d H:i:s');
            } else {
                $ordercompdate = "";
                $refunddate = "";
                $refundstatus = "";
            }
            $data = array(
                'order_status' => $orderstatus,
                'order_complete_date' => $ordercompdate,
                'refund_status' => $refundstatus,
                'refund_date' => $refunddate
            );
            $update = $this->db->update('productorders', $data, array('id' => $ordId));
        }
        if ($update) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function get_sub_cat() {
        $cat_id = $this->input->post('cat_id');
		$subcat_list = $this->db->query("SELECT * FROM marketplace_submenu WHERE cat_id = '".$cat_id."'")->result_array();
		if(!empty($subcat_list)) {
			$html = "<option value=''>Select Sub Category</option>";
			foreach ($subcat_list as $row_data) {
				$html .= "<option value='".$row_data['submenuId']."'>".ucfirst($row_data['name'])."</option>";
			}
		} else {
			$html = '';
		}
		echo $html;
    }
}
/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */