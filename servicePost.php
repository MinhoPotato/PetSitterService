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

            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userID'])){
                $userid=$_POST['userID'];
                $currentDate = date("Y-m-d");
                $dateDue=$_POST['DateDue'];


                $type = $_POST["orderType"];
                $sql2 = "SELECT TypeOfOrderID FROM OrderTypes WHERE TypeName = '$type'";
                $result2 = $conn->query($sql2);
                $typeNum;

                if($result2->num_rows > 0){
                    $row2 = $result2->fetch_assoc();
                    $typeNum = $row2["TypeOfOrderID"];
                }
                else{
                    $sql3 = "INSERT INTO OrderTypes(TypeName) VALUES ('$type')";
                    $result4 = $conn->query($sql3);
                    $result3 = $conn->query($sql2);
                    $row3 = $result3->fetch_assoc();
                    $typeNum = $row3["TypeOfOrderID"];
                }
                //if the order does not exist in our list, add it to the list


                $sql = "INSERT INTO Service(TypeOfOrderID, DatePosted, DateDue, ServiceState, ClientID, Archived) VALUES ('$typeNum', '$currentDate', '$dateDue', 'Pending', '$userid', '0')";


                if($conn->query($sql) == TRUE){
                    echo "<h1 class=success>Order was submitted!</h1>";
                }
                else{
                    echo "<h1 class=failure>Order was not Submitted.</h1>";
                }
            }
            else{
                echo "Error 404";
            }
        ?>


</body>
</html>