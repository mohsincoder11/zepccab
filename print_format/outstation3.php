<?php
include('connection.php');
$newDate = date("d-m-Y", strtotime(date('Y-m-d')));		
$sql = " SELECT o.*,
c.first_name AS first_name,
c.last_name AS last_name,
ct.name AS car_type_name
FROM `customer` AS c
INNER JOIN  outstation AS o ON c.id=o.customer_id
INNER JOIN car_types AS ct ON o.car_type_id=ct.id
WHERE o.id = '".$_GET['outstation_id']."' ";


$query = mysqli_query($con,$sql);
$data = mysqli_fetch_array($query);

$get_value_one = $data['extra_per_km_rate'] * $data['customer_extra_kms'];
$cal_min = $data['customer_extra_time'] * $data['extra_per_min_rate'];
$final = $cal_min + $get_value_one + $data['toll_n_parking_desc'] + $data['night_hault_desc'] + $data['amount'];

$ride_later_date = date("d-m-Y", strtotime($data['date']));		




$html = '
<html>
<head>

<style>
   #total {
      text-align:right;
   }

   #table {
	  width:100%;
	  font-family: "Times New Roman", Times, serif;
   }
   
#table td,tr {
	  text-align:left;
	  border:1px solid #ccc;
	
   }
  
   

</style>

</head>
<body>


<htmlpageheader name="myheader">';

$html.= '<img src="header.jpg">';

$currentMonth = date('n'); 

if ($currentMonth < 4) {
    
    $financialYear = (date('Y') - 1) . '-' . date('Y');
} else {
    
    $financialYear = date('Y') . '-' . (date('Y') + 1);
}

$html .= '<td>Invoice No: ' . $_GET['ref_id'] . '/' . $financialYear . '</td>';
$html.= '

<table id="table" widht="100%">
  <tbody>
   <tr>
     <td style="border:1px solid #ccc;">Bill To</td>
     <td  style="border:1px solid #ccc;">'.$data['first_name'].' '.$data['last_name'].'</td>
     <td style="border:1px solid #ccc;"></td>
     <td  style="border:1px solid #ccc;">Date:  '.$newDate.'</td>
   </tr>
  </tbody>
  <thead>
   <tr>
     <td style="border:1px solid #ccc;">Sr.No</td>
     <td style="border:1px solid #ccc;">Particulars</td>
     <td style="border:1px solid #ccc;">Kms/No. of Days/No. of Nights</td>
     <td style="border:1px solid #ccc;">Amount</td>
   </tr>
  </thead>
  <tbody>
  
  <tr>
     <td ></td>
     <td >Car Type : '.$data['car_type_name'].' </td>
     <td ></td>
     <td ></td>
   </tr>
   
   
   <tr>
     <td >1</td>
     <td >Rate: '.$data['fixed_rate'].'</td>
     <td >'.$data['distance'].' Kms</td>
     <td >'.$data['amount'].' Rs</td>
   </tr>
   
   <tr >
     <td ></td>
     <td>Extra Kms Rate: '.$data['extra_per_km_rate']. ' Rs/Km</td>
     <td >'.$data['customer_extra_kms'].' Kms</td>
     <td >'.$get_value_one.' Rs</td>
   </tr>


   <tr >
     <td ></td>
     <td>Extra Time: '.$data['extra_per_min_rate']. ' Rs/Min</td>
     <td >'.$data['customer_extra_time'].' Min</td>
     <td >'.$cal_min.' Rs</td>
   </tr>

   
    <tr>
     <td></td>
     <td> Parking & Tolltax:</td>
     <td ></td>
     <td >'.$data['toll_n_parking_desc'].' Rs</td>
   </tr>
   
   <tr>
     <td></td>
     <td> Driver Allowance:</td>
     <td ></td>
     <td >'.$data['night_hault_desc'].' Rs </td>
   </tr>
  
  
   <tr>
     <td></td>
     <td>
	 Pick up : '.$data['from_origin'].' <br>
	 Drop Off : '.$data['to_destination'].' 
	 <br><br><br>
	 Date of Journey : '.$ride_later_date.'
	 </td>
     <td></td>
     <td></td>
   </tr>
   
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3" ></td>
      <td id="total">Total: '.$final.' Rs</td>
    </tr>
   </tfoot>
 </table>
 
';

$html.='
<br>
<img src="footer.jpg">
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
