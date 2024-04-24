<?php
include('connection.php');
$newDate = date("d-m-Y", strtotime(date('Y-m-d')));		
$sql = "Select * 
From `customer` as c
inner join  customer_travel_linking as ctl ON c.id=ctl.customer_id
inner join driver_customer_linking as dcl ON dcl.customer_travel_id=ctl.id
INNER JOIN car_types as ct ON ct.id=ctl.car_type_id
INNER JOIn driver_car_linking as d_car_l ON d_car_l.driver_id=dcl.driver_id
INNER JOIN cars AS car ON car.id=d_car_l.car_id
where dcl.id = '".$_GET['driver_car_linking_id']."'";
$query = mysqli_query($con,$sql);
if (!$query) {
  die("Query failed: " . mysqli_error($con));
}
$data = mysqli_fetch_array($query);

$get_calculate = (ceil( (float) ($data['distance_user_destination_km'] / 2.5 ) )) * $data['base_price'];
$final_amount = ($get_calculate) + ($data['driver_allowance']) + ($data['parking_and_tolltax']);

				  


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
     <td >Car Name: '.$data['car_name'].'</td>
     <td >1 Days</td>
     <td ></td>
   </tr>
   
   <tr >
     <td ></td>
     <td>Rate: '.$data['base_price'].' Rs/ 2.5 Kms </td>
     <td >'.$data['distance_user_destination_km'].' Kms</td>
     <td >'.$get_calculate.' Rs</td>
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
	 Pick up : '.$data['from_location'].' <br>
	 Drop Off : '.$data['to_location'].'
	 <br><br><br>
	 Date of Journey : '.$data['ride_later_date'].'
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
