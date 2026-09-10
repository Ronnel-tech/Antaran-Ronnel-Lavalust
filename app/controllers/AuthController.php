<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
    }

    public function login()
    {
        if ($this->session->has_userdata('user_id')) {
            header('Location: ' . site_url('/products'));
            exit;
        }

        $this->call->view('auth/login', [
            'error' => '',
            'email' => ''
        ]);
    }

    public function authenticate()
    {
        $email = trim((string) $this->io->post('email'));
        $password = (string) $this->io->post('password');
        $data = [
            'error' => '',
            'email' => $email
        ];

        $this->form_validation
            ->name('email')->required()->valid_email()
            ->name('password')->required();

        if (!$this->form_validation->run()) {
            $data['error'] = 'Enter a valid email address and password.';
        } else {
            $user = $this->UserModel->find_by_email($email);

            if ($user && password_verify($password, $user['password'])) {
                $this->session->regenerate_on_login();
                $this->session->set_userdata([
                    'user_id' => (int) $user['id'],
                    'user_email' => $user['email'],
                    'user_role' => $user['role']
                ]);
                header('Location: ' . site_url('/products'));
                exit;
            }

            $data['error'] = 'Invalid email or password.';
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
