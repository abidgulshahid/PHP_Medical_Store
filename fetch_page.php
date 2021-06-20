<?php
  include("db.php");

   $sql = "SELECT * FROM categories WHERE id='".$_POST['id']."'";
   $query = mysqli_query($db,$sql);
   while($row = mysqli_fetch_assoc($query))
   {
         $data = $row;
   }
    echo json_encode($data);
 ?>
