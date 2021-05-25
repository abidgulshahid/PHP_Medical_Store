


<?php

include 'db.php';
global $result;


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
</head>
<body>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      #search {
          width: 20em;
          margin-left:100px;
      }

      #delete {
          margin-left: 70px;
      }
    </style>

    
    <link href="navbar-top.css" rel="stylesheet">
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">NMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Logout</a>
        </li>


      </ul>
      <form class="d-flex" method="GET" action='search.php'>
        <input class="form-control me-2" name='search' type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<main class="container">
  <div class="bg-light p-5 rounded">
    <h1>Search Data</h1>
    <center>


<table class="table">
 <thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Roll No</th>
</tr>

</thead>
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
<td><a href="update.php?id=<?php echo $row["id"]; ?>">Update</a></td>
</tr>
<?php
$i++;
$delete = $_GET['search'];
$del = mysqli_query($db, "DELETE  FROM categories WHERE categories.name=$roll_no ");
if($del)
{
echo "<script> alert('Deleted')</script>";
}
else {
    echo "<script> alert('Not Deleted') </script>";
}
}
?>
</table>

    </center>
  </div>
</main>



        
  </body>
</html>
