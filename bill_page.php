<?php
   include("db.php");

   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <title>Document</title>
      <style>
        .result{
         color:red;
        }
        td
        {
          text-align:center;
        }
      </style>
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
               <a class="nav-link active" aria-current="page" href="home.php">Home</a>
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
      <section class="mt-3">
         <div class="container-fluid">

         <div class="row">
            <div class="col-md-5  mt-4 ">
              <form action="pdff.php" method="POST">
              <div class="form-group">
                <select name="vegitable" id="vegitable"  class="form-control">
                   <?php
                      $sql = "SELECT * FROM categories";
                      $query = mysqli_query($db,$sql);
                      while($row = mysqli_fetch_assoc($query)){
                      ?>
             <option  id="<?php echo $row['id']; ?>" value="<?php echo $row['name']; ?>" class="vegitable custom-select"> <?php echo $row['name']; ?>  </option>
                   <?php  }?>

                </select>
     </div>



       <div class="form-group">
         <input type="number" name="price" class="form-control" id="price"  />

       </div>

       <div class="form-group">
         <input type="number"name="qty"  id="qty" min="0" value="0" class="form-control" placeholder="Quantity">

          <!-- <p id="price"></p> -->
       </div>


       <div class="form-group">
       <input style="margin-left:20%"  type="submit" value="Export To PDF ?"  name="submit" class="btn btn-primary">
     </div>

     <div class="form-group">
       <input type="text" name="name" class="form-control"  placeholder="Enter Buyer Name" />

     </div>

   </form>

     <button id="add" style="margin-right:20%; position:absolute;top:162px; width:94px;" class="btn btn-primary">Add</button>






                        <!-- <td><input  type="submit"  id="add" name="submit" class="btn btn-primary"></td> -->



                     <!-- </tr> -->
                     <!-- <button id="add"  class="btn btn-primary">Add</button> -->

                  <!-- </tbody> -->

               <!-- </table> -->


               <div role="alert" id="errorMsg" class="mt-5" >
                 <!-- Error msg  -->
              </div>
            </div>
            <div class="col-md-7  mt-4" style="background-color:#f5f5f5;">
               <div class="p-4">
                  <div class="text-center">
                     <h4>Receipt</h4>
                  </div>
                  <span class="mt-4"> Time : </span><span  class="mt-4" id="time"></span>
                  <div class="row">
                     <div class="col-xs-6 col-sm-6 col-md-6 ">
                        <span id="day"></span> : <span id="year"></span>
                     </div>
                     <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                        <p>Categories No:</p>
                     </div>
                  </div>
                  <div class="row">
                     </span>
                     <table id="receipt_bill" class="table">
                        <thead>
                           <tr>
                              <th> No.</th>
                              <th>Product Name</th>
                              <th>Quantity</th>
                              <th class="text-center">Price</th>
                              <th class="text-center">Total</th>
                           </tr>
                        </thead>
                        <tbody id="new" >

                        </tbody>
                        <tr>
                           <td> </td>
                           <td> </td>
                           <td> </td>
                           <td class="text-right text-dark" >
                                <h5><strong>Sub Total:  Rs </strong></h5>


                                <p><strong>Tax Rs:   <input type="number"style="width:10em;" placeholder="Enter Discount" id="discount" min="0" value="0">  </strong></p>
                           </td>
                           <td class="text-center text-dark" >
                              <h5> <strong><span id="subTotal"></strong></h5>
                              <h5> <strong><span id="taxAmount"></strong></h5>
                           </td>
                        </tr>
                        <tr>
                           <td> </td>
                           <td> </td>
                           <td> </td>
                           <td class="text-right text-dark">
                              <h5 name='gross'><strong>Gross Total: Rs </strong></h5>
                           </td>
                           <td class="text-center text-danger">
                              <h5 id="totalPayment"><strong> </strong></h5>

                           </td>
                        </tr>
                     </table>

                  </div>
               </div>
            </div>
         </div>
      </section>
   </body>
</html>
<script>
   $(document).ready(function(){
     $('#vegitable').change(function() {
      var id = $(this).find(':selected')[0].id;
       $.ajax({
          method:'POST',
          url:'fetch_page.php',
          data:{id:id},
          dataType:'json',
          success:function(data)
            {
               $('#price').val(data.details);

               //$('#qty').text(data.product_qty);
            }
       });
     });

     //add to cart
     var count = 1;
     $('#add').on('click',function(){

        var name = $('#vegitable').val();
        var qty = $('#qty').val();
        var price = $('#price').val();
        var discount = $('#discount').val();
        if(qty == 0)
        {
           var erroMsg =  '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
           $('#errorMsg').html(erroMsg).fadeOut(9000);
        }
        else
        {
           billFunction(); // Below Function passing here
        }

        function billFunction()
          {
          var total = 0;

          $("#receipt_bill").each(function () {
          var total =  price*qty;
          var subTotal = 0;
          subTotal += parseInt(total);

     var table =   '<tr><td>'+ count +'</td><td>'+ name + '</td><td>' + qty + '</td><td>' + price + '</td><td><strong><input type="hidden" id="total" value="'+total+'">' +total+ '</strong></td></tr>';
          $('#new').append(table)

           // Code for Sub Total of Vegitables
            var total = 0;
            $('tbody tr td:last-child').each(function() {
                var value = parseInt($('#total', this).val());
                if (!isNaN(value)) {
                    total += value;
                }
            });
             $('#subTotal').text(total);

            // Code for calculate tax of Subtoal 5% Tax Applied

              var Tax = (total /100) - discount;
              $('#taxAmount').text(Tax.toFixed(2));

             // Code for Total Payment Amount

             var Subtotal = $('#subTotal').text();
             var taxAmount = $('#taxAmount').text();

             var totalPayment = parseFloat(Subtotal) + parseFloat(taxAmount);
             $('#totalPayment').text(totalPayment.toFixed(2)); // Showing using ID

         });
         count++;
        }
       });
           // Code for year

           var currentdate = new Date();
             var datetime = currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear();
                $('#year').text(datetime);

           // Code for extract Weekday
                function myFunction()
                 {
                    var d = new Date();
                    var weekday = new Array(7);
                    weekday[0] = "Sunday";
                    weekday[1] = "Monday";
                    weekday[2] = "Tuesday";
                    weekday[3] = "Wednesday";
                    weekday[4] = "Thursday";
                    weekday[5] = "Friday";
                    weekday[6] = "Saturday";

                    var day = weekday[d.getDay()];
                    return day;
                    }
                var day = myFunction();
                $('#day').text(day);
     });
</script>

<!-- // Code for TIME -->
<script>
    window.onload = displayClock();

     function displayClock(){
       var time = new Date().toLocaleTimeString();
       document.getElementById("time").innerHTML = time;
        setTimeout(displayClock, 1000);
     }
</script>
