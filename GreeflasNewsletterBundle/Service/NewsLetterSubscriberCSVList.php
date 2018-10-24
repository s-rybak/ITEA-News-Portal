<?php

namespace Greeflas\Bundle\NewsletterBundle\Service;

/**
 *  Saves subscriber to csv list
 *
 *  @author Sergey R <qwe@qwe.com>
 *
 */

use Greeflas\Bundle\NewsletterBundle\Dto\Subscriber;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class NewsLetterSubscriberCSVList implements NewsletterSubscriberInterface {

	private $path = "";
	private $fileName = "";
	private $type = "";

	public function __construct(string $path, string $fileName, string $type)
	{

		$this->path = __DIR__.$path;
		$this->fileName = $fileName.".".strtolower($type);
		$this->type = $type;

	}

	/**
	 * Save Subscriber to csv list
	 *
	 * @param Subscriber $subscriber to save
	 *
	 * @throws \PhpOffice\PhpSpreadsheet\Exception
	 * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
	 * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
	 */
	public function save( Subscriber $subscriber )
	{

		$spreadSheet = $this->getSpreadshet();
		$workSheet = $spreadSheet->getActiveSheet();
		$num_rows = $workSheet->getHighestRow();
		$num_rows = strlen($workSheet->getCell("A$num_rows")) == 0 ? $num_rows : $num_rows + 1;
		$workSheet->setCellValue("A$num_rows",$subscriber->getEmail());

		$this->saveSpreadsheet($spreadSheet);
	}

	/**
	 * Loads Spreadsheet file
	 *
	 * @return Spreadsheet
	 * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
	 */
	private function getSpreadshet(): Spreadsheet
	{

		if(!file_exists($this->path)){

			mkdir($this->path);

		}

		if(file_exists($this->path.$this->fileName)){

			return (IOFactory::createReader($this->type))->load($this->path.$this->fileName);

		}

		return new Spreadsheet();

	}

	/**
	 * Saves spread sheet
	 *
	 * @param Spreadsheet $spreadsheet
	 *
	 * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
	 */
	private function saveSpreadsheet( Spreadsheet $spreadsheet )
	{

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, $this->type);
		$writer->save($this->path.$this->fileName);

	}
}