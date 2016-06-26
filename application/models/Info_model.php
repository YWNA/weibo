<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_model extends CI_Model  {
	private $cid;
	public function __construct()
	{
		parent::__construct();
		$this->cid = $_SESSION['guid'];
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
		$this->db->order_by('sort', 'ASC');
		$ret = $this->db->get_where('info', array('cid' => $guid))->result_array();
		return $ret;
	}
	public function get_info_by_guid($guid)
	{
		$ret = $this->db->get_where('company', array('guid' => $guid))->row_array();
		$this->db->order_by('sort', 'ASC');
		$ret = $this->db->get_where('info', array('cid' => $ret['guid'], 'status' => 1))->result_array();
		return $ret;
	}

	public function delete_info($cid, $guid)
	{
		// $this->db->where('cid', $cid)
		$this->db->delete('info', array('cid' => $cid, 'guid' => $guid));
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
	public function get_day_baoguan($cid)
	{
		$today       = date("Y-m-d", time());
		$sql         = sprintf("SELECT cid,SUM(baoguan_num) as num FROM info GROUP BY cid HAVING cid = '%s'",$cid);
		$data        = $this->db->query($sql)->row_array();
		$sql         = sprintf("SELECT baoguan_day FROM company WHERE guid = '%s'",$cid);
		$baoguan_day = $this->db->query($sql)->row_array();
		if (empty($baoguan_day['baoguan_day'])) {
			$sql = sprintf("UPDATE company SET baoguan_day = '%s' WHERE guid = '%s'", serialize([$today, $data['num'], 0]), $cid);
			$this->db->query($sql);
		} else {
			$baoguan_day = unserialize($baoguan_day['baoguan_day']);
			if ($baoguan_day[0] != $today) {
				$sql = sprintf("UPDATE company SET baoguan_day = '%s' WHERE guid = '%s'", serialize([$today, ($data['num']-$baoguan_day[1]), $baoguan_day[1]]), $cid);
				$this->db->query($sql);
			} else {
				$sql = sprintf("UPDATE company SET baoguan_day = '%s' WHERE guid = '%s'", serialize([$today, ($data['num']-$baoguan_day[2]), $baoguan_day[2]]), $cid);
				$this->db->query($sql);				
			}
		}
		$sql         = sprintf("SELECT baoguan_day FROM company WHERE guid = '%s'",$cid);
		$baoguan_day = $this->db->query($sql)->row_array();
		$baoguan_day = unserialize($baoguan_day['baoguan_day']);
		if (empty($baoguan_day[1])) {
			return 0;
		} else {
			return $baoguan_day[1];
		}
	}
	public function update_sort($cid, $sorts)
	{
		foreach ($sorts as $key => $value) {
			$sql = sprintf("UPDATE info SET sort = %s WHERE cid = '%s' AND guid = '%s'", $key, $cid, $value);
			$this->db->query($sql);
		}
		return;
	}
	public function sw($guid, $status)
	{
		$sql = sprintf("UPDATE info SET status = %s WHERE cid = '%s' AND guid = '%s'", $status, $this->cid, $guid);
		$this->db->query($sql);
		return;
	}
}