<!DOCTYPE html>
<html>
<head>
<title> sticker admin page</title>
<link rel="stylesheet" href="adminstyle.css">

</head>
<body style="background-color:rgb(201, 201, 202);">

     <img onclick="window.location.href='admin.php';" class="back" value="click" src="images/back.png"> 
     <img  onclick="window.location.href='index.html';" class="home" value="click" src="images/home.png">

    <form action="" method="GET">
           <h1>
               <div class="formdate" style="width:330px;height:65px;border-radius:20px;">
               <label>From Date &nbsp;</label>
                               <input type="date"  required="" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control"> <br>                
                          <label>To Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                              <input type="date" required="" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                             </div>
                          <button type="submit" class="filter" style="cursor:pointer;position:fixed;top:180px;left:310px;">Filter</button>
                   </h1>
                        </form>
    
           <?php
           $conn=mysqli_connect("localhost","root","","alagu"); //database connection  
           //hostname, username, password, database name  
           if ($conn) { 
                echo'<div class="heading" style="color:black;position:fixed;top:20px;left:150px;">'; 
                echo "STICKER DETAILS";  
                echo'</div>';
           }else{  
                echo "Error";  
           } 
           
           if(isset($_GET['from_date']) && isset($_GET['to_date']))
           {
               echo '<div class="sales" style="position:fixed;top:280px;left:50px;">';
               echo '<h2>';
               echo "sales details:";
               if(isset($_GET['from_date'])){ echo $_GET['from_date']; }
               echo" to "; 
               if(isset($_GET['to_date'])){ echo $_GET['to_date']; }
               echo "<br>";
               echo '</h2>';
               echo '</div>';

               //table start
               echo'<div class="table1">';  
               echo'<table border="5" style="position:sticky;top:100px;left:520px;color:white; background-color:rgb(0, 0, 0);width:650px;overflow:auto;">';  
               echo'<tr>';  
               echo'<th>DATE</th>';  
               echo'<th>VEHICLE NUMBER</th>';  
               echo'<th>VEHICLE TYPE</th>';
               echo'<th>VEHICLE NAME</th>';   
               echo'<th>AMOUNT</th>';
               echo'</tr>';  

               $from_date = $_GET['from_date'];
               $to_date = $_GET['to_date'];

               $query = "SELECT * FROM sticker WHERE date BETWEEN '$from_date' AND '$to_date' ";
               $query_run = mysqli_query($conn, $query);

               if(mysqli_num_rows($query_run) > 0){
                    foreach($query_run as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['date']; ?></td>
                                                <td><?= $row['venum']; ?></td>
                                                <td><?= $row['vtype']; ?></td>
                                                <td><?= $row['vname']; ?></td>
                                                <td><?= $row['amount']; ?></td>
                                            </tr>
                                            <?php
                                        }
               }    
               else{
                    echo '<div class="no_salesall">';
                    echo '<h2>';
                    echo "no STICKER sales on this days";
                    echo "<br>";
                    echo '</h2>';
                    echo '</div>';
               } 
               $sql = "SELECT  SUM(amount) from sticker WHERE date BETWEEN '$from_date' AND '$to_date' ";
                $result = $conn->query($sql);
                //display data on web page
                while($row = mysqli_fetch_array($result)){
                    echo '<div class="total" style="position:fixed;top:380px;left:50px;">';
                    echo '<h2>';
                    echo " Total cost: ". $row['SUM(amount)'];
                    echo "<br>";
                    echo '</h2>';
                    echo '<div>';
               }  
               echo'</table>';  
               echo'</div>'; 
               
               }
          
                ?>  
        
</body>

</html>
