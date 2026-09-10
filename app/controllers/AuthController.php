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
        if ($this->is_authenticated()) {
            $this->redirect('/products');
        }

        $this->call->view('auth/login', ['error' => '', 'email' => '']);
    }

    public function authenticate()
    {
        if ($this->is_authenticated()) {
            $this->redirect('/products');
        }

        $email = strtolower(trim((string) $this->io->post('email')));
        $password = (string) $this->io->post('password');
        $data = ['error' => '', 'email' => $email];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
            $data['error'] = 'Enter a valid email address and password.';
            $this->call->view('auth/login', $data);
            return;
        }

        $user = $this->UserModel->find_by_email($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $data['error'] = 'Invalid email or password.';
            $this->call->view('auth/login', $data);
            return;
        }

        $role = $user['role'] ?? '';
        if (!in_array($role, ['admin', 'user'], true)) {
            $data['error'] = 'This account cannot access the application.';
            $this->call->view('auth/login', $data);
            return;
        }

        $this->session->regenerate_on_login();
        $this->session->set_userdata([
            'user_id' => (int) $user['id'],
            'user_email' => $user['email'],
            'user_role' => $role
        ]);

        $this->redirect('/products');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->redirect('/login');
    }

    private function is_authenticated(): bool
    {
        return (int) $this->session->userdata('user_id') > 0
            && in_array($this->session->userdata('user_role'), ['admin', 'user'], true);
    }

    private function redirect(string $path): void
    {
        header('Location: ' . site_url($path));
        exit;
    }
}
