<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $data['error'] = '';

        if ($this->form_validation->submitted()) {
            $email = trim($this->io->post('email'));
            $role = $this->io->post('role');

            if (in_array($role, ['user', 'admin'], true)) {
                $this->session->regenerate_on_login();
                $this->session->set_userdata([
                    'user_id' => 1,
                    'user_email' => $email,
                    'user_role' => $role
                ]);
                header('Location: ' . site_url('/products'));
                exit;
            }

            $data['error'] = 'Please select a valid role.';
        }

        $this->call->view('auth/login', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        header('Location: ' . site_url('/login'));
        exit;
    }

}