<?php


$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$html = '
<body>



';

$mpdf->autoScriptToLang = true;
$mpdf->baseScript = 1;	// Use values in classes/ucdn.php  1 = LATIN
$mpdf->autoVietnamese = true;
$mpdf->autoArabic = true;

$mpdf->autoLangToFont = true;

/* This works almost exactly the same as using autoLangToFont:
	$stylesheet = file_get_contents('../lang2fonts.css');
	$mpdf->WriteHTML($stylesheet,1);
*/

$mpdf->WriteHTML($html);

$mpdf->Output();