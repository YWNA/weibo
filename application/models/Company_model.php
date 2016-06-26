<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model  {
	public function __construct()
	{
		parent::__construct();
	}
	public function if_exists_username($username)
	{
		$ret = $this->db->get_where('company', array('username' => $username))->row_array();
		if ($ret) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function get_company($username)
	{
		$ret = $this->db->get_where('company', array('username' => $username))->row_array();
		if ($ret) {
			return $ret;
		} else {
			return FALSE;
		}
	}
	public function get_company_name_s($guid)
	{
		$ret = $this->db->get_where('company', array('guid' => $guid))->row_array();
		if ($ret) {
			return $ret['company_name_s'];
		} else {
			return FALSE;
		}
	}
	public function get_company_by_cid($cid)
	{
		$ret = $this->db->get_where('company', array('id' => $cid))->row_array();
		if ($ret) {
			return $ret;
		} else {
			return FALSE;
		}
	}
	public function login($username, $password)
	{
		$ret = $this->db->get_where('company', array('username' => $username))->row_array();
		if ($ret) {
			if ( password_verify($password, $ret['password']) ) {
				return TRUE;
			}
		}
		return FALSE;
	}
	public function register($username, $category, $company, $company_s, $password)
	{
		$data = array(
			'guid'           => get_guid(),
			'username'       => $username,
			'category'       => $category,
			'company_name'   => $company,
			'company_name_s' => $company_s,
			'password'       => password_hash($password, PASSWORD_DEFAULT),
			'create_time'    => date('Y-m-d H:i:s', time())
		);
		$this->db->insert('company', $data);
		$ret = $this->db->insert_id();
		return;
	}

}