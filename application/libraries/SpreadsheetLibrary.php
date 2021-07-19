<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require "vendor/autoload.php";

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\IOFactory;

class SpreadsheetLibrary {

	public function readFile($excelFile, $sheets = [])
	{
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($excelFile);
		
		(count($sheets) > 0)?$reader->setLoadSheetsOnly($sheets):FALSE;
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($excelFile);
		$sheetData = $spreadsheet->getActiveSheet()->toArray();
		(count($sheetData) > 1)?array_shift($sheetData):FALSE;

		return $sheetData;
	}

	public function checkData($data, $date = null)
	{
		$arr_val = ["NULL","null","","N/A","n/a","NA","na"];
		if($date == null)
		{
			$result = (in_array($data,$arr_val))? null : $data;
		}
		elseif($date == "d")
		{
			$result = (in_array($data,$arr_val))? null : date("Y-m-d", ($data - 25569)*86400);
		}
		else
		{
			$result = "[Error] Unknown parameter " . $date;
		}
		
		return $result;
	}

	public function getSheets($excelFile)
	{
		
	}


}