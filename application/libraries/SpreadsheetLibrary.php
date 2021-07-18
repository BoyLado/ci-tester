<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require "vendor/autoload.php";

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\IOFactory;

class SpreadsheetLibrary {

	public function readFile($excel_file, $sheets = [])
	{
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($excel_file);
		
		(count($sheets) > 0)?$reader->setLoadSheetsOnly($sheets):FALSE;
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($excel_file);
		$sheetData = $spreadsheet->getActiveSheet()->toArray();
		(count($sheetData) > 1)?array_shift($sheetData):FALSE;

		return $sheetData;
	}

	public function uploadApplications($file_csv)
	{
		/**  Create a new Reader of the type that has been identified  **/
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_csv);
		/**  **/
		$reader->setLoadSheetsOnly(["Applications (Database)"]);
		/** Read only **/
		$reader->setReadDataOnly(true);
		/** load file **/
		$spreadsheet = $reader->load($file_csv);
		/** get active cells **/
		$sheetData = $spreadsheet->getActiveSheet()->toArray();
		$arrData = [];
		foreach ($sheetData as $key => $value) 
		{
			if($key != 0)
			{
				$arr = [];
				foreach ($sheetData[$key] as $k => $v) 
				{
					if($k == 1)
					{
						$valDate = date("Y-m-d", ($v - 25569)*86400);
						array_push($arr,$valDate);
					}
					else
					{
						array_push($arr,$v);
					}
				}
				array_push($arrData,$arr);
			}
		}

		return (count($arrData) > 0)? $arrData : null;
	}

	public function uploadApplicationDetails($file_csv)
	{
		/**  Identify the type of $inputFileName  **/
		// $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_csv);
		/**  Create a new Reader of the type that has been identified  **/
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_csv);
		/**  **/
		$reader->setLoadSheetsOnly(["Application Details (Database)"]);
		/** Read only **/
		$reader->setReadDataOnly(true);
		/** load file **/
		$spreadsheet = $reader->load($file_csv);
		/** get active cells **/
		$sheetData = $spreadsheet->getActiveSheet()->toArray();

		$arrData = [];
		foreach ($sheetData as $key => $value) 
		{
			if($key != 0)
			{
				$arr = [];
				foreach ($sheetData[$key] as $k => $v) 
				{
					array_push($arr,$v);
				}
				
				array_push($arrData,$arr);

			}
		}

		return (count($arrData) > 0)? $arrData : null;
	}

	public function uploadApplicationCustomers($file_csv)
	{
		/**  Identify the type of $inputFileName  **/
		// $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_csv);
		/**  Create a new Reader of the type that has been identified  **/
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_csv);
		/**  **/
		$reader->setLoadSheetsOnly(["Application Customer (Database)"]);
		/** Read only **/
		$reader->setReadDataOnly(true);
		/** load file **/
		$spreadsheet = $reader->load($file_csv);
		/** get active cells **/
		$sheetData = $spreadsheet->getActiveSheet()->toArray();

		$arrData = [];
		foreach ($sheetData as $key => $value) 
		{
			if($key != 0)
			{
				$arr = [];
				foreach ($sheetData[$key] as $k => $v) 
				{
					array_push($arr,$v);
				}
				
				array_push($arrData,$arr);

			}
		}

		return (count($arrData) > 0)? $arrData : null;
	}

}