<?php

$date = $_GET['date'];
$comp_id = $_GET['comp_id'];
 
$html_file_url = "http://advections.com/daily_report.php?comp_id=".$comp_id."&date=".$date; // html file 
$pdf_file_url = "../reports/daily_report_".$date.".pdf"; // pdf file 
 
//$cmd = "wkhtmltopdf/bin/wkhtmltopdf -O landscape ".$html_file_url." ".$pdf_file_url." 2>&1";// command 
//$cmd = "wkhtmltopdf --orientation Landscape --disable-smart-shrinking ".$html_file_url." ".$pdf_file_url." 2>&1";// command .

//$cmd = "wkhtmltopdf/bin/wkhtmltopdf --page-width 88mm --page-height 56mm ".$html_file_url." ".$pdf_file_url." 2>&1";// command 
//$cmd = "wkhtmltopdf/bin/wkhtmltopdf --page-width 1040px --page-height 720px ".$html_file_url." ".$pdf_file_url." 2>&1";// command 


$cmd = "../wkhtmltopdf/bin/wkhtmltopdf --page-width 1040px --page-height 720px --margin-top 0 --margin-bottom 0 --margin-left 0 --margin-right 0 --disable-smart-shrinking \"".$html_file_url."\" \"".$pdf_file_url."\" 2>&1";// command 


echo exec($cmd); // execute command from php

//header("Location: http://advections.com/reports/daily_report_".$date.".pdf");

$pdf = file_get_contents($pdf_file_url);

header('Content-Type: application/pdf');
header('Cache-Control: public, must-revalidate, max-age=0'); // HTTP/1.1
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Content-Length: '.strlen($pdf));
header('Content-Disposition: inline; filename="'.basename($pdf_file_url).'";');
ob_clean(); 
flush(); 
echo $pdf;



?>