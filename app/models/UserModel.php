<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Model: UserModel
 *
 * Automatically generated via CLI.
 */
class UserModel extends Model
{
    protected $table = 'users';
    protected $primary_key = 'id';
    protected $fillable = ['firstname', 'lastname', 'email', 'username'];
    protected $guarded = ['id'];

    public function __construct()
    {
        parent::__construct();
    }
}