<?php include 'db.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($connection,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($connection,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['curbal']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['curbal'] - $amount;
                $sql = "UPDATE users set curbal=$newbalance where id=$from";
                mysqli_query($connection,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['curbal'] + $amount;
                $sql = "UPDATE users set curbal=$newbalance where id=$to";
                mysqli_query($connection,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `curbal`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($connection,$sql);

                
                    if(isset($query)){
                     header("LOCATION: tm1.php");   
                    }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

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
			border:none;
			background: #d9d9d9;
		}
	    button:hover{
			background-color:#777E8B;
			transform: scale(1.1);
			color:white;
		}
        .text1{
    margin-top: 60px;
    margin-left: 900px;
}
.form-control{
    background-color: #EAE7DC;
}
form-contol:hover{
    background-color: rgb(204, 215, 217 );
}

    </style>
</head>

<body>
 

	<div class="container" style= "background-color: #E98074">
        <h2 class="text-center pt-4">Transaction</h2>
            <?php
                include 'db.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $result=mysqli_query($connection,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($connection);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered" style= "background-color: #EAE7DC">
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['curbal'] ?></td>
                </tr>
            </table>
        </div>
        
        <br><br><br>
        <label>Transfer To:</label>
        <select name="to" class="form-control" required>
            <option value="">Choose</option>
            <?php
                include 'db.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result=mysqli_query($connection,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($connection);
                }
                while($rows1 = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows1['id'];?>" >
                
                    <?php echo $rows1['name'] ;?>
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label>Amount:</label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <input class="btn mt-3" name="submit" type="submit" id="myBtn">
            </div>
        </form>
    
    
      </div>
</body>
</html>