<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Info_model');
		$this->load->model('Company_model');
	}
	private function cid($cid = NULL)
	{
		$this->view_override = FALSE;
		if (empty($cid)) { show_error('客户号不能为空');}
		$data = $this->Company_model->get_company_name_s($cid);
		if (empty($data)) { show_error('不存在该用户内容');}
		$this->load->view('welcome', array('cid'=>$cid, 'company_name_s' => $data));
	}
	public function guid($guid = NULL)
	{
		$this->view_override = FALSE;
		if (empty($guid)) { show_error('客户号不能为空');}
		$company = $this->Company_model->get_company_name_s($guid);
		if (empty($company)) { show_error('不存在该用户内容');}
		$info = $this->Info_model->get_info_by_guid($guid);
		$this->load->helper('cookie');
		set_cookie('info', json_encode($info), 7200);
		$this->load->view('welcome', array('guid'=>$guid, 'company_name_s' => $company));
	}
	public function info()
	{
		$this->view_override = FALSE;
		$id = $this->input->post("id");
		$cid  = $this->input->post("cid");
		$ret = $this->Info_model->baoguan($id, $cid);
		if ($ret) {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('data' => true)));
		} else {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('info' => false)));
		}
		// if($ret) $ret['link'] = urlencode( base64_encode($ret['link']) );
	}
	public function redirect($url, $id)
	{
		$this->Info_model->click_info($id);
		$url = base64_decode( urldecode($url) );
		redirect('http://' . $url);
	}
}
