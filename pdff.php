<?php
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();


$veg = $_POST['data'];
$qty = $_POST['qty'];
$p = $_POST['price'];
$d = $_POST['discount'];

$data = '';
$data .= "VEG". $veg . "<br>";
$data .= "d". $d;


$mpdf->WriteHTML($data);
$mpdf->Output();


 ?>
