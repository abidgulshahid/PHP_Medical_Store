
<?php


include "db.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Document</title>
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
    </style>
    <link href="signin.css" rel="stylesheet">

</head>
<body>
<body class="text-center">
    
    <main class="form-signin">
        <h2>Noman Medical Store</h2><br>
      <form action="" method="POST">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    
        <div class="form-floating">
          <input type="email" class="form-control" name='email' id="floatingInput" placeholder="name@example.com">
        </div>
        <div class="form-floating">
          <input type="password" name='password' class="form-control" id="floatingPassword" placeholder="Password">
        </div>
    
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <input type="submit" name="submit">
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
      </form>
    </main>
    
    
    
</body>
</html>


<?php
  if(isset($_POST['submit'])){

    $uname = mysqli_real_escape_string($db,$_POST['email']);
    $password = mysqli_real_escape_string($db,$_POST['password']);

    if ($uname != "" && $password != ""){

        $sql_query = "SELECT email,password FROM users WHERE email='".$uname."' AND password='".$password."'";
        echo "$uname , $password";
        $result = mysqli_query($db,$sql_query);
#        $count = $row['cntUser'];

        if( mysqli_num_rows($result) >0  ){

            while(  $row = mysqli_fetch_assoc($result))
            {
              $_SESSION['email'] = $row['email'];              
              $_SESSION['password']= $row['password'];

               if ( ($_SESSION['email'] == $uname) && ($_SESSION['password'] == $password ) ){

                 header("location: home.php");
               }

               else {
                 echo "INVALID";
               }
            }
        }
 

    }

}

?>