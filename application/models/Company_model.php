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
	public function register($username, $company, $password)
	{
		$data = array(
			'username' => $username,
			'company_name' => $company,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'create_time' => date('Y-m-d H:i:s', time())
		);
		$this->db->insert('company', $data);
		$ret = $this->db->insert_id();
		return;
	}

}