<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('SpreadsheetLibrary',null,'excel');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function returnSheets()
	{
		$excelFile = $_FILES["testexcel"]["tmp_name"];

		$this->output->set_content_type('application/json')->set_output(json_encode($excelFile));
	}

	public function testUploadExcel()
	{
		$excelFile = $_FILES["file_application_customers"]["tmp_name"];

		$arrData = $this->excel->readFile($excelFile);
		
		$newArrData = [];
		foreach ($arrData as $key => $value) 
		{
			$arrTemp = [
				'first_name' => $this->excel->checkData($value[1]),
				'last_name' => $this->excel->checkData($value[2]),
				'date_added' => $this->excel->checkData($value[3],'d')
			];
			array_push($newArrData, $arrTemp);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($newArrData));
	}
}
