<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends AI_Controller {

    function __construct() {
        parent::__construct();
        $this->data['title'] = '';
        $this->load->model('Master_model'); 
    }

    public function index() { 
        $this->data['title'] = "Home | Keteke"; 
        $this->data['load'] = 'home';
// $this->data['category']=$this->db->query("SELECT distinct category.*, listing_category.id,listing_category.name from category,listing_category where category.id=listing_category.catid")->result();
        $this->data['category']=$this->db->order_by('id','desc')->get_where('category',array('status'=>1))->result();
        $this->data['coupons']=$this->db->limit(6)->get_where('coupon_details',array('coupon_status'=>1))->result();

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
            $searchSql = "SELECT *, ( 6367 * acos( cos( radians('".$lat."') ) * cos( radians( `lati` ) ) * cos( radians( `longi` ) - radians('".$lon."') ) + sin( radians('".$lat."') ) * sin( radians( `lati` ) ) ) ) AS distance FROM `listing` having `distance` < 500  AND (status = '1' OR prefer_list = '1' ) ORDER BY  distance ASC LIMIT 3";
            $this->data['chlist'] = $this->db->query($searchSql)->result(); 
        }

        $this->load->front_view('default', $this->data);
    }
    public function faq() {

        $this->data['load'] = 'faq';
        $this->data['faq'] = $this->db->get_where('faqs',array('status'=>1))->result();
        $this->load->front_view('default', $this->data);
    }
    public function how_work() { 

        $this->data['load'] = 'how_it_work';
        $this->load->front_view('default', $this->data);
    }
    public function about_us() { 
        $this->data['title'] = "Keteke | About Us";
        $this->data['load'] = 'about';
        $this->data['aboutcms']=$this->Master_model->getAll_where('cms','id',7);
        $this->data['whycms']=$this->Master_model->getAll_where('cms','id',8);
        $this->load->front_view('default', $this->data); 
    }
    public function search_list() { 
        $this->data['title'] = "Keteke | Listing";
        $this->data['load'] = 'srch_listing';
        if(isprologin()){
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getAll_where('user_accounts','user_id',$user);
        }
        $latitude=$this->input->post('s_lat');
        $longitude=$this->input->post('s_lon');
        $loc= $this->input->post('location');     
        $scat= $this->input->post('sr_category');
        $radius=500;
        if($scat !='')
        {
            $srcharray=array('user_id' =>@$user,
                'business_id'=>$scat,
                'search_date'=>date('Y-m-d h:i:s')
            );
            $this->Master_model->save($srcharray,'search_history');

           if($loc !="" && $scat !='') {

            $searchSql = "SELECT *, ( 6367 * acos( cos( radians($latitude) ) * cos( radians( sr.lati ) ) * cos( radians( sr.longi ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( sr.lati )))) AS distance FROM `listing` AS sr JOIN category AS ca ON sr.category=ca.id JOIN user_accounts AS ua ON sr.userid=ua.user_id  having `distance` < 500 AND sr.status ='1' AND (sr.category='".$scat."' OR sr.category='%".$scat."%' OR ca.name LIKE '%".$scat."%') OR (sr.title LIKE '%".$scat."%' OR ua.user_fname LIKE '%".$scat."%' OR ua.user_lname LIKE '%".$scat."%') OR (sr.busi_classi LIKE '%".$scat."%') OR (sr.keywords LIKE '%".$scat."%') ORDER BY distance ASC";
            }
            else if($loc !=""){

            $searchSql = "SELECT *, ( 6367 * acos( cos( radians($latitude) ) * cos( radians( sr.lati ) ) * cos( radians( sr.longi ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( sr.lati )))) AS distance FROM `listing` AS sr JOIN category AS ca ON sr.category=ca.id JOIN user_accounts AS ua ON sr.userid=ua.user_id  having `distance` < 500 AND sr.status ='1'";
           
        } else if($scat != '') {

            $searchSql = "SELECT * FROM `listing` AS sr JOIN category AS ca ON sr.category=ca.id JOIN user_accounts AS ua ON sr.userid=ua.user_id WHERE sr.status ='1' AND (sr.category='".$scat."' OR sr.category='%".$scat."%' OR ca.name LIKE '%".$scat."%') OR (sr.title LIKE '%".$scat."%' OR ua.user_fname LIKE '%".$scat."%' OR ua.user_lname LIKE '%".$scat."%') OR (sr.busi_classi LIKE '%".$scat."%') OR (sr.keywords LIKE '%".$scat."%') ORDER BY sr.id DESC";
            
        }
        $this->data['businesslist'] = $this->db->query($searchSql)->result();
        // $this->db->last_query();die;
        }
        $this->load->front_view('default', $this->data);
    }
    function contact(){
        $this->data['title'] = "Reach Us | Keteke";
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
                'field' => 'frm[subject]',
                'label' => 'Subject',
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
                $subject = "Enquiry Message From Keteke";
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
                <td colspan='2' style='padding:20px 0'><h3 style='margin;0;color:green'>Dear Admin,</h3>
                <p>A new Enquiry message for Keteke. Kindly check the below complete information of the Candidate.</p>
                </td>
                </tr>
                <tr>
                <td style='height:35px;'><h4 style='margin:0 '>Enquiry Detail</h4></td>
                </tr>
                <tr>
                <td style='width:50%;padding:0;vertical-align:top'>
                <p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px'>Name</span> ".$formdata['name']."</p>
                <p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Email</span> ".$formdata['email']."</p>
                <p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Subject</span> ".$formdata['subject']."</p>

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
                $email="info@keteke.net";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
                $headers .= 'From: KETEKE CONTACT PAGE' . "\r\n";

                mail($email,$subject,$htmlContent,$headers);
                $this->session->set_flashdata('success', 'Thank You!! We will get back to you soon.');
                redirect(site_url('reach'));
            }
            else{
                echo"Not sent";
                $this->session->set_flashdata('error', 'Some error has occured.');
            }
        }
        $this->load->front_view('default', $this->data);
    } 


    public function terms() {
        $this->data['title'] = 'Keteke | Terms & Conditions';
        $this->data['load'] = 'term';
        $this->data['term'] = $this->Master_model->getAll_where('cms','id',4);
        $this->load->front_view('default', $this->data);
    }

    public function privacy() {
        $this->data['title'] = 'Keteke | Privacy Policy';
        $this->data['load'] = 'privacy';
        $this->data['privcy'] = $this->Master_model->getAll_where('cms','id',3);
        $this->load->front_view('default', $this->data);
    }
    public function refundpolicy() {
        $this->data['title'] = 'Keteke | Refund Policy';
        $this->data['load'] = 'refund';
        $this->data['refpolicy'] = $this->Master_model->getAll_where('cms','id',6);
        $this->load->front_view('default', $this->data);
    }

    public function newsletter() {
        $email=$this->input->post('email');
        $arr = array('email'=>$email);
        $rows = $this->db->get_where('newsletter',array('email'=>$email))->num_rows();
        if($rows >0){
            echo 1;
        } else {
            $this->db->insert('newsletter',$arr);
            echo 0;
        }
    }
    public function checkvalidmail() {
        $email=$this->input->post('foremail');
        $arr = array('email'=>$email);
        $rows = $this->db->get_where('user_accounts',array('user_emailid'=>$email,'user_status'=>1))->num_rows();
        if($rows >0){
            echo 1;
        } else {
            echo 0;
        }
    }


    public function login_ajax()
    {
        $this->data['title'] = 'Keteke | Login';
        $this->data['load'] = 'login_signup';
        $this->form_validation->set_rules('umail', 'Email', 'required');
        $this->form_validation->set_rules('upass', 'Email', 'required');
        if($this->form_validation->run()) {
            $mail = $this->input->post('umail');
            $pass = base64_encode($this->input->post('upass'));
            $sql = "SELECT * FROM `user_accounts` WHERE (user_emailid = '$mail' AND user_pasword='$pass') AND user_status = 1";
            $check = $this->db->query($sql)->num_rows();
            $user = $this->db->query($sql)->row();
            if($check > 0){
                $this->session->set_userdata('userids',$user->user_id);
                $this->session->set_userdata('u_type',$user->u_type);
                if($user->u_type==1 || $user->u_type==2)
                {
                    redirect(site_url('myprofile'),'refresh');
                } else if($user->u_type==3){

                    redirect(site_url('seller-dashboard'),'refresh');
                }
                else
                {
                    redirect(site_url('userdashboard'),'refresh');
                }
            }
            else{
                $this->session->set_flashdata('error', 'Invalid Email/Password'); 
            }
        }
        $this->load->front_view('default', $this->data); 
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
        <td valign='middle' style='color:white;'><img src='" . base_url() . "fassets/images/logo.png' alt='Keteke' title='Keteke Logo' height='100px' /></td>
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
        Keteke <br><br>
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
        $this->email->from('Keteke Team');
        $this->email->to($mail);

        $this->email->subject('Your Password');

        $this->email->message($htmlContent);

        $this->email->send(); 
    }


    public function signin_signup(){

        $this->data['title'] = 'Keteke | SignIn Or SignUp';
        $this->data['load'] = 'login_signup';
        $this->form_validation->set_rules('fname', 'First name cannot be empty ', 'required');
        $this->form_validation->set_rules('lname', 'Last name cannot be empty', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('con_password', 'Confirm Password', 'required|matches[password]');
//print_r($_POST);die;
        if($this->form_validation->run() === TRUE) {
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $u_type=$this->input->post('u_type');
            $check_email = $this->db->get_where('user_accounts',array('user_emailid'=>$email,'user_status'=>1))->num_rows();
            if($check_email>0){
                $this->session->set_flashdata('error', 'The email address is already in use. Login if you already have an account or create a new account');
                redirect(site_url('signup'));
            }else{
                $arr = array(
                    'user_fname'=>$fname, 
                    'user_lname'=>$lname, 
                    'user_emailid'=>$email,
                    'user_pasword'=>base64_encode($password),
                    'user_status'=>1,
                    'created_at'=>date('Y-m-d h:i:s'),
                    'u_type'=>$u_type
                );
                $res = $this->db->insert('user_accounts',$arr);

                if($res == true){
                    $subject = "Successfully Registered | Keteke";
                    $htmlContent = "
                    <body style='background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;'>
                    <table style='max-width:800px;margin:20px auto 10px;background-color:#fff;padding:20px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #000000;'>
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
                    <td colspan='2' style='padding:20px 0'><h3 style='margin;0;color:green'>Dear ".$fname.",</h3>
                    <p>Thank You for registering to KETEKE</p>
                    </td>
                    </tr>
                    <tr>
                    <td style='height:35px;'><h4 style='margin:0 '>Login Details</h4></td>
                    </tr>
                    <tr>
                    <td style='width:50%;padding:0;vertical-align:top'>

                    <p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Email</span> ".$email."</p>
                    <p style='margin:0 0 10px 0;padding:0;font-size:14px;'><span style='display:block;font-weight:bold;font-size:13px;'>Password</span> ".$password."</p>

                    </td>
                    </tr>

                    <tr>
                    <td style='height:15px;'>
                    <br>
                    Best Regards,<br>
                    Keteke <br><br>
                    This is an automated response, please DO NOT reply.
                    </td>
                    </tr>

                    </tbody>
                    </table>
                    </body>
                    ";

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
                    $headers .= 'From: KETEKE Signup Page' . "\r\n";

                    mail($email,$subject,$htmlContent,$headers);

                    $this->session->set_flashdata('success', 'Thank you for Registration!!');
                    redirect(site_url('signup'));
                }
                else{
                    $this->session->set_flashdata('error', 'Registration Failed..Please Try again');
                }
            }
        }
        $this->load->front_view('default', $this->data);
    }

    public function list_details($slug,$page=1) {

        $this->data['load'] = 'list_detail';
        $this->data['list_detl'] = $det = $this->db->get_where('listing',array('slug'=>$slug))->row();
//echo $this->db->last_query();die;
        $this->data['title'] = $det->title. " | Keteke";
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
        $this->data['title'] = 'Keteke | Listings';
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
        $this->data['title'] = 'Keteke | My Profile';
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
        $this->data['title'] = 'Keteke | Change Password';
        $this->data['load'] = 'change_pass';
        if(!isprologin()){
            redirect(site_url());
        }
        if(isprologin()){
            $user = userid2();
            $this->data['udetail'] = $this->db->get_where('user_accounts',array('user_id'=>$user,'user_status'=>1))->row();
        }
        $this->form_validation->set_rules('new_pass', 'New Password', 'required');
        $this->form_validation->set_rules('con_pass', 'Confirm password', 'required|matches[new_pass]');

        if ($this->form_validation->run() == TRUE) {
            $new_pass=base64_encode($this->input->post('new_pass'));
            $confirm_pass=base64_encode($this->input->post('con_pass'));
            if ($new_pass==$confirm_pass) {
                $this->db->where('user_id',$user)->update('user_accounts',array('user_pasword'=>$confirm_pass));
//echo $this->db->last_query();die;
                $this->session->set_flashdata("success", "Password Changed Successfully");
                redirect(site_url('change-password'));
            }else{
                $this->session->set_flashdata('error', 'New password confirm password does not matched');
                redirect(site_url('change-password'));
            }
        }
        $this->load->front_view('default', $this->data);
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
        $this->data['title'] = 'Keteke | 404-error';
        $this->data['header'] = '404-error ';
        $this->data['load'] = '404';

        $this->load->front_view('default', $this->data);
    }
    function getreviewsubmit() {
        $rstar=$this->input->post('rstar');
        $rname=$this->input->post('rname');
        $ruserid=$this->input->post('ruserid');
        $rlistid=$this->input->post('rlistid');
        $rvsub=$this->input->post('rvsub');
        $rcmnts=$this->input->post('rcmnts'); 

        $arrreview = array('user_id'=>$ruserid,
            'business_id'=>$rlistid,
            'username'=>$rname,
            'rating'=>$rstar,
            'subject'=>$rvsub,
            'comments'=>$rcmnts,
            'added_date'=>date('Y-m-d H:i:s'));
        $rvinsert= $this->db->insert('user_listreview',$arrreview);
        if($rvinsert==TRUE){
            echo 1;
        } else {
            echo 0;
        }
    }
    function getmsgsubmit(){

        $mname=$this->input->post('mname');
        $muserid=$this->input->post('muserid');
        $mlistid=$this->input->post('mlistid');
        $memail=$this->input->post('memail');
        $mphone=$this->input->post('mphone');
        $mcmnts=$this->input->post('mcmnts');

        $arrremessage = array('userid'=>$muserid,
            'business_id'=>$mlistid,
            'fname'=>$mname,
            'email'=>$memail,
            'mobile'=>$mphone,
            'descr'=>$mcmnts,
            'created_at'=>date('Y-m-d H:i:s'));
        $msginsert= $this->db->insert('business_message',$arrremessage);
        if($msginsert==TRUE){
            echo 1;
        } else {
            echo 0;
        } 
    }
    function get_moreReview(){
        $listid=$this->input->post('reviewmsglistid');
        $datareviewlist=$this->db->query("SELECT * FROM listing as lst JOIN user_listreview AS rv ON rv.business_id=lst.id WHERE rv.business_id='".$listid."'")->result();
//$datareviewlist=$this->db->get_where('user_listreview',array('business_id'=>$listid))->result();
        $to_time = strtotime($datareviewlist[1]->response_date);
        $from_time = strtotime(date('Y-m-d H:i:s'));
        $val= round(abs($to_time - $from_time) / 60);

        if($val>60)
        {
            $h=round($val/60);
            if($h<=24)
            {
                $diff='More than '.$h.' hour ago ';
            }
            else{
                $d=  round($h/24);
                $diff='More than '.$d.' day ago ';
            }
        }
        else{
            $diff=$val.' minute ago';
        }
        $data= array(
            'res'=> $datareviewlist,
            'restime'=>$diff

        );
        echo json_encode($data);
    }

    function get_moreReviewbyOrder(){
        $reviewordby=$this->input->post('revieword');
        $listid=$this->input->post('businessid');
        if($reviewordby=="new"){
            $datareviewlistorder=$this->db->query("SELECT * FROM listing as lst JOIN user_listreview AS rv ON rv.business_id=lst.id WHERE rv.business_id='".$listid."' ORDER BY rv.id DESC")->result();
            $to_time = strtotime($datareviewlistorder[1]->response_date);
        }else if($reviewordby=="high"){
            $datareviewlistorder=$this->db->query("SELECT * FROM listing as lst JOIN user_listreview AS rv ON rv.business_id=lst.id WHERE rv.business_id='".$listid."' ORDER BY rv.rating DESC")->result();

            $to_time = strtotime($datareviewlistorder[1]->response_date);
        }else if($reviewordby=="low"){
            $datareviewlistorder=$this->db->query("SELECT * FROM listing as lst JOIN user_listreview AS rv ON rv.business_id=lst.id WHERE rv.business_id='".$listid."' ORDER BY rv.rating ASC")->result();
            $to_time = strtotime($datareviewlistorder[1]->response_date);
        }

        $from_time = strtotime(date('Y-m-d H:i:s'));
        $val= round(abs($from_time - $to_time) / 60);
        if($val>60)
        {
            $h=round($val/60);
            if($h<=24)
            {
                $diff='More than '.$h.' hour ago ';
            }
            else{
                $d=  round($h/24);
                $diff='More than '.$d.' day ago ';
            }
        }
        else{
            $diff=$val.' minute ago';
        }

        $data= array(
            'res'=> $datareviewlistorder,
            'restime'=>$diff

        );
        echo json_encode($data);
    }

    public function replytextfromOwner() {
        $reviewid=$this->input->post('reviewid');
        $responsetext=$this->input->post('responsetext');
        $arres = array('response_text'=>$responsetext,'response_date'=>date('Y-m-d H:i:s'));
        $rows = $this->db->update('user_listreview',$arres,array('id'=>$reviewid));
        if($rows >0){
            echo 1;
        } else {
            echo 0;
        }
    }


}
