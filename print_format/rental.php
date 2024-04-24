<?php
include('connection.php');
$newDate = date("d-m-Y", strtotime(date('Y-m-d')));	

$sql = " SELECT dpl.*,
cpl.ride_later_date AS ride_later_date,
c.first_name AS first_name,
c.last_name AS last_name,
ct.name AS car_type_name,
p.hour AS package_hours,
p.km AS package_km,
p.name AS package_name,
pctl.amount AS package_amount,
cpl.pick_location AS pick_location
FROM `customer` AS c
INNER JOIN  customer_package_linking AS cpl ON c.id=cpl.customer_id
INNER JOIN driver_package_linking AS dpl ON dpl.customer_package_id=cpl.id
INNER JOIN package_cartype_linking AS pctl ON pctl.id=cpl.pctl_id
INNER JOIN car_types AS ct ON pctl.cartype_id=ct.id
INNER JOIN package AS p ON p.id=pctl.package_id
WHERE dpl.id = '".$_GET['driver_package_linking_id']."' ";
$query = mysqli_query($con,$sql);
if ($query) {
 


$data = mysqli_fetch_array($query);

$ride_later_date = date("d-m-Y", strtotime($data['ride_later_date']));

$final_extra_km_amount = $data['extra_perkm_rate'] * $data['customer_extra_kms'];
$final_extra_time_amount = $data['extra_min_rate'] * $data['customer_extra_time'];

$final_amount = $data['package_amount'] + $final_extra_km_amount + $final_extra_time_amount + $data['parking_and_tolltax'] + $data['driver_allowance'];
//$get_calculate = (ceil( (float) ($data['distance_user_destination_km'] / 2.5 ) )) * $data['base_price'];
//$final_amount = ($get_calculate) + ($data['driver_allowance']) + ($data['parking_and_tolltax']);

				  


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
     <td >1</td>
     <td >Car Type: '.$data['car_type_name'].'</td>
     <td >1 Days</td>
     <td ></td>
   </tr>

   <tr >
     <td ></td>
     <td>Rate: '.$data['package_amount'].' Rs For '.$data['package_hours'].' Hrs  '.$data['package_km'].' Kms  </td>
     <td >'.$data['package_km'].' Kms</td>
     <td >'.$data['package_amount'].' Rs</td>
   </tr>

   <tr>
     <td></td>
     <td> Extra Kms: '.$data['extra_perkm_rate'].' Rs/Km</td>
     <td >'.$data['customer_extra_kms'].' Kms</td>
     <td >'.$final_extra_km_amount.' Rs</td>
   </tr>
   
    <tr>
     <td></td>
     <td> Extra Time: '.$data['extra_min_rate'].' Rs/Min</td>
     <td >'.$data['customer_extra_time'].' Min</td>
     <td >'.$final_extra_time_amount.' Rs</td>
   </tr>
   
   
    <tr>
     <td></td>
     <td> Parking & Tolltax:</td>
     <td ></td>
     <td >'.$data['parking_and_tolltax'].' Rs</td>
   </tr>
   
   <tr>
     <td></td>
     <td> Driver Allowance:</td>
     <td ></td>
     <td >'.$data['driver_allowance'].' Rs </td>
   </tr>
  
  
   <tr>
     <td></td>
     <td>
	 Pick up : '.$data['pick_location'].' 
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
      <td id="total">Total: '.$final_amount.' Rs</td>
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
}
