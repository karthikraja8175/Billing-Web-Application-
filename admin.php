 <!DOCTYPE html>
 <html>
    <head>
        <title>admin</title>
        <link rel="stylesheet" href="adminstyle.css">
    </head>
    <body style="background-color:rgb(201, 201, 202);"> 
    <img id="home" onclick="window.location.href='index.html';" class="home" value="click" src="images/home.png">
    <button class="adminbutton1" onclick="window.location.href='stickeradmin.php';">sitcker</button>
    <button class="adminbutton2" onclick="window.location.href='flexadmin.php';">flex</button>
    <button class="adminbutton3" onclick="window.location.href='frameadmin.php';">frame</button>
    <button class="adminbutton4" onclick="window.location.href='othersadmin.php';">others</button>
    <h2 style="color:black;position:fixed;top:6px;left:150px;">SALES DETAILS</h2>
    
        <!--date session start-->
    <form action="" method="GET">
          <h1>
               <div class="formdate" style="width:330px;height:65px;border-radius:20px;">
                          <label>From Date &nbsp;</label>
                               <input type="date"  required="" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control"> <br>                
                          <label>To Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                              <input type="date" required="" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                             </div>
                          <button type="submit" class="filter" style="cursor:pointer;position:fixed;top:180px;left:310px;background-color:rgb(0, 0, 0);color:white;width:100px;height:45px;border-radius: 20px;">Filter</button>
                   </h1>
                </form>
<?php  
//database connection 
 $conn=mysqli_connect("localhost","root","","alagu");  
 //hostname, username, password, database name  
  
  
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
            
               echo'<div class="table">'; 
               echo'<table  border="3" style="position:sticky;top:100px;left:600px;color:white;width:300px;background-color:rgb(0, 0, 0);overflow:auto;">';
               echo'<h1>';  
               echo'<tr>'; 
               echo'<th>DATA</th>';  
               echo'<th>PRODUCT</th>';    
               echo'<th>AMOUNT</th>';
               echo'</tr>';  
               echo'</h1>';   

               $from_date = $_GET['from_date'];
               $to_date = $_GET['to_date'];
               
               $sticker = "SELECT date,product,amount FROM sticker WHERE date BETWEEN '$from_date' AND '$to_date' ";
               $flex = "SELECT date,product,amount FROM flex WHERE date BETWEEN '$from_date' AND '$to_date' ";
               $frame = "SELECT date,product,amount FROM frame WHERE date BETWEEN '$from_date' AND '$to_date' ";
               $others = "SELECT date,product,amount FROM others WHERE date BETWEEN '$from_date' AND '$to_date' ";

               $stickerresult = $conn->query($sticker);
               $flexresult = $conn->query($flex);
               $frameresult = $conn->query($frame);
               $othersresult = $conn->query($others);

               $stickersum = 0;
               if(mysqli_num_rows($stickerresult) > 0){
                 while($row = $stickerresult->fetch_assoc()){
                    $stickersum += $row['amount'];
                }
            }

               $flexsum = 0;
               if(mysqli_num_rows($flexresult) > 0){
                 while($row = $flexresult->fetch_assoc()){
                    $flexsum += $row['amount'];
                 }
               }
                
               $framesum = 0;
               if(mysqli_num_rows($frameresult) > 0){
                 while($row = $frameresult->fetch_assoc()){
                    $framesum += $row['amount'];
                }
            }

            $otherssum = 0;
               if(mysqli_num_rows($othersresult) > 0){
                 while($row = $othersresult->fetch_assoc()){
                    $otherssum += $row['amount'];
                }
            }
               $totalsum = $stickersum + $flexsum + $framesum + $otherssum;
               echo '<div class="total" style="position:fixed;top:380px;left:50px;background-color:rgb(0, 0, 0);color:rgb(255, 255, 255);">';
               echo '<h2>';
               echo "Total amount: " .$totalsum;
               echo '</h2>';
               echo '<div>';

               if(mysqli_num_rows($stickerresult) > 0){
                foreach($stickerresult as $row)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $row['date']; ?></td>
                                            <td><?= $row['product']; ?></td>
                                            <td><?= $row['amount']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                
           } 
           
           else{
                echo '<div class="no_sales1">';
                echo '<h2>';
                echo "no sticker sales";
                echo "<br>";
                echo '</h2>';
                echo '</div>';
             }   
             

             if(mysqli_num_rows($flexresult) > 0){
                foreach($flexresult as $row)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $row['date']; ?></td>
                                            <td><?= $row['product']; ?></td>
                                            <td><?= $row['amount']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                
           } 
           else{
                echo '<div class="no_sales2">';
                echo '<h2>';
                echo "no flex sales";
                echo "<br>";
                echo '</h2>';
                echo '</div>';
             }   

             if(mysqli_num_rows($frameresult) > 0){
                foreach($frameresult as $row)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $row['date']; ?></td>
                                            <td><?= $row['product']; ?></td>
                                            <td><?= $row['amount']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                   
           } 
           else{
                echo '<div class="no_sales3">';
                echo '<h2>';
                echo "no frame sales";
                echo "<br>";
                echo '</h2>';
                echo '</div>';
             }   

             if(mysqli_num_rows($othersresult) > 0){
                foreach($othersresult as $row)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $row['date']; ?></td>
                                            <td><?= $row['product']; ?></td>
                                            <td><?= $row['amount']; ?></td>
                                        </tr>
                                        <?php
                                    }
           } 
           else{
                echo '<div class="no_sales4">';
                echo '<h2>';
                echo "no others sales";
                echo "<br>";
                echo '</h2>';
                echo '</div>';
             }  
             
             echo "<br>" ; 
             echo '<div class="separate" style="position:fixed;bottom:50px;left:50px;">';
             echo '<h2>';
             $sql1 = "SELECT  SUM(amount) FROM sticker WHERE date BETWEEN '$from_date' AND '$to_date' ";
             $result = $conn->query($sql1);
             while($row = mysqli_fetch_array($result)){
             echo " sticker cost: ". $row['SUM(amount)'];
             echo "<br>";
            }
            $sql2 = "SELECT  SUM(amount) FROM flex WHERE date BETWEEN '$from_date' AND '$to_date' ";
                 $result = $conn->query($sql2);
                 while($row = mysqli_fetch_array($result)){
                 echo " flex cost: ". $row['SUM(amount)'];
                 echo "<br>";
               }     
               $sql3 = "SELECT  SUM(amount) FROM frame WHERE date BETWEEN '$from_date' AND '$to_date' ";
                 $result = $conn->query($sql3);
                 while($row = mysqli_fetch_array($result)){
                 echo " frame cost: ". $row['SUM(amount)'];
                 echo "<br>";
               }     
               $sql4 = "SELECT  SUM(amount) FROM others WHERE date BETWEEN '$from_date' AND '$to_date' ";
                 $result = $conn->query($sql4);
                if($row4 = mysqli_fetch_array($result)){
                 echo " others cost: " . $row4['SUM(amount)'];
                 echo "<br>";
               }
               echo '</h2>';
               echo '</div>';
        
               echo'</table>'; 
               echo' </div>';   
            }
        
 ?>

 
 
 </body>
</html>