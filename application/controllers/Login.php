<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Company_model');
	}
	public function index()
	{
		$this->view_override = FALSE;
		if ($_POST) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if ( !$this->Company_model->if_exists_username($username) ) {
				show_error($username . '不存在');
			} elseif ($this->Company_model->login($username, $password)) {
				session_conf('username', $username);
				$ret = $this->Company_model->get_company($username);
				if($ret) foreach ($ret as $key => $value) {
					if($key != 'password') session_conf($key, $value);
				}
				redirect('/home');
			} else {
				redirect('/');
			}
		}
		$this->load->view('login', array('title' => '登陆'));
	}
	public function logout()
	{
		session_destroy();
		redirect('/');
	}
}
