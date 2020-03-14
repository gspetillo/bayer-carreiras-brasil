<?php
	include 'vendor/autoload.php';

	function conversionToText($filename){  

		$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

			if($file_ext == "doc" || $file_ext == "docx"){
				if($file_ext == "doc")
					toDoc($filename);
				else 
					toDocx($filename);
			} 
			else if( $file_ext == "pdf" ){
				$parser = new \Smalot\PdfParser\Parser();
				$pdf    = $parser->parseFile($filename);
				$text = $pdf->getText();
				return nl2br($text)	;
			} 
	}

	function toDoc($filename){       
		if (($fh = fopen($filename, 'r')) !== false ) {

			$headers = fread($fh, 0xA00);
			$n1 = ( ord($headers[0x21C]) - 1 );
			$n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );
			$n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );
			$n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );

			$textLength = ($n1 + $n2 + $n3 + $n4);
			$text = fread($fh, $textLength);
			echo nl2br($text);
		}	
	}

	function toDocx($filename){

		$striped_content = '';
		$content = '';

		$zip = zip_open($filename);

		if (!$zip || is_numeric($zip)) return false;

		while ($zip_entry = zip_read($zip)) {

			if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

			if (zip_entry_name($zip_entry) != "word/document.xml") continue;

			$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

			zip_entry_close($zip_entry);
		}

		zip_close($zip);

		$content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
		$content = str_replace('</w:r></w:p>', "\r\n", $content);
		$text = strip_tags($content);

		echo nl2br($text);
	} 
?>