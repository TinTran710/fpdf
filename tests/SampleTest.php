<?php

require_once __DIR__ . '/../vendor/autoload.php';
use TinTran\PDFReader\PDFReader;
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase {

	public function testAllProperties() {
		$file = "doc.pdf";
		$reader = new PDFReader($file);

		$expectedFile = new PDFreader($file);
		$expectedTitle = $expectedFile->get_pdf_prop();

		$this->assertEquals($expectedTitle, $reader->get_pdf_prop());
	}

	public function testTitleProperty() {
		$file = "doc.pdf";
		$reader = new PDFReader($file);

		$expectedFile = new PDFreader($file);
		$expectedTitle = $expectedFile->get_pdf_title();

		$this->assertEquals($expectedTitle, $reader->get_pdf_title());
	}

}


    