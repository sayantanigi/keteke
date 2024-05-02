<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends AI_Controller {

    function __construct() {
        parent::__construct();
        $this->data['title'] = '';
        $this->load->model('Master_model'); 
        $this->load->library('paypal_lib');  
        //print_r($_SESSION);
    }

    public function index() { 
        $this->data['title'] = seo_page_get('hph');
        $this->data['meta_description'] = seo_page_get('hpd'); 
        $this->data['keyword'] = seo_page_get('hpk');
        $this->data['load'] = 'home';

        $ip = $_SERVER["REMOTE_ADDR"];
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

      
        if($query && $query['status'] == 'success')
             {
              $country=$query['country'];
              $state=$query['regionName'];
              $city=$query['city'];
              $lat=$query['lat'];
              $lon=$query['lon'];
              $this->data['lat'] = $lat;
              $this->data['lon'] = $lon;
              $this->data['loc'] = $city.','.$state.','.$country;
            }
        
        $this->data['propt'] = $this->db->limit(3)->order_by('title','asc')->get_where('listing',array('status'=>1,'category'=>'restaurant'))->result();
        $this->data['propth'] = $this->db->limit(3)->order_by('title','asc')->get_where('listing',array('status'=>1,'category'=>'hotel'))->result();
        //echo $this->db->last_query();die;
        
        $this->load->front_view('default', $this->data);
    }
      public function faq() {
        $this->data['title'] = seo_page_get('fqh');
        $this->data['meta_description'] = seo_page_get('fqhd');
        $this->data['keyword'] = seo_page_get('fqk');
        $this->data['load'] = 'faq';
        $this->data['faq'] = $this->db->get_where('faqs',array('status'=>1))->result();
        $this->load->front_view('default', $this->data);
    }
     public function how_work() { 
        $this->data['title'] = seo_page_get('hiwh');
        $this->data['meta_description'] = seo_page_get('hiwd');
        $this->data['keyword'] = seo_page_get('hiwk');
        $this->data['load'] = 'how_it_work';
        $this->load->front_view('default', $this->data);
    }
    function contact(){
         $this->data['title'] = seo_page_get('spth');
        $this->data['meta_description'] = seo_page_get('spthd');
        $this->data['keyword'] = seo_page_get('sptk');
         $this->data['load'] = 'contact';
                 $config = array(
            array(
                'field' => 'frm[name]',
                'label' => 'Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'frm[email]',
                'label' => 'Email Address',
                    'rules' => 'trim|required'   //here we have added the callback which we have created by appending callback_ to its method name
                ),
            array(
                'field' => 'frm[message]',
                'label' => 'Message',
                'rules' => 'trim|required'
            )

        ); 

        $this->form_validation->set_rules($config);
        if($this->form_validation->run()) {
        $formdata = $this->input->post('frm');

        $res1 = $this->db->insert('contacts',$formdata);
        if($res1 == true){
            $htmlContent = "
               <body style='background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;'>
  <table style='max-width:600px;margin:20px auto 10px;background-color:#fff;padding:20px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #000000;'>
    <thead>
      <tr>
        <th style='text-align:left;'><img style='max-width: 150px;' src='".site_url('fassets/images/logo.png')."' alt='Global Galaxxy Tracker'></th>
        <th style='text-align:right;font-weight:400;'>".date('d M Y')."</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan='2' style='height:2px;background:#232323'></td>
      </tr>
        <tr>
            <td colspan='2' style='padding:20px 0'><h3 style='margin;0;color:green'>Dear Admin,</h3>
            <p>A new Enquiry message for Global Galaxxy Tracker. Kindly check the below complete information of the Candidate.</p>
            </td>
        </tr>
      <tr>
        <td style='height:35px;'><h4 style='margin:0 '>Enquiry Detail</h4></td>
      </tr>
      <tr>
        <td style='width:50%;padding:0;vertical-align:top'>
          <p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px'>Name</span> ".$formdata['name']."</p>
          <p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Email</span> ".$formdata['email']."</p>
         
        </td>
        </tr>
        <tr>
        <td style='width:50%;padding:0;vertical-align:top'>
         
          <p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Message</span> ".$formdata['message']."</p>
        </td>
      </tr>
      <tr>
        <td style='height:15px;'></td>
      </tr>
      
    </tbody>
  </table>
</body>
                ";


                $this->load->library('email');
                $this->email->set_mailtype("html");
                $this->email->from($formdata['email']);
                $this->email->to('info@globalgalaxxy.com');

                $this->email->subject('Enquiry Message From Global Galaxxy Tracker');
                $this->email->message($htmlContent);

                $this->email->send();

                $this->session->set_flashdata('success', 'Thank You!! We will get back to you soon.');
                redirect(site_url('support'));
            }
        }
        $this->load->front_view('default', $this->data);
        }


    public function terms() {
        $this->data['title'] = 'Global Galaxxy Tracker | Terms & Conditions';
        $this->data['load'] = 'term';
        $this->data['abt'] = $this->db->get_where('cms',array('id'=>4))->row();
        $this->load->front_view('default', $this->data);
    }

    public function privacy() {
        $this->data['title'] = 'Global Galaxxy Tracker | Privacy Policy';
        $this->data['load'] = 'privacy';
        $this->data['abt'] = $this->db->get_where('cms',array('id'=>3))->row();
        $this->load->front_view('default', $this->data);
    }
    public function refundpolicy() {
        $this->data['title'] = 'Global Galaxxy Tracker | Refund Policy';
        $this->data['load'] = 'refund';
        $this->data['abt'] = $this->db->get_where('cms',array('id'=>6))->row();
        $this->load->front_view('default', $this->data);
    }

        public function newsletter() {
        $email=$this->input->post('email');
        $arr = array('email'=>$email);
        $rows = $this->db->get_where('newsletter',array('email'=>$email))->num_rows();
        if($rows >0){
            echo "Already Subscribed.";
        } else {
        $this->db->insert('newsletter',$arr);
        echo "Thank You For Subsciption.";
        }
        }


        
    public function login_ajax()
{
    $uname = $this->input->post('uname');
    $password = base64_encode($this->input->post('password'));
    $sql = "SELECT * FROM `users` WHERE (email = '$uname') AND password = '$password' AND status = 1";
    $check = $this->db->query($sql)->num_rows();
    $user = $this->db->query($sql)->row();
    if($check>0){
       $this->session->set_userdata('userids',$user->id);
        echo 1;
    }else{
        echo 2;
    }
    }

    function reset_pass(){
    $mail = $this->input->post('email');
    $sql = "SELECT * FROM `users` WHERE (email = '$mail') AND status = 1";
    $check = $this->db->query($sql)->num_rows();
    $user = $this->db->query($sql)->row();
    $pass =  base64_decode($user->password);
     if($check > 0){
        echo 1;
    }
    else{
        echo 2;
    }
        $name = $user->fname;
        
        $htmlContent = "
        <table align='center' style='width:650px; text-align:center; background:#8e88881f;'>
        <tbody>
        <tr style='height:50px;background-color:#ffeabf;'>
        <td valign='middle' style='color:white;'><img src='" . base_url() . "fassets/images/logo.png' alt='Global Galaxxy Tracker' title='Glbal Galaxxy Logo' height='100px' /></td>
        </tr>
        <tr>
        <td valign='top' align='center' colspan='2'>
        <table align='center' style='height:380px; color:#000; width:600px;'>
        <tbody>
        <tr>
        <td style='width:8px;'>&nbsp;</td>
        <td align='center' style='font-size:28px;border-top:1px dashed #ccc;' colspan='3'>Hello, ".$name."</td>
        </tr>
        <tr>
        <td valign='top' align='center' colspan='2'>
        <p>Your Password is ".$pass.".</p>
        
        <br>
        Best Regards,<br>
        Global Galaxxy Tracker <br><br>
        This is an automated response, please DO NOT reply.
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        ";

        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->from('Global Galaxxy Tracker Team');
        $this->email->to($mail);

        $this->email->subject('Your Password');

        $this->email->message($htmlContent);

        $this->email->send();
}

    function claim_busi(){
    $this->data['title'] = 'Global Galaxxy Tracker | Claim Your Business';
    $this->data['load'] = 'claim_bn';
     $this->form_validation->set_rules('cl_name', 'Full Name', 'required');
        $this->form_validation->set_rules('cl_email', 'Email', 'required');
    if($this->form_validation->run()) {
    $fname = $this->input->post('cl_name');
    $mail = $this->input->post('cl_email');
    $pmail = $this->db->get_where('listing',array('email' =>$mail,'bulk_up'=>1))->row();
    $sql = "SELECT * FROM `users` WHERE (email = '$mail') AND status = 1";
    $check = $this->db->query($sql)->num_rows();
    $user = $this->db->query($sql)->row();
    if($check == 0){
        $this->session->set_flashdata('error', 'Please contact Administrator for claimed your business.');
    }
    else if($check > 0){
        $this->session->set_flashdata('error', 'You have already claimed your business.');
    }
    else if($mail==$pmail->email) {
       $pass=rand();
        
        $htmlContent = "
        <table align='center' style='width:650px; text-align:center; background:#8e88881f;'>
        <tbody>
        <tr style='height:50px;background-color:#000;'>
        <td valign='middle' style='color:white;'><img src='" . base_url() . "fassets/images/logo-1.png' alt='Global Galaxxy Tracker' title='Glbal Galaxxy Logo' /></td>
        </tr>
        <tr>
        <td valign='top' align='center' colspan='2'>
        <table align='center' style='height:380px; color:#000; width:600px;'>
        <tbody>
        <tr>
        <td style='width:8px;'>&nbsp;</td>
        <td align='center' style='font-size:28px;border-top:1px dashed #ccc;' colspan='3'>Hello, ".$fname."</td>
        </tr>
        <tr>
        <td valign='top' align='center' colspan='2'>
        <p>Your Email ID is : ".$mail."</p>
        <p>Your Password is : ".$pass."</p>
        
        <br>
        Best Regards,<br>
        Global Galaxxy Tracker <br><br>
        This is an automated response, please DO NOT reply.
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        ";

        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->from('Claim Your Business from  Global Galaxxy');
        $this->email->to($mail);

        $this->email->subject('Your Login Details for claimed Business');

        $this->email->message($htmlContent);
        //print_r($htmlContent);die;

        $this->email->send();
        $res= $this->db->insert('users',array('fname' =>$fname,'email'=>$mail,'password'=>base64_encode($pass),'status'=>1));
        $uid = $this->db->insert_id();
        $upd = $this->db->update('listing',array('bulk_up'=>0,'userid'=>$uid),array('email' => $mail));

        $this->session->set_flashdata('success', 'Please Check Your Email for claimed details..');
    }
}
    $this->load->front_view('default', $this->data); 
}
   public function signin_signup(){
     
    $this->data['title'] = 'Global Galaxxy Tracker | SignIn Or SignUp';
    $this->data['load'] = 'login_signup';
    $this->data['fee'] = $this->db->get_where('reg_fee',array('status'=>1,'id'=>1))->row();
    $this->form_validation->set_rules('signup_name', 'Name', 'required');
    $this->form_validation->set_rules('signup_email', 'Email', 'required');
       
    $this->form_validation->set_rules('signup_password', 'Password', 'trim|required|min_length[6]');
        //print_r($_POST);die;
    if($this->form_validation->run() === TRUE) {
    $name = $this->input->post('signup_name');
    $email = $this->input->post('signup_email');
    $password = $this->input->post('signup_password');
    $fee = $this->input->post('signup_cost');
    //echo $s_date;die;
    $check_email = $this->db->get_where('users',array('email'=>$email,'status'=>1))->num_rows();
    //echo $this->db->last_query();die;
    if($check_email>0){
       $this->session->set_flashdata('error', 'The email id you are trying to use is already registered. Please login, or create a new account using a unique email address!');
       redirect(site_url('login'));
    }
    $arr = array(
        'fname'=>$name, 
        'email'=>$email,
        'password'=>base64_encode($password),
        'reg_fee'=>$fee
        //'status'=>1
    );
    if($res = $this->db->insert('users',$arr)){
            $arr['orderId'] = $this->db->insert_id();
            $this->reg_pay_pal($arr);
            if($res == true){
                //$this->session->set_flashdata('success', 'Thank you for Your  us !');
               redirect(site_url('payment'));
            }
        //echo 1;
    }else{
    $this->session->set_flashdata('error', 'Some error has occured..Please Try again');
    }
}
    $this->load->front_view('default', $this->data);
    }
    public function reg_pay_pal($arr)
    {
        //print_r($arr);die;
       
        $orderId=$arr['orderId'];
        $price=$arr['reg_fee'];


        
                $returnURL = base_url().'paypal/regsuccess'; //payment success url


                $cancelURL = base_url().'paypal/cancel'; //payment cancel url
                $notifyURL = base_url().'paypal/ipn'; //ipn url
                
                // $this->paypal_lib->add_field('business','magento-facilitator@goigi.com');
                //$this->paypal_lib->add_field('business','chandrakant.goigi@gmail.com');
                // $this->paypal_lib->add_field('return', $returnURL);
                // $this->paypal_lib->add_field('cancel_return', $cancelURL);
                // $this->paypal_lib->add_field('notify_url', $notifyURL);
                // $this->paypal_lib->add_field('item_name','Membership Subscription');
                // $this->paypal_lib->add_field('custom',$orderId);
                
                // $this->paypal_lib->add_field('item_number',1);
                // $this->paypal_lib->add_field('currency_code','USD');
                
                
                // $this->paypal_lib->add_field('cmd','_xclick-subscriptions');
                // $this->paypal_lib->add_field('a3',1);
                // $this->paypal_lib->add_field('p3',1);
                // $this->paypal_lib->add_field('t3','M');
                
                
                //$this->paypal_lib->add_field('business',$email);
                //$this->paypal_lib->add_field('day_phone_b','9611954971');
                //$this->paypal_lib->add_field('amount',$price);
                //$this->paypal_lib->add_field('amount',$total);
                $this->paypal_lib->paypal_auto_form();

                exit;

            }
    public function listingcreate(){
      if(!isprologin()){
        redirect(site_url('login'));
        }
        if(isprologin()){
            $user = userid2();
            $this->data['udetail'] = $this->db->get_where('users',array('id'=>$user))->row();
            
        }
        $this->data['title'] = 'Global Galaxxy Tracker | Create Listing';
        $this->data['load'] = 'listing_create';
        $this->data['plan'] = $this->db->limit(3)->get_where('package',array('status'=>1))->result();
        $this->form_validation->set_rules('frm[title]', 'Title', 'required');
        $this->form_validation->set_rules('frm[email]', 'Email', 'required');
       
        $this->form_validation->set_rules('frm[phone]', 'Phone Number', 'required');
        //print_r($_POST);die;
     if($this->form_validation->run() === TRUE) {
        $frm = $this->input->post('frm');
        $filename = array();
        $count = count($_FILES['files']['name']);
        for($i=0;$i<$count;$i++){
        if(!empty($_FILES['files']['name'][$i])){
    
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
  
          $config['upload_path'] = 'assets/images/directory/';
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          //$config['max_size'] = '5000';
          $config['file_name'] = $_FILES['files']['name'][$i];
   
          $this->load->library('upload',$config); 
    
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename[] = $uploadData['file_name'];
   
            //$data['totalFiles'][] = $filename;
          }
        }
    }
          $names= implode(',', $filename);

           $frm['images'] = $names;
           $frm['userid'] = $user;
          
            $frm['status']=1;
            
            if($frm['amount'] !=''){
            $res = $this->db->insert('listing',$frm);
            $frm['orderId'] = $this->db->insert_id();
            $this->pay_pal($frm);

            if($res == true){
                //$this->session->set_flashdata('success', 'Thank you for Your  us !');
                redirect(site_url('payment'));
            }
        } else{

           $res = $this->db->insert('listing',$frm);
            //echo $this->db->last_query();die;
            if($res == true){
                $this->session->set_flashdata('success', 'Listing Submitted successfully!');
                 redirect(site_url('mylistings'));
            }
            else{
                $this->session->set_flashdata('error', 'Some error has occured');
                redirect(site_url('create-listing'));
            }
        }
        }
       $this->load->front_view('default', $this->data);
    }
        public function pay_pal($frm)
    {
       // print_r($frm);die;
        if(isprologin()){
            $userid = userid2();
            $user =  $this->db->get_where('users',array('id'=>$userid))->row();
            
        }
        
        $name=$user->fname;
        $email=$user->email;
        $orderId=$frm['orderId'];
        $price=$frm['amount'];

        
                $returnURL = base_url().'paypal/success'; //payment success url


                $cancelURL = base_url().'paypal/cancel'; //payment cancel url
                $notifyURL = base_url().'paypal/ipn'; //ipn url
                
                
                $this->paypal_lib->add_field('return', $returnURL);
                $this->paypal_lib->add_field('cancel_return', $cancelURL);
                $this->paypal_lib->add_field('notify_url', $notifyURL);
                $this->paypal_lib->add_field('item_name',$orderId);
                $this->paypal_lib->add_field('custom',$userid);
                $this->paypal_lib->add_field('first_name',$name);
                
                $this->paypal_lib->add_field('email',$email);
                //$this->paypal_lib->add_field('day_phone_b','9611954971');
                $this->paypal_lib->add_field('amount',$price);
                //$this->paypal_lib->add_field('amount',$total);
                $this->paypal_lib->paypal_auto_form();

                exit;

            }
      public function listing(){ 
       $this->data['title'] = seo_page_get('blh');
       $this->data['meta_description'] = seo_page_get('blhd');
        $this->data['keyword'] = seo_page_get('blk');
       $this->data['load'] = 'listing';
       $this->data['proptc'] = $this->db->get_where('listing',array('status'=>1))->num_rows();
       
        $home_list = $this->Master_model->getAllalph('listing');
        $this->data['propt'] = $home_list['results'];
        $listname = $this->input->post('list_name');
        if($listname){
            $this->data['propt'] = $this->db->query("SELECT * FROM `listing` WHERE (`title` LIKE '%$listname' OR `title` LIKE '$listname%' OR `title` LIKE '%$listname%' ) AND status=1")->result();
            //echo $this->db->last_query();die;
        }
        else{
           $this->data['propt'] = $this->db->query("SELECT * FROM `listing` WHERE status=1 OR pr_status=1 ORDER BY pr_status DESC limit 9")->result(); 
        }
        //echo $this->db->last_query();die;
       
       $this->load->front_view('default', $this->data);
    }
    function fetchByCheck(){

        $country= $this->input->post('tmp_cntry');
        $categoty = $this->input->post('tmp_cat');
        $output = '';
        $keyword = [];
        if ($this->input->post('tmp_cntry')) {
            $array = $this->input->post('tmp_cntry');
            $keyword['country'] = implode("','", $array);
        }
        if ($this->input->post('tmp_cat')) {
            $array = $this->input->post('tmp_cat');
            $keyword['category'] = implode("','", $array);
        }
        $search_keuword = '';
        if (count($keyword) > 0) {
            foreach ($keyword as $key => $value) {
                if ($key == 'country') {
                    $search_keuword .= "and country IN ('" . $value . "')";
                }
                if ($key == 'category') {
                    $search_keuword .= "and category IN ('" . $value . "')";
                }
        }
        $this->data['datalist'] = $this->db->query("SELECT * FROM listing WHERE id!='' " . $search_keuword . " limit 0,9")->result();
        //$this->data['proptc'] = $this->db->query("SELECT * FROM listing WHERE id!='' " . $search_keuword . " ")->num_rows();
        //echo $this->db->last_query();die;
    }
       
       
    else{
       $this->data['datalist'] = $this->db->query("SELECT * FROM listing WHERE id!='' and `status` = 1 or `pr_status` = 1 ORDER BY `pr_status` DESC , `title` ASC limit 0,9 ")->result(); 
       //$this->data['proptc'] = $this->db->query("SELECT * FROM listing WHERE id!='' and `status` = 1 or `pr_status` = 1 ORDER BY `pr_status` DESC , `title` ASC limit 9 ")->num_rows(); 
    }
    //echo $this->db->last_query();die;
    return $this->load->front_view('search_list',$this->data);
       
}
public function loadsearch(){
        $count= $this->input->post('c');
        $offset = $count * 9;
       
        $keyword = [];
        if ($this->input->post('tmp_cntry1')) {
            $array = $this->input->post('tmp_cntry1');
            $keyword['country'] = implode("','", $array);
        }
        if ($this->input->post('tmp_cat1')) {
            $array = $this->input->post('tmp_cat1');
            $keyword['category'] = implode("','", $array);
        }
        $search_keuword = '';
        if (count($keyword) > 0) {
            foreach ($keyword as $key => $value) {
                if ($key == 'country') {
                    $search_keuword .= "and country IN ('" . $value . "')";
                }
                if ($key == 'category') {
                    $search_keuword .= "and category IN ('" . $value . "')";
                }
        }
        $this->data['datalist'] = $this->db->query("SELECT * FROM listing WHERE id!='' " . $search_keuword . " and `status` = 1 or `pr_status` = 1 ORDER BY `pr_status` DESC , `title` ASC limit ".$offset."")->result();
        //echo $this->db->last_query();die;
        $this->data['proptc'] = $this->db->query("SELECT * FROM listing WHERE id!='' " . $search_keuword . " and `status` = 1 or `pr_status` = 1 ORDER BY `pr_status` DESC , `title` ASC")->num_rows();

        
    }
    else{
       $this->data['datalist'] = $this->db->query("SELECT * FROM listing WHERE id!='' and `status` = 1 or `pr_status` = 1 ORDER BY `pr_status` DESC , `title` ASC limit ".$offset."")->result(); 
       $this->data['proptc'] = $this->db->query("SELECT * FROM listing WHERE id!='' and `status` = 1 or `pr_status` = 1 ORDER BY `pr_status` DESC , `title` ASC")->num_rows(); 
       //echo $this->db->last_query();die;
    }
  
    return $this->load->front_view('search_list',$this->data);
        
}

