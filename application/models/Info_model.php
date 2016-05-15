<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_model extends CI_Model  {
	public function __construct()
	{
		parent::__construct();
	}
	public function add_info($cid, $title, $link)
	{
		$data = array(
			'cid' => $cid,
			'title' => $title,
			'link' => $link,
			'create_time' => date('Y-m-d H:i:s', time())
		);
		$this->db->insert('info', $data);
		return;
	}
	public function get_info($cid)
	{
		$ret = $this->db->get_where('info', array('cid' => $cid))->result_array();
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
	public function get_show_info($cid, $num)
	{
		$num = $num - 1;
		$sql = 'SELECT * FROM info where cid='.$cid.' LIMIT '.$num.',1';
		$count = $this->db->count_all('info');
		$ret = $this->db->query($sql)->row_array();
		$ret['count'] = $count;
		$data = array(
			'baoguan_num' => $ret['baoguan_num'] + 1,
		);
		$this->db->update('info', $data, array('id' => $ret['id']));
		return $ret;
	}
	public function click_info($id)
	{
		$ret = $this->db->get_where('info', array('id'=>$id))->row_array();
		$data = array(
			'click_num' => $ret['click_num'] + 1,
		);
		$this->db->update('info', $data, array('id' => $ret['id']));
	}
}