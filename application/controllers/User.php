<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends AI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->data['title'] = '';
        $this->load->model('Master_model');
    }
    public function index()
    {
        $this->data['title'] = "My Dashboard | Keteke";
        $this->data['load'] = 'user_dash';
        if (isprologin()) {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $this->load->front_view('default', $this->data);
    }
    public function listingcreate()
    {
        $userrol = userrole();
        if ($userrol != 1 && $userrol != 2 && $userrol != 3) {
            $this->session->set_flashdata('errorlist', 'Login or Sign up to list your business');
            redirect(site_url('login'));
        } else {
            $user = userid2();
            $this->data['udetail'] = $udetl = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
            $this->data['title'] = 'Keteke | List Your Business';
            $this->data['load'] = 'listing_create';
            $this->data['category'] = $this->db->order_by('id', 'desc')->get_where('category', array('status' => 1))->result();
            $this->data['countries'] = $this->db->get_where('country', array('status' => 1))->result();
            $ip = $_SERVER["REMOTE_ADDR"];
            $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
            if ($query && $query['status'] == 'success') {
                $country = $query['country'];
                $state = $query['regionName'];
                $city = $query['city'];
                $lat = $query['lat'];
                $lon = $query['lon'];
                $this->data['lat'] = $lat;
                $this->data['lon'] = $lon;
                $this->data['loc'] = $city . ',' . $state . ',' . $country;
            }
            $this->form_validation->set_rules('frm[title]', 'Business Name', 'required');
            $this->form_validation->set_rules('frm[category]', 'Business Classification', 'required');
            $this->form_validation->set_rules('frm[keywords]', 'Keywords', 'required');
            $this->form_validation->set_rules('frm[street_addr]', 'Street Address', 'required');
            $this->form_validation->set_rules('frm[city]', 'City Name', 'required');
            $this->form_validation->set_rules('frm[country]', 'Country Name', 'required');
            $this->form_validation->set_rules('frm[email]', 'Company Email', 'required');
            $this->form_validation->set_rules('frm[phone]', 'Phone Number', 'required');
            if ($this->form_validation->run() === TRUE) {
                $frm = $this->input->post('frm');
                $config['upload_path'] = 'assets/images/directory/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('blogo')) {
                    $data = $this->upload->data();
                    $frm['images'] = $data['file_name'];
                }
                $frm['userid'] = $user;
                $frm['status'] = 1;
                $frm['created'] = date("Y-m-d h:i:s");
                $res = $this->db->insert('listing', $frm);
                if ($res == true) {
                    $this->session->set_flashdata('success', 'Business Listing Submitted successfully!');
                    $subject = "Business Listing Successfully | Keteke";
                    $htmlContent = "<body style='background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;'><table style='max-width:800px;margin:20px auto 10px;background-color:#fff;padding:20px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px #000000;'><thead><tr><th style='text-align:left;'><img style='max-width: 150px;' src='" . site_url('fassets/images/logos/headertransparentlogo.png') . "' alt='Keteke'></th><th style='text-align:right;font-weight:400;'>" . date('d M Y') . "</th></tr></thead><tbody><tr><td colspan='2' style='height:2px;background:#232323'></td></tr><tr><td colspan='2' style='padding:20px 0'><h3 style='margin;0;color:green'>Dear " . $udetl->user_fname . ",</h3><p>One business successfully added to KETEKE</p></td></tr><tr><td style='height:15px;'><br>Best Regards,<br>Keteke <br><br>This is an automated response, please DO NOT reply.</td></tr></tbody></table></body>";
                    $email = $udetl->user_emailid;
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    // More headers
                    $headers .= 'From: KETEKE Business Listing Page' . "\r\n";
                    redirect(site_url('list-your-business'));
                } else {
                    $this->session->set_flashdata('error', 'Some error has occured');
                    redirect(site_url('list-your-business'));
                }
            }
        }
        $this->load->front_view('default', $this->data);
    }
    public function view_listing()
    {
        $this->data['title'] = "Keteke | My Listings";
        $this->data['load'] = 'listing';
        if (isprologin()) {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $this->data['listings'] = $this->db->get_where('listing', array('userid' => $user, 'status' => 1))->result();
        $this->load->front_view('default', $this->data);
    }
    public function edit_listing()
    {
        if (!isprologin()) {
            redirect(site_url());
        }
        if (isprologin()) {
            $user = userid2();
            $this->data['udetail'] = $this->db->get_where('user_accounts', array('user_id' => $user, 'user_status' => 1))->row();
        }
        $this->data['title'] = 'Keteke | Edit Post Ads';
        $this->data['load'] = 'listing_update';
        $this->data['subcategory'] = $this->db->get_where('listing_category', array('status' => 1))->result();
        $this->data['countries'] = $this->db->get_where('country', array('status' => 1))->result();
        $this->data['category'] = $this->db->order_by('id', 'desc')->get_where('category', array('status' => 1))->result();
        $editid = $this->uri->segment(2);
        $this->data['view_ad'] = $pages = $this->db->get_where('listing', array('userid' => $user, 'status' => 1, 'id' => $editid))->row();
        $this->form_validation->set_rules('frm[title]', 'Business Name', 'required');
        $this->form_validation->set_rules('frm[category]', 'Business Classification', 'required');
        $this->form_validation->set_rules('frm[keywords]', 'Keywords', 'required');
        $this->form_validation->set_rules('frm[street_addr]', 'Street Address', 'required');
        $this->form_validation->set_rules('frm[city]', 'City Name', 'required');
        $this->form_validation->set_rules('frm[country]', 'Country Name', 'required');
        $this->form_validation->set_rules('frm[email]', 'Company Email', 'required');
        $this->form_validation->set_rules('frm[phone]', 'Phone Number', 'required');
        if ($this->form_validation->run() === TRUE) {
            $frm = $this->input->post('frm');
            $config['upload_path'] = 'assets/images/directory/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('blogo')) {
                $data = $this->upload->data();
                $frm['images'] = $data['file_name'];
            }
            $res = $this->db->update('listing', $frm, array('userid' => $user, 'id' => $editid));
            if ($res == true) {
                $this->session->set_flashdata('success', 'Business details updated successfully !');
                redirect(site_url('mylistings'));
            } else {
                $this->session->set_flashdata('error', 'Some error is occured');
                redirect(site_url('update-list/' . $editid));
            }
        }
        $this->load->front_view('default', $this->data);
    }
    function listing_delete($id)
    {
        if ($id > 0) {
            $this->Master_model->delete($id, 'listing');
            $this->session->set_flashdata('success', 'row deleted successfully.');
        }
        redirect(site_url('mylistings'));
    }
    public function search_history()
    {
        $this->data['title'] = "Keteke | Search";
        $this->data['load'] = 'search_history';
        $this->load->front_view('default', $this->data);
    }
    public function userorders()
    {
        $this->data['title'] = "Keteke | My Orders";
        $this->data['load'] = 'user_orders';
        if (isprologin()) {
            $user = userid2();
            $this->data['udetail'] = $this->db->get_where('user_accounts', array('user_id' => $user))->row();
        }
        $this->data['myorderslist'] = $this->db->get_where('productorders', array('userid' => $user, 'payment_status' => 1))->result();
        $this->load->front_view('default', $this->data);
    }
    public function userdraftorders()
    {
        $this->data['title'] = "Keteke | My Draft Orders";
        $this->data['load'] = 'user_draft_orders';
        if (isprologin()) {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $this->data['mydraftorderslist'] = $this->Product_model->getAlluserdraftOrders($user);
        //echo $this->db->last_query();die;
        $this->load->front_view('default', $this->data);
    }
    public function edit_profile()
    {
        $this->data['title'] = "Keteke | Edit Profile";
        $this->data['load'] = 'profile';
        if (!isprologin()) {
            redirect(site_url());
        }
        if (isprologin()) {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $this->form_validation->set_rules('frm[user_fname]', 'First Name', 'required');
        if ($this->form_validation->run() === TRUE) {
            $frm = $this->input->post('frm');
            $config['upload_path'] = 'assets/images/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('profile_pic')) {
                $data = $this->upload->data();
                $frm['image'] = $data['file_name'];
            }
            $res = $this->db->update('user_accounts', $frm, array('user_id' => $user));
            if ($res == true) {
                $this->session->set_flashdata('success', 'Your Profile updated successfully !');
                redirect(site_url('myprofile'));
            } else {
                $this->session->set_flashdata('error', 'Some error is occured');
                redirect(site_url('myprofile'));
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
    function error_page()
    {
        $this->data['title'] = 'Keteke | 404-error';
        $this->data['header'] = '404-error ';
        $this->data['load'] = '404';
        $this->load->front_view('default', $this->data);
    }
    function getsubcatbycatid()
    {
        $catid = $this->input->post('catg');
        $option = $this->db->get_where('listing_category', array('catid' => $catid))->result();
        $ht = '';
        if (is_array($option) && count($option) > 0) {
            foreach ($option as $op) {
                $ht .= '<option value="' . $op->id . '">' . $op->name . '</option>';
            }
        } else {
            $ht .= '<option value="">No data found</option>';
        }
        echo $ht;
    }
    function forget_password()
    {
        $this->data['title'] = 'Keteke | Forgot Password';
        $this->data['load'] = 'forget_pass';
        $this->load->front_view('default', $this->data);
    }
    public function sendForgetMail()
    {
        $email = $this->input->post("forgetemail");
        $get_details = $this->db->query("SELECT * FROM user_accounts WHERE user_emailid='" . $email . "' AND user_status=1")->row();
        if (!empty($get_details)) {
            $name = $get_details->user_fname;
            $id = base64_encode($get_details->user_id);
            $frmemail = theme_option('email');
            $subject = 'Forgot password recovery';
            $headers = "From: " . 'KETEKE <$frmemail>' . "\r\n";
            $headers .= "Reply-To: " . strip_tags('$frmemail') . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $htmlContent = "<table align='center' style='width:650px; text-align:center; background:#F9F9F9;'>
        <tbody>
        <tr style='height:50px;background-color:#f2f2f2;'><td valign='middle' style='color:white;'><img src='" . site_url() . "fassets/images/logos/headertransparentlogo.png' alt='KETEKE' title='Keteke'  style='width:210px;height:auto' /></td></tr>
        <tr>
        <td valign='top' align='center' colspan='2'>
        <table align='' style='height:380px; color:#000; width:600px;'>
        <tbody>
        <td valign='top' align='' colspan='2'>
        <table align='' style='color:#000; width:600px;'>
        <tbody>
        <br>
        <p>Dear " . $name . ", <br>
        <p>You are requesting for forgot password.<br><br>
        Please click below link to update your password:<br><br>
        <a href=" . base_url('update-forgot-password/' . $id) . " target='blank'><b>click here</b></a><br><br>
        Thank You,<br><br>
        Keteke Team </p><br>
        </tbody>
        </table>
        <strong>Email: </strong>" . $frmemail . "<br><br>
        This is an automated response, please <b>DO NOT</b> reply.
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>";
            // $config = Array(
            //     'protocol' => 'smtp',
            //     'smtp_host' => 'ssl://smtp.googlemail.com',
            //     'smtp_port' => 465,
            //     'smtp_user' => 'no-reply@goigi.com',
            //     'smtp_pass' => 'b6wb]gJ-_tG},9FW',
            //     'charset'   => 'iso-8859-1'
            // );
            // $this->load->library('email', $config);
            // $this->email->set_newline("\r\n");
            // $this->email->to($email);
            // $this->email->from($frmemail, 'Keteke Team');
            // $this->email->subject($subject);
            // $this->email->message($htmlContent);
            // $this->email->set_mailtype("html");
            if (mail($email, $subject, $htmlContent, $headers)) {
                $this->session->set_flashdata("success", "Please check your mail!");
                redirect(site_url('forgot-password'));
            } else {
                $this->session->set_flashdata("error", "Something Went Wrong!");
                redirect(site_url('forgot-password'));
            }
        }
    }
    public function update_password($id)
    {
        $this->data['title'] = 'Keteke | Update Forgot Password';
        $this->data['load'] = 'update_forget_pass';
        $this->data['user_id'] = $id;
        $this->load->front_view('default', $this->data);
    }
    public function up_pass($id)
    {
        $user_id = base64_decode($id);
        $this->form_validation->set_rules('password', 'New Password', 'trim|required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
        if ($this->form_validation->run() != false) {
            $password = $this->input->post("password");
            $passch = array('user_pasword' => base64_encode($password));
            $up_pass = $this->db->update('user_accounts', $passch, array('user_id' => $user_id));
            if ($up_pass > 0) {
                $this->session->set_flashdata("success", "Password Updated successfully!");
                redirect('login');
            } else {
                $this->session->set_flashdata("error", "Something went wrong!");
                redirect('update-forgot-password/' . $id);
            }
        }
    }
    public function return_order($orderId = false, $productId = false)
    {
        $this->data['title'] = 'Keteke | Return Order';
        $this->data['load'] = 'user_return_product';
        if (isprologin()) {
            $user = userid2();
            $this->data['udetail'] = $this->Master_model->getSingleRow('user_id', $user, 'user_accounts');
        }
        $this->data['orderId'] = $orderId;
        $this->data['productId'] = $productId;
        $this->data['product'] = $this->Master_model->getSingleRow('productId', $productId, 'products');
        $this->load->front_view('default', $this->data);
    }
    public function return_order_success($orderId = false)
    {
        $ordId = base64_decode($orderId);
        $this->form_validation->set_rules('return_reason', 'Reason ', 'trim|required');
        if ($this->form_validation->run() != false) {
            $updarr = array(
                'order_status' => 'returned',
                'return_reason' => $this->input->post('return_reason'),
                'return_date' => date('Y-m-d H:i:s')
            );
            $return = $this->db->update('productorders', $updarr, array('id' => $ordId));
            if ($return) {
                $this->session->set_flashdata("success", "Order Return successfully!");
                redirect('user/return_order/' . $orderId);
            } else {
                $this->session->set_flashdata("error", "Something went wrong!");
                redirect('user/userorders');
            }
        }
    }
}
