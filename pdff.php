<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'db.php';

$mpdf = new \Mpdf\Mpdf();

// $sql = "SELECT * FROM categories WHERE id='".$_POST['id']."'";
// $query = mysqli_query($db,$sql);
// while($row = mysqli_fetch_assoc($query))
// {
//       $data = $row;
//
//
// }
// $name = $_POST['veg'];



if(isset($_POST['submit'])){
  $name = $_POST['vegitable'];
  $price = $_POST['price'];
  $buyer = $_POST['name'];
  $qty = $_POST['qty'];

$total = $price * $qty;

$html = "NMS"."<br>";
$html .= "Address: GPGC Lakki Marwat"."<br>";;
$html .= "Buyer Name:".$buyer."<br>";;
$html .= "Total Quantity:".$qty."<br>";;
$html .= "Price of Each Quantity: ".$price."<br>";;
$html .= "Your Bill: ".$total."<br>";;



  $mpdf->WriteHTML($html);
  $mpdf->Output();

}


 ?>
