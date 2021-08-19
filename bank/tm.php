<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
  

    <style type="text/css">

      button{
        transition: 1.5s;
      }
      button:hover{
        background-color:#DC5B3B ;
        color: white;
      }
      .text1{
    margin-top: 60px;
    margin-left: 850px;
}
    </style>
</head>

<body>
<?php
    include 'db.php';
    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection,$sql);
?>


<div class="container"  style= "background-color: #E98074">
        <h2 class="text-center pt-4">ALL CUSTOMERS</h2>
        <br>
                <div class="col">
                  
                    <table class="table table-hover table-sm table-striped table-condensed table-bordered"  style= "background-color:#EAE7DC   " >
                        <thead>
                            <tr>
                            <th scope="col" class="text-center py-2">Id</th>
                            <th scope="col" class="text-center py-2">Name</th>
                            <th scope="col" class="text-center py-2">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td class="text-center py-2" ><?php echo $rows['id'] ?></td>
                        <td class="text-center py-2"><?php echo $rows['name']?></td>
                        <td class="text-center py-2"><?php echo $rows['curbal']?></td>
                    </tr>
                <?php
                    }
                ?>
            
                        </tbody>
                    </table>
                    </div>
               
                
      </div>
         </body>
</html>