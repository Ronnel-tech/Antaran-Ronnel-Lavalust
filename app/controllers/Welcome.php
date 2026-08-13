<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Welcome extends Controller
{
    public function index()
    {
        $data['title'] = 'Home';
        // existing view file is `welcome_page.php` in app/views
        $this->call->view('welcome_page', $data);
    }

    public function about()
    {
        $this->call->view('about');
    }
}

// class Welcome extends Controller {
// 	public function index() {
// 		$this->call->view('welcome_page');
// 	}
// }
?>