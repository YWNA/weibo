<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_model extends CI_Model  {
	public function __construct()
	{
		parent::__construct();
	}
	public function add_info($guid, $title, $link)
	{
		$data = array(
			'cid'         => $guid,
			'title'       => $title,
			'link'        => $link,
			'guid'        => get_guid(4),
			'create_time' => date('Y-m-d H:i:s', time())
		);
		$this->db->insert('info', $data);
		return;
	}
	public function get_info($guid)
	{
		$ret = $this->db->get_where('info', array('cid' => $guid))->result_array();
		return $ret;
	}
	public function get_info_by_guid($guid)
	{
		$ret = $this->db->get_where('company', array('guid' => $guid))->row_array();
		$ret = $this->db->get_where('info', array('cid' => $ret['guid']))->result_array();
		return $ret;
	}

	public function delete_info($cid, $id)
	{
		// $this->db->where('cid', $cid)
		$this->db->delete('info', array('cid' => $cid, 'id' => $id));
		if ($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function get_show_info($guid, $num, $t)
	{
		$sql   = "SELECT id FROM company where guid = '" . $guid . "'";
		$ret   = $this->db->query($sql)->row_array();
		$cid   = $ret['id'];
		$sql   = 'SELECT * FROM info where cid='.$cid;
		$ret   = $this->db->query($sql)->result_array();
		$count = count($ret);
		$num   = $num - 1;
		$sql   = 'SELECT * FROM info where cid='.$cid.' LIMIT '.$num.',1';
		$ret   = $this->db->query($sql)->row_array();
		if(empty($ret)) return $ret;
		$ret['count'] = $count;
		$data = array(
			'baoguan_num' => $ret['baoguan_num'] + 1,
		);
		if ($t == 1) {
			$this->db->update('info', $data, array('id' => $ret['id']));
		}
		return $ret;
	}
	public function baoguan($guid)
	{
		$sql   = 'SELECT * FROM info where guid =\''.$guid . '\'';
		$ret   = $this->db->query($sql)->row_array();
		if (empty($ret)) { return false; }
		$data = array(
			'baoguan_num' => $ret['baoguan_num'] + 1,
		);
		$this->db->update('info', $data, array('guid' => $ret['guid']));
		return $this->db->affected_rows();
	}
	public function click_info($guid)
	{
		$ret = $this->db->get_where('info', array('guid'=>$guid))->row_array();
		$data = array(
			'click_num' => $ret['click_num'] + 1,
		);
		$this->db->update('info', $data, array('guid' => $ret['guid']));
	}
	public function get_edit_info($cid, $guid)
	{
		$sql = sprintf("SELECT
company.id,
company.company_name_s,
info.link,
info.title,
info.cid,
info.guid,
info.id as info_id
FROM
company ,
info
WHERE
company.guid = info.cid AND
info.cid = '%s' AND
info.guid  = '%s'
", $cid, $guid);
		$ret = $this->db->query($sql)->row_array();
		return $ret;
	}
	public function update($data, $cid, $guid)
	{
		$this->db->update('info', $data, array('guid' => $guid, 'cid' => $cid));
		return $this->db->affected_rows();
	}
}