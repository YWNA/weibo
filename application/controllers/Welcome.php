<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Info_model');
	}
	public function index($cid = NULL)
	{
		$this->view_override = FALSE;
		if (empty($cid)) { show_error('客户号不能为空');}
		$this->load->view('welcome', array('cid'=>$cid));
	}
	public function info()
	{
		$this->view_override = FALSE;
		$cid = $this->input->post("cid");
		$num = $this->input->post("num");
		$ret = $this->Info_model->get_show_info($cid, $num);
		if($ret) $ret['link'] = urlencode( base64_encode($ret['link']) );
		$this->output->set_content_type('application/json')->set_output(json_encode(array('info' => $ret)));
	}
	public function redirect($url, $id)
	{
		$this->Info_model->click_info($id);
		$url = base64_decode( urldecode($url) );
		redirect($url);
	}
}
