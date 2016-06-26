<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require realpath(__DIR__ . "/../libraries/php-excel/Classes/") . "/PHPExcel.php";
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
	public function excel()
	{
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
									 ->setLastModifiedBy("Maarten Balliauw")
									 ->setTitle("Office 2007 XLSX Test Document")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");
		$data = $this->Info_model->get_info($this->cid);
		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A1', '编号')
		            ->setCellValue('B1', '标题')
		            ->setCellValue('C1', '累计传播人数')
		            ->setCellValue('D1', '阅读量')
		            ->setCellValue('E1', '链接地址')
		            ->setCellValue('F1', '在线时间')
		            ->setCellValue('G1', '状态')
		            ->setCellValue('H1', '创建时间');
		foreach ($data as $key => $value) {
			$y = $key+2;
			$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A' . $y, $value['guid'])
		            ->setCellValue('B' . $y, $value['title'])
		            ->setCellValue('C' . $y, $value['baoguan_num'])
		            ->setCellValue('D' . $y, $value['click_num'])
		            ->setCellValue('E' . $y, $value['link'])
		            ->setCellValue('F' . $y, timeto($value['create_time'], date("Y-m-d H:i:s", time())))
		            ->setCellValue('G' . $y, $value['status'] == 1 ? '开启中' : '关闭中')
		            ->setCellValue('H' . $y, date("Y-m-d", strtotime($value['create_time'])));
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('信息报表');
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="01simple.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		redirect('home');
	}
}