public function loadsearchlist(){
$count= $this->input->post('c');
$count1 = $count-1;
        $offset = $count1 * 9;
      $cnt= $this->input->post('cnt');
      $cate= $this->input->post('cate');
      $lat= $this->input->post('s_lat');
      $longi= $this->input->post('s_lon');
      $this->data['scrollId'] = $count;
    if($cnt){
     $this->data['datalist'] = $this->db->query("SELECT *, ACOS( SIN( RADIANS(lati ) ) * SIN( RADIANS( ".$lat." ) ) + COS( RADIANS(lati) ) * COS( RADIANS( ".$lat." )) * COS( RADIANS(longi ) - RADIANS( ".$longi." )) ) * 6380 AS `distance` FROM `listing` WHERE country = '$cnt' AND category = '$cate' AND ( status = '1' OR pr_status = '1' ) AND ACOS( SIN( RADIANS( lati ) ) * SIN( RADIANS( ".$lat." ) ) + COS( RADIANS( lati ) ) * COS( RADIANS( ".$lat." )) * COS( RADIANS(longi ) - RADIANS( ".$longi." )) ) * 6380 < 150 ORDER BY distance ASC , pr_status DESC, title ASC LIMIT 9 OFFSET ".$offset."")->result();
   
   //echo $this->db->last_query();die;
    }else{
     $this->data['datalist'] = $this->db->query("SELECT * FROM listing WHERE id!='' and country='".$cnt."' and category='".$cate."'  and `status` = 1 or `pr_status` = 1 ORDER BY `pr_status` DESC , `title` ASC limit 9 OFFSET ".$offset."")->result();
    }
    
    
    return $this->load->front_view('search_list',$this->data);

}
public function refinedsearchlist(){
//$count= $this->input->post('c');
//$count1 = $count-1;
        //$offset = $count1 * 9;
      $cnt= $this->input->post('cntt');
      $cate= $this->input->post('catee');
      $lat= $this->input->post('s_latt');
      $longi= $this->input->post('s_lonn');
      $srcloc= $this->input->post('srcloc');
      $srcdes= $this->input->post('srcdes');
      //$this->data['scrollId'] = $count;
    if($srcloc){
     $this->data['datalist'] = $this->db->query("SELECT *, ACOS( SIN( RADIANS(lati ) ) * SIN( RADIANS( ".$lat." ) ) + COS( RADIANS(lati) ) * COS( RADIANS( ".$lat." )) * COS( RADIANS(longi ) - RADIANS( ".$longi." )) ) * 6380 AS `distance` FROM `listing`  WHERE (`location` LIKE '%$srcloc' OR `location` LIKE '$srcloc%' OR `location` LIKE '%$srcloc%' ) AND country = '$cnt' AND category = '$cate' AND ( status = '1' OR pr_status = '1' ) AND ACOS( SIN( RADIANS( lati ) ) * SIN( RADIANS( ".$lat." ) ) + COS( RADIANS( lati ) ) * COS( RADIANS( ".$lat." )) * COS( RADIANS(longi ) - RADIANS( ".$longi." )) ) * 6380 < 150 ORDER BY distance ASC , pr_status DESC, title ASC")->result();
   
   //echo $this->db->last_query();die;
    }elseif($srcdes){
     $this->data['datalist'] = $this->db->query("SELECT *, ACOS( SIN( RADIANS(lati ) ) * SIN( RADIANS( ".$lat." ) ) + COS( RADIANS(lati) ) * COS( RADIANS( ".$lat." )) * COS( RADIANS(longi ) - RADIANS( ".$longi." )) ) * 6380 AS `distance` FROM `listing` WHERE (`descr` LIKE '%$srcdes' OR `descr` LIKE '$srcdes%' OR `descr` LIKE '%$srcdes%' ) AND country = '$cnt' AND category = '$cate' AND ( status = '1' OR pr_status = '1' ) AND ACOS( SIN( RADIANS( lati ) ) * SIN( RADIANS( ".$lat." ) ) + COS( RADIANS( lati ) ) * COS( RADIANS( ".$lat." )) * COS( RADIANS(longi ) - RADIANS( ".$longi." )) ) * 6380 < 150 ORDER BY distance ASC , pr_status DESC, title ASC")->result();
      //echo $this->db->last_query();die;
    }

    return $this->load->front_view('refinesearch_list',$this->data);

}

    public function list_details($id=false,$page=1) {
       
        $this->data['load'] = 'list_detail';
        $this->data['list_detl'] = $det = $this->db->get_where('listing',array('id'=>$id))->row();
        $this->data['title'] = $det->title. " | Global Galaxxy Tracker";
        $exp = explode('.',$det->descr);
        $this->data['meta_description'] = seo_page_get('bldd').'-'.$exp[0];
        $this->data['keyword'] = seo_page_get('bldk');
        
        
        //print_r( $this->data['meta_des']);
        //$this->data['li_rev'] = $this->db->get_where('review',array('list_id'=>$id,'status'=>1))->result();
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 4;
        $offset = ($page - 1) * $show_per_page;
        $li_revv = $this->Master_model->getAllrvw($offset, $show_per_page, 'review',$id);
       
        $this->data['li_rev'] = $li_revv['results'];
        $config['base_url'] = site_url('list-details/'.$id);
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $li_revv['total'];
        $config['per_page'] = $show_per_page;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = 'FIRST';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'LAST';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = 'PREV';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'NEXT';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['use_page_numbers'] = true;
        $config['use_page_numbers'] = true;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = true;

        $this->pagination->initialize($config);
        $this->data['paginate'] = $this->pagination->create_links();
        

        
    $this->form_validation->set_rules('frm[name]', 'Name', 'required');
      
     if($this->form_validation->run() === TRUE) {
            $frm = $this->input->post('frm');
            //print_r($_POST);die;
            $frm['status']=0;
            $res = $this->db->insert('review',$frm);
            if($res == true){
                $this->session->set_flashdata('success', 'Your Review Submitted successfully !');
                 redirect(site_url('list-details/'.$id));
            }
            else{
                $this->session->set_flashdata('error', 'Some error is occured');
                redirect(site_url('list-details/'.$id));
            }
        }
        $this->load->front_view('default', $this->data);
    }
    function get_percentage($total, $number)
        {
          if ( $total > 0 ) {
           return round($number / ($total / 100),2);
          } else {
            return 0;
          }
        }
    public function view_listing() {
        if(!isprologin()){
            redirect(site_url());
        }
         if(isprologin()){
            $user = userid2();
             $this->data['udetail'] = $this->db->get_where('users',array('id'=>$user,'status'=>1))->row();
            //echo $this->db->last_query();die;
        }
        $this->data['title'] = 'Global Galaxxy Tracker | Listings';
        $this->data['load'] = 'my_listings';
         $this->data['my_list'] = $this->db->order_by('id','desc')->get_where('listing',array('userid'=>$user,'status'=>1))->result();
        $this->load->front_view('default', $this->data);
    }
    function listing_delete($id){
            if ($id > 0) {
            $this->Master_model->delete($id,'listing');
            $this->session->set_flashdata('success', 'row deleted successfully.');
        }
        redirect(site_url('mylistings'));
        }
    public function view_profile() {
        if(!isprologin()){
            redirect(site_url());
        }
        if(isprologin()){
            $user = userid2();
            $this->data['udetail'] = $this->db->get_where('users',array('id'=>$user,'status'=>1))->row();
            
        }
        $this->data['title'] = 'Global Galaxxy Tracker | My Profile';
        $this->data['load'] = 'profile';
        $this->form_validation->set_rules('frm[fname]', 'Full Name', 'required');
      
     if ($this->form_validation->run() === TRUE) {
            $frm = $this->input->post('frm');
            $res = $this->db->update('users',$frm,array('id' => $user));
            if($res == true){
                $this->session->set_flashdata('success', 'Your Profile updated successfully !');
                 redirect(site_url('myprofile'));
            }
            else{
                $this->session->set_flashdata('error', 'Some error is occured');
                redirect(site_url('myprofile'));
            }
        }
        $this->load->front_view('default', $this->data);
    }
    public function changepass() {
        $this->data['title'] = 'Global Galaxxy Tracker | Change Password';
        $this->data['load'] = 'change_pass';
         if(!isprologin()){
            redirect(site_url());
        }
         if(isprologin()){
            $user = userid2();
             $this->data['udetail'] = $this->db->get_where('users',array('id'=>$user,'status'=>1))->row();
        }
        $this->form_validation->set_rules('new_pass', 'New Password', 'required');
        $this->form_validation->set_rules('con_pass', 'Confirm password', 'required|matches[new_pass]');

    if ($this->form_validation->run() == TRUE) {
        $new_pass=base64_encode($this->input->post('new_pass'));

        $confirm_pass=base64_encode($this->input->post('con_pass'));
        if ($new_pass==$confirm_pass) {
            $this->db->where('id',$user)->update('users',array('password'=>$confirm_pass));
            $this->session->set_flashdata("success", "Password Changed Successfully");
            redirect(site_url('change-password'));
        }else{
            $this->session->set_flashdata('error', 'New password confirm password does not matched');
            redirect(site_url('change-password'));
        }
    }
        $this->load->front_view('default', $this->data);
    }
 public function edit_listing() {
        if(!isprologin()){
            redirect(site_url());
        }
        if(isprologin()){
            $user = userid2();
             $this->data['udetail'] = $this->db->get_where('users',array('id'=>$user,'status'=>1))->row();
        }
        $this->data['title'] = 'Global Galaxxy Tracker | Edit Post Ads';
        $this->data['load'] = 'listing_update';
        $editid=$this->uri->segment(2);
        $this->data['view_ad']=$pages=$this->db->get_where('listing',array('userid' =>$user,'status'=>1,'id'=>$editid))->row();
        $this->form_validation->set_rules('frm[title]', 'Listing Title', 'required');
       //print_r($_POST);die;

        if ($this->form_validation->run() === TRUE) {
          $frm = $this->input->post('frm');

          $filename = array();
          //print_r($_FILES['files']);die;
   
      $count = count(array_filter($_FILES['files']['name']));
     //echo $count;die;
      if($count == 0){
        //echo $count;die;

        $namesp= explode(',', $pages->images);
        //print_r($namesp);die;
        $frm['images']= implode(',',$namesp);
        }else{
     //print_r('n');die;
      //echo $count;die;
      for($i=0;$i<$count;$i++){
    
        if(!empty($_FILES['files']['name'][$i])){
    
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];
  
          $config['upload_path'] = 'assets/images/directory/'; 
          $config['allowed_types'] = '*';
          //$config['max_size'] = '5000';
          $config['file_name'] = $_FILES['files']['name'][$i];
   
          $this->load->library('upload',$config); 
    
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename[] = $uploadData['file_name'];
          }
        }
    }
    $names= implode(',', $filename);
    $frm['images'] = $names;
          
   
    } 
            $res = $this->db->update('listing',$frm,array('userid' =>$user,'id'=>$editid));
            if($res == true){
                $this->session->set_flashdata('success', 'Listing Updated successfully !');
                 redirect(site_url('mylistings'));
            }
            else{
                $this->session->set_flashdata('error', 'Some error is occured');
                redirect(site_url('update-list/'.$editid));
            }
        }
        $this->load->front_view('default', $this->data); 
    }

    public function listing_srch() {
       $this->data['title'] = seo_page_get('sph');
       $this->data['meta_description'] = seo_page_get('spd');
        $this->data['keyword'] = seo_page_get('spk');
        $this->data['load'] = 'listing_search';
         $this->data['lat']=$lat=$this->input->post('s_lat');
         $this->data['lon']=$longi=$this->input->post('s_lon');
        $this->data['loc']=$loc=$this->input->post('loc');
        $this->data['cntry']=$cntry =$this->input->post('cntry');
        $this->data['cat']=$cat =$this->input->post('category');
        
        //print_r($loc.$cntry.$cat);die;
          $sqlh = "SELECT *, ACOS( SIN( RADIANS(lati ) ) * SIN( RADIANS( ".$lat." ) ) + COS( RADIANS(lati) ) * COS( RADIANS(  ".$lat." )) * COS( RADIANS(longi ) - RADIANS( ".$longi." )) ) * 6380 AS `distance` FROM `listing` WHERE country = '$cntry' AND category = '$cat' AND ( status = '1' OR pr_status = '1' ) AND ACOS( SIN( RADIANS( lati ) ) * SIN( RADIANS( ".$lat." ) ) + COS( RADIANS( lati ) ) * COS( RADIANS( ".$lat." )) * COS( RADIANS(longi ) - RADIANS( ".$longi." )) ) * 6380 < 150  ORDER BY distance ASC , pr_status DESC, title ASC LIMIT 9 OFFSET 0";

       // $sqlh = "SELECT * FROM `listing` WHERE (location='$loc') OR (country = '$cntry') AND (category = '$cat') AND status = 1 OR `pr_status` = 1  ORDER BY `pr_status` DESC, `title` ASC LIMIT 9";
        $this->data['checkh']=$checkh = $this->db->query($sqlh)->num_rows();
        //echo 4thi
       
       
        $this->data['chlist'] = $this->db->query($sqlh)->result(); 
       // echo $this->db->last_query();die;
        $listname = $this->input->post('list_name');
        if($listname){
            $this->data['chlist'] = $this->db->query("SELECT * FROM `listing` WHERE (`title` LIKE '%$listname' OR `title` LIKE '$listname%' OR `title` LIKE '%$listname%' ) AND status=1")->result();
            //echo $this->db->last_query();die;
        }
       $this->load->front_view('default', $this->data);
   
    }

