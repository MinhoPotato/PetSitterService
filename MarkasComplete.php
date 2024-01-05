<!DOCTYPE html>
<html>
<head>
    <title>Mark Order as Complete</title>
    <link rel="stylesheet" href="style.css">
    <style>
            body{
                background-image: url('https://images.squarespace-cdn.com/content/v1/641a12815f0b1b443327c6ff/be3cbd81-f88f-42b4-b495-4381452cddd5/Untitled+design+%2810%29.png');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center 5%;
            }
            h1{
                text-align: center;
                font-size: 2em; 
                font-weight: bold; 
            }
            </style>
</head>
<body>
<?php 
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "finalproject";

            $conn = new mysqli($servername, $username, $password, $dbname);
            session_start();

            if($conn->connect_error){
                die("<p style='color.red'>" . "Connection Failed: " . $conn->connect_error . "</p>");
            }

            
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['orders'])){
                $orderid=$_POST['orders'];

                $sql = "UPDATE Service SET ServiceState = 'Completed' WHERE OrderNumber = '$orderid'";

                if($conn->query($sql) == TRUE){
                    echo "<h1 class=success>Order was marked as complete!</h1>";
                }
                else{
                    echo "<h1 class=failure>Order was Not marked as complete";
                }
            }
            else{
                echo "Error 404";
            }
        ?>


</body>
</html>