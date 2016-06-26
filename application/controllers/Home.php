<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $cid;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Info_model');
		$this->load->model('Company_model');
		$this->cid = session_conf('guid');
	}
	public function index()
	{
		$guid = session_conf('guid');
		if ($_POST) {
			$title = $this->input->post('title');
			$link  = $this->input->post('link');
			$this->Info_model->add_info($guid, $title, $link);
			redirect('home');
		}
		$ret = $this->Info_model->get_info($guid);
		$num = $this->Info_model->get_day_baoguan($guid);
		// $company = $this->Company_model->get_company_by_cid($cid);
		$this->load->view('home', array('title' => '添加内容', 'ret' => $ret, 'num' => $num));
	}
	public function edit($guid = NULL)
	{
		if ($_POST) {
			$title   = $this->input->post('title');
			$link    = $this->input->post('link');
			$guid = $this->input->post('guid');
			$data = array(
				'title' => $title,
				'link' => $link
			);
			$ret = $this->Info_model->update($data, $this->cid, $guid);
			redirect('/');
			return; 
		}
		if (empty($guid)) { show_error('缺少参数'); }
		$cid = session_conf('guid');
		$ret = $this->Info_model->get_edit_info($cid, $guid);
		if ($ret) {
			$this->load->view('edit', array('title' => '编辑内容', 'ret' => $ret));
		} else {
			show_error('无数据');
		}
	}
	public function del($guid)
	{
		$cid = session_conf('guid');
		$ret = $this->Info_model->delete_info($cid, $guid);
		if ($ret) {
			redirect('home');
		} else {
			show_error('删除失败');
		}
	}
	public function sort()
	{
		if ($_POST) {
			$sorts = $_POST['sort'];
			$this->Info_model->update_sort($this->cid, $sorts);
		}
		redirect('home');
	}
	public function sw($guid, $status)
	{
		$this->Info_model->sw($guid, $status);
		redirect('home');
	}
}