public function listing_click() { 
       $this->data['title'] = seo_page_get('ccph');
       $this->data['meta_description'] = seo_page_get('ccpd');
        $this->data['keyword'] = seo_page_get('ccpk');
        $this->data['load'] = 'list_click';

       
        $this->data['cat']=$cat =$this->uri->segment(2);
        $this->data['cont']=$con =$this->uri->segment(2);
        if($con=='caribbean-island'){
            $con='caribbean island';
        }
        
        if($this->uri->segment(1)=='category'){
           $this->data['ct'] = $this->uri->segment(2); 
       }else{
           $this->data['cn'] = $this->uri->segment(2);
       }
       // print_r($cat);die;
        
        //$this->data['checkh']=$checkh = $this->db->query($sqlh)->num_rows();
       if($this->uri->segment(1)=='category'){
        $this->data['chlist'] = $this->db->limit(9)->get_where('listing',array('category'=>$cat))->result();
        }else if($this->uri->segment(1)=='country'){
          $this->data['chlist'] = $this->db->limit(9)->get_where('listing',array('country'=>$con))->result();  
        }
       $this->load->front_view('default', $this->data);
   
    }


function loadCountCat(){
    $count= $this->input->post('c');
    $count1 = $count-1;
    $offset = $count1 * 9;
    $type = $this->input->post('type');
    $where = $this->input->post('where');
   
    $this->data['scrollId'] = $count;
    
    if($type=='country'){
        $list = $this->db->limit(9,$offset)->order_by('pr_status','desc')->get_where('listing',array('country'=>$where,'status'=>1))->result(); 
    }else{
        $list = $this->db->limit(9,$offset)->order_by('pr_status','desc')->get_where('listing',array('category'=>$where,'status'=>1))->result(); 
    }
    
   $this->data['chlist'] = $list;
   return $this->load->front_view('catconsearch', $this->data);
    
}


