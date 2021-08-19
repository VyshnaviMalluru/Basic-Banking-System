<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <style type="text/css">
      button{
        transition: 1.5s;
      }
      button:hover{
        background-color:rgb(204, 215, 217 );
        color:black ;
      }
      .text1{
    margin-top: 60px;
    margin-left: 850px;
}
.btn{
    background-color: #D8C3A5;
    border-radius: 10px;
    color: black;
    text-align: center;
    text-decoration: black;
    display: block;
    font-size: 16px;
    width: 20%; 
}
.py{
    color: black;
    text-align: center;
    text-decoration: black;
    margin-left: -300px;
}
    </style>
</head>

<body>
<?php
    include 'db.php';
    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection,$sql);
?>



<div class="container"  style= "background-color: #E98074" >
        <h2 class="text-center pt-4">Transaction</h2>
        <br>
            
                <div class="col">
                
                    <table class="table table-hover table-sm table-striped table-condensed table-bordered" style= "background-color:  #EAE7DC ">
                        <thead>
                            <tr>
                            <th scope="col" class="text-center py">Id</th>
                            <th scope="col" class="text-center py">Name</th>
                            <th scope="col" class="text-center py">Transaction From</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php 
                    while($rows=mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td class="py"><?php echo $rows['id'] ?></td>
                        <td class="py"><?php echo $rows['name']?></td>
                        <td ><a href="sud.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class=" btn"  >Transaction</button></a></td> 
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