<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="style.css">
        <title>Post Comment</title>
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
    $dbname = "finalProject";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("<p style='color.red'>" . "Connection Failed: " . $conn->connect_error . "</p>");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user = $_POST["userID"];
        $body = $_POST["bodyText"];
        $order = $_POST["orderNum"];
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $currentDate = date("Y-m-d");

        $sql = "INSERT INTO Comment(PersonID, DatePosted, BodyText, OrderNumber, IPAddress) VALUES ('$user ', '$currentDate', '$body', '$order', '$ipAddress')";

        if($conn->query($sql) == TRUE){
            echo "<h1 class=success>Comment was Added!</h1>";
        }
        else{
            echo "<h1 class=failure>Comment was not added</h1>";
        }

    }
    $conn->close();
    ?>

</body>
</html>