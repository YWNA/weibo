<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Company_model');
	}
	public function index()
	{
		if ($_POST) {
			$username  = $this->input->post('username');
			$company   = $this->input->post('company');
			$password1 = $this->input->post('password1');
			$password2 = $this->input->post('password2');
			if ($password1 != $password2) {
				show_error('密码输入不相同');
			}
			if (!$this->Company_model->if_exists_username($username)) {
				$this->Company_model->register($username, $company, $password1);
				redirect('/');
			} else {
				show_error($username . '已经存在');
			}
		}
		$this->load->view('register', array('title' => '注册'));
	}
}
