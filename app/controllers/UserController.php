<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Controller: UserController
 *
 * Automatically generated via CLI.
 */
class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
    }

    public function index()
    {
        $users = $this->UserModel->all();
        $data['users'] = $users;
        $this->call->view('UserView', $data);
    }
}