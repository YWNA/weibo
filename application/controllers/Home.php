<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Info_model');
	}
	public function index()
	{
		$cid = session_conf('id');
		if ($_POST) {
			$title = $this->input->post('title');
			$link  = $this->input->post('link');
			$this->Info_model->add_info($cid, $title, $link);
			redirect('home');
		}
		$ret = $this->Info_model->get_info($cid);
		$this->load->view('home', array('title' => '添加内容', 'ret' => $ret));
	}
	public function del($id)
	{
		$cid = session_conf('id');
		$ret = $this->Info_model->delete_info($cid, $id);
		if ($ret) {
			redirect('home');
		} else {
			show_error('删除失败');
		}
	}
}
