<?php

namespace TinTran\PDFReader;
require('lib/fpdf.php');

class PDFReader {
	private $prop;

	public function __construct($file) {
	    $f = fopen($file,'rb');
	    if(!$f) {
	    	echo "file does not exist";
	        return false;
	    }

	    //Read the last 16KB
	    fseek($f, -16384, SEEK_END);
	    $s = fread($f, 16384);

	    //Extract cross-reference table and trailer
	    if(!preg_match("/xref[\r\n]+(.*)trailer(.*)startxref/s", $s, $a)) {
	        echo "extract cross-reference not success";
	        return false;
	    }
	    $xref = $a[1];
	    $trailer = $a[2];

	    //Extract Info object number
	    if(!preg_match('/Info ([0-9]+) /', $trailer, $a)) {
	        echo "extract info object number not success";
	        return false;
	    }
	    $object_no = $a[1];

	    //Extract Info object offset
	    $lines = preg_split("/[\r\n]+/", $xref);
	    $line = $lines[1 + $object_no];
	    $offset = (int)$line;
	    if($offset == 0) {
	        echo "extract info object offset not success";
	        return false;
	    }

	    //Read Info object
	    fseek($f, $offset, SEEK_SET);
	    $s = fread($f, 1024);
	    fclose($f);

	    //Extract properties
	    if(!preg_match('/<<(.*)>>/Us', $s, $a)) {
	        echo "extract properties not success";
	        return false;
	    }
	    $n = preg_match_all('|/([a-z]+) ?\((.*)\)|Ui', $a[1], $a);
	    $this->prop = array();
	    for($i=0; $i<$n; $i++) {
	        $this->prop[$a[1][$i]] = $a[2][$i];
	    }
	}

	public function get_pdf_prop() {
		return $this->prop;
	}

	public function get_pdf_title() {
		return $this->prop['Title'];
	}
}
?>