<?php
$newDate = date("d-m-Y", strtotime(date('Y-m-d')));
$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>
</head>
<body>


<htmlpageheader name="myheader">';

$html.= '<img src="new1.jpg">';

$html.= '
<p style="margin-top: -280px; margin-left: 400px; font-size: 14px; font-family: serif;"><b>'.$_GET['name'].'</b></p>
';

$html.= '
<p style="margin-top: 28px; margin-left: 330px; font-size: 14px; font-family: serif;"><b>'.$_GET['mobile'].'</b></p>
';

$html.= '
<p style="margin-top: 28px; margin-left: 450px; font-size: 14px; font-family: serif;"><b>'.$newDate.'</b></p>
';

$html.= '
</htmlpageheader>

<htmlpagefooter name="myfooter">
<div >

</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />';

$html.= '

';


$html.= '
</body>
</html>
';

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'default_font' => 'dejavusans'
//    'margin_left' => 20,
//    'margin_right' => 15,
//    'margin_top' => 48,
//    'margin_bottom' => 25,
//    'margin_header' => 10,
//    'margin_footer' => 10
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Receipt");
$mpdf->SetAuthor("Nanak Roti Trust");
//$mpdf->SetWatermarkText("Rathi Hospital");
$mpdf->showWatermarkText = true;
//$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
//$mpdf->SetDisplayMode('fullpage');
$mpdf->autoScriptToLang = true;
$mpdf->baseScript = 1;	// Use values in classes/ucdn.php  1 = LATIN
$mpdf->autoVietnamese = true;
$mpdf->autoArabic = true;
$mpdf->autoLangToFont = true;
$mpdf->WriteHTML($html);
$mpdf->Output();
