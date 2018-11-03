<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 * 
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013 FusionInvoice, LLC
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.com
 * 
 */
function ShowError($message){
    echo '<h2 style="text-align:center;color:red;">'.$message.'</h2>';
}
class Sessions extends Base_Controller {

    public function index()
    {   
        redirect('sessions/login');
    }

    public function login()
    {
        if ($this->input->post('btn_login'))
        {
            if ($this->authenticate($this->input->post('email'), $this->input->post('password')))
            {
                if ($this->session->userdata('user_type') == 1)
                {
                    $_SESSION["email"]=$this->input->post('email');
                    redirect('dashboard');
                }
                elseif ($this->session->userdata('user_type') == 2)
                {
                    redirect('guest');
                }
            }
        }
        if($this->input->post('btn_register')){
            redirect('sessions/registration');
        }
        $data = array(
            'login_logo' => $this->mdl_settings->setting('login_logo')
        );

        $this->load->view('session_login', $data);
    }
    
    public function registration()
    {
         if ($this->input->post('btn_backlogin'))
        {
             redirect('sessions/login');
            
        }
        if ($this->input->post('btn_register'))
        {
            if($this->input->post('rules')){
            if($this->input->post('email')==$this->input->post('emailR')){
                if($this->input->post('password')==$this->input->post('passwordR')){
                    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $this->input->post('password')))
                    {
                        ShowError('The password does not meet the requirements!');
                    }else{
                    $email=$this->input->post('email');
                    $this->db->where('user_email', $email);
                    $query=$this->db->get('fi_users');
                    foreach ($query->result_array() as $row)
                    {
                    if(isset($row))
                    {
                    $checkForEmail=false;    
                    }else{
                    $checkForEmail=true;
                    }
                    }
                    if($checkForEmail==true){
                    $data = array(
                        'user_id' => NULL,
                        'user_type' => 1,
                        'user_date_created' => date("Y-m-d H:i:s"),
                        'user_email' => $this->input->post('email'),
                        'user_password' => md5($this->input->post('password'))
                     );
                    $this->db->insert('fi_users', $data);
                    }else{
                     ShowError('Email already exists');   
                    }
                    //redirect('sessions/login');
                    }
                    
                }else{
                ShowError ("Passwords not match");
                }
            }else{
            ShowError ("Emails not match");
            }
            }else{
                ShowError ("You are not agree with our rules");
            }
        }
        $this->load->view('register');
  
        
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('sessions/login');
    }

    public function authenticate($email_address, $password)
    {
        $this->load->model('mdl_sessions');

        if ($this->mdl_sessions->auth($email_address, $password))
        {
            return TRUE;
        }

        return FALSE;
    }

}

?>