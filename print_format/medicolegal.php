<?php

include("connection.php");
$mid = $_GET['mid'];
$sql1 = "SELECT * FROM medicolegal_certificate,patients,doctors,designation WHERE(medicolegal_certificate.patient_id=patients.id) AND (medicolegal_certificate.doctor_id=doctors.id) AND (doctors.designation_id=designation.id) AND medicolegal_certificate.id = '".$mid."' ";
$query1 = mysqli_query($con,$sql1);
$row1=mysqli_fetch_array($query1);

$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$cc = $date->format('d-m-Y');

$now = new DateTime(null, new DateTimeZone('Asia/Kolkata'));
$tt =  $now->format('H:i:s');

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

//$today_date = date('Y-m-d');
//$todaydate = date('d-m-Y',strtotime($today_date));

$html.= '
<h1 align="center">MEDICOLEGAL CERTIFICATE</h1>
<table width="100%" style="font-family: serif;" cellpadding="10">
<tr>
<td width="45%" style="border: 0.1mm solid #888888; font-size: 10pt;">
<span style="font-size: 10pt; color: #000000; font-family: sans;">
<b>MLC. NO:</b> '.$row1['mlc_no'].' <br /><hr>
<b>Date:</b> '.$row1['date'].' <br /><b></td>';

$html.= '<td width="10%">&nbsp;</td>

<td width="45%" style="border: 0.1mm solid #888888;">
<span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Certificate No:</b> '.$row1['certificate_no'].'</span>
<br /><hr><span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Date:</b> '.$row1['date'].'</span></td>
</tr></table>';

$html.= '
</htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />';

$html.= '
<table width="100%" style="font-family: serif;" cellpadding="10">
<tr>
<td width="40%" style="border: 0.1mm solid #888888; font-size: 10pt;">
<span style="font-size: 10pt; color: #000000; font-family: sans;">
<b>INDOOR OPD NO. :</b> '.$row1['indoor_opd_no'].' <br /><hr>
<b>Examination Date:</b> '.$row1['examination_date_time'].' <br /><hr> <b>Examination Time:</b> '.$row1['examination_date_time1'].' AM/PM</td>';

$html.= '
<td width="60%" style="border: 0.1mm solid #888888;">
<span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Name & Address:</b> '.$row1['first_name'].' '.$row1['last_name'].' , '.$row1['address'].' '.$row1['city'].'<hr></span>
<br /><span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Age:</b> '.$row1['age'].' Years <br /><hr> <b>Sex:</b> '.$row1['gender'].'</span></td>
</tr></table><br>';


$html.= '
<table width="100%" style="font-family: serif;" cellpadding="10">
<tr>
<td width="40%" style="border: 0.1mm solid #888888; font-size: 10pt;">
<span style="font-size: 10pt; color: #000000; font-family: sans;">
<b>ACCIDENT / ASSULAT DETAILS</b><br /><hr>
<b>Acc / Assualt Date:</b> '.$row1['accident_date_time'].' <br /><hr> <b>Acc / Assualt Time:</b> '.$row1['accident_date_time1'].' AM/PM</td>';

$html.= '
<td width="60%" style="border: 0.1mm solid #888888;">
<span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Identification Marks:</b><br /><hr> '.$row1['identification_marks'].' </span></td>
</tr></table><br>';


$html.= '
<table width="100%" style="font-family: serif;" cellpadding="10">
<tr>
<td width="100%" style="border: 0.1mm solid #888888;">
<span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Details of Injuries / Clinical Features</b> (Nature, Exact Situation, Dimension, Fresh / Healing):<br /><hr> '.$row1['clinical_featury'].' </span></td>
</tr></table><br>';

$html.= '
<table width="100%" style="font-family: serif;" cellpadding="10">
<tr>
<td width="100%" style="border: 0.1mm solid #888888;">
<span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Age of Injuries:</b><br /><hr> '.$row1['age_of_injury'].' </span></td>
</tr></table><br>';

$html.= '
<table width="100%" style="font-family: serif;" cellpadding="10">
<tr>
<td width="100%" style="border: 0.1mm solid #888888;">
<span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Cause of Injuries:</b><br /><hr> '.$row1['cause_of_injury'].' </span></td>
</tr></table><br>';

$html.= '<table width="100%" style="font-family: serif;" cellpadding="10">';

$html.= '<tr>
<td width="49%" style="border: 0.1mm solid #888888; font-size: 10pt;"><span style="font-size: 10pt; color: #000000; font-family: sans;"><b>Name Of the Institution:</b></span><br /><br /><b>RATHI HOSPITAL</b> <br /> Behind Kushal Auto, Badnera Road,<br />Amravati (MS)</td>';

$html.= '<td width="2%">&nbsp;</td>

<td width="49%" style="border: 0.1mm solid #888888;"><span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Signature of Doctor:</b>
</span>
<br /><hr><span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Name of Doctor:</b> '.$row1['doctor_name'].' </span>
<br /><hr><span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Designation:</b> '.$row1['degree'].' ('.$row1['name'].') <b>Regis. No:</b> '.$row1['medical_registration_no'].' </span>
</td>
</tr>';
$html.= '</table>';

$html.= '
<table align="center" width="100%" style="font-family: serif;" cellpadding="10">
<tr>
<td width="100%" style="border: 0.1mm solid #888888;">
<span style="font-size: 10pt; color: #000000; font-family: serif;"><b>Received the Certificate No.  ............... Dated: '.date('Y-m-d').'</b><br /><hr>
P.S.I / Constables Name .................... Buckle No. ............... <br />
Police Station  .................................... Signature ................ 
<br /> Date: '.$cc.'  Time: '.$tt.' AM / PM</span></td>
</tr></table><br>';

$html.= '
</body>
</html>
';

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'margin_left' => 20,
    'margin_right' => 15,
    'margin_top' => 48,
    'margin_bottom' => 25,
    'margin_header' => 10,
    'margin_footer' => 10
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Medicolegal Certificate");
$mpdf->SetAuthor("Rathi Hospital Prescription");
$mpdf->SetWatermarkText("Rathi Hospital");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');
$mpdf->autoScriptToLang = true;
$mpdf->baseScript = 1;	// Use values in classes/ucdn.php  1 = LATIN
$mpdf->autoVietnamese = true;
$mpdf->autoArabic = true;
$mpdf->autoLangToFont = true;
$mpdf->WriteHTML($html);
$mpdf->Output();