function checkAjaxSearchloadmore(){
    $count= $this->input->post('c');
    $count1 = $count-1;
    $offset = $count1 * 9;
    $category = $this->input->post('tmp_catr');
    $country = $this->input->post('tmp_conr');
   
    $this->data['scrollId'] = $count;
    
    $wh = '';
    $wh2 = '';
    
    $countr = explode(",",$country);
    if(!empty($country)){  
    if(is_array($countr)){
        $con = implode("','",$countr);
        $wh = "and country in ('".$con."') ";
    }else{
        $con = $country;
        $wh = "and country in ('".$country."')";
    }
    }
    
    $cate = explode(",",$category);
    if(!empty($category)){
    if(is_array($cate)){
        $cat = implode("','",$cate);
        $wh2 = "and category in ('".$cat."') ";
    }else{
        $cat = $category;
        $wh2 = "and category in ('".$category."') ";
    }
    }
    $list = $this->db->query("SELECT * FROM listing WHERE  id!='' " .$wh.$wh2." order by pr_status desc limit ".$offset.",9")->result();
    //echo $this->db->last_query();die;
    $this->data['chlist'] = $list;
   return $this->load->front_view('catconsearch', $this->data);
    
}


public function sign_out()
{
    $this->session->unset_userdata('fouserid');
    $this->session->unset_userdata('userids');
    $this->session->sess_destroy();
    $this->session->set_flashdata('success', 'Logout successfully');

    redirect(site_url(''));
}

function error_page() {
    $this->data['title'] = 'Global Galaxxy Tracker | 404-error';
    $this->data['header'] = '404-error ';
    $this->data['load'] = '404';

    $this->load->front_view('default', $this->data);
}




}
