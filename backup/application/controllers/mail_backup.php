 $email = $this->input->post("forgetemail");
        $get_details = $this->db->query("SELECT * FROM user_accounts WHERE user_emailid='".$email."' AND user_status=1")->row();

        if (!empty($get_details)) {
            $name = $get_details->user_fname;
            $id = base64_encode($get_details->user_id);
            $frmemail=theme_option('email');

           
            $subject = 'Forgot password recovery';
            $headers = "From: " . 'KETEKE <$frmemail>' . "\r\n"; 
            $headers .= "Reply-To: " . strip_tags('$frmemail') . "\r\n"; 
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    
            $htmlContent = "<table align='center' style='width:650px; text-align:center; background:#F9F9F9;'>
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
            <p>Dear ".$name.", <br>
            <p>You are requesting for forgot password.<br><br>
            Please click below link to update your password:<br><br>
            <a href=".base_url('update-forgot-password/'.$id)." target='blank'><b>click here</b></a><br><br>
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
                            
            if( mail($email, $subject, $htmlContent, $headers)){
                $this->session->set_flashdata("success", "Please check your mail!");
                redirect(site_url('forgot-password'));
            }else{
               $this->session->set_flashdata("error", "Something Went Wrong!");
               redirect(site_url('forgot-password'));
            }
        }