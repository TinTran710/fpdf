<?php
	require_once __DIR__ . '/../vendor/autoload.php';
	use TinTran\PDFReader\PDFReader;

	$file = "doc.pdf";
	$read = new PDFreader($file);
	var_dump($read->get_pdf_prop());
	var_dump($read->get_pdf_title());