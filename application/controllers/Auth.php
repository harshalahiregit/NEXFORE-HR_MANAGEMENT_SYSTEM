<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
    }

    public function login()
    {
        $data = [];

        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password')); 

            $user = $this->db
                ->where('email', $email)
                ->where('password', $password)
                ->get('users')
                ->row();

            if ($user) {
                $this->session->sess_regenerate(TRUE);

                $this->session->set_userdata([
                    'admin_logged_in' => true,
                    'user_id'         => $user->id,
                    'user_email'      => $user->email
                ]);

                redirect('dashboard'); 
            } else {
                $this->session->set_flashdata('error', 'Invalid Email or Password');
                redirect('auth/login');
            }
        } else {
            $this->load->view('auth/login', $data);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(['admin_logged_in', 'user_id', 'user_email']);
        $this->session->sess_destroy(); 
        redirect('auth/login');
    }
}
