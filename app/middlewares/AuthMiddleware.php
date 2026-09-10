<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle($next)
    {
        $session = load_class('session', 'libraries');
        $user_id = (int) $session->userdata('user_id');
        $role = $session->userdata('user_role');

        if ($user_id <= 0 || !in_array($role, ['admin', 'user'], true)) {
            $session->sess_destroy();
            header('Location: ' . site_url('/login'));
            exit;
        }

        return $next();
    }
}
