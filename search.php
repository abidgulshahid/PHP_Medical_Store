<?php

include 'db.php';
global $result;

?>
<!DOCTYPE html>
<html>
<head>
<title> Retrive data</title>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
<table>
<tr>
<td>Name</td>
<td>Email</td>
<td>Roll No</td>

</tr>
<?php
if(count($_GET)>0) {
    $roll_no=$_GET['search'];
    $result = mysqli_query($db,"SELECT * FROM categories where name='$roll_no'");
   
}
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
<td><?php echo $row["name"]; ?></td>
<td><?php echo $row["type"]; ?></td>
<td><?php echo $row["details"]; ?></td>
<td><a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
</tr>
<?php
$i++;

   
 $delete = $_GET['search'];
$del = mysqli_query($db, "DELETE  FROM categories WHERE categories.name=$roll_no ");
if($del)
{
printf("DELETED");
}
else {
    printf("NOT DELETE");
}
}

?>
</table>
</body>
</html>