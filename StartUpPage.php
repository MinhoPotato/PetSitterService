<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="mystyle.css">
    <title>Start Up Page</title>
    <style>
            body{
                background-image: url('https://marketplace.canva.com/EAFGTWo8g38/3/0/1600w/canva-brown-cute-illustration-pet-care-service-presentation--8r1H3_FVeY.jpg');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center 1%;
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

    if($conn->connect_error){
        die("<p style='color.red'>" . "Connection Failed: " . $conn->connect_error . "</p>");
    }

    session_start();
    $sql = "SELECT * FROM Person";
    $result = $conn->query($sql);
    $userid = $_GET['userID'];
    $_SESSION['userID'] = $userid;


    if($result->num_rows > 0){
        $getHandler = "SELECT personID FROM Handler WHERE personid='$userid'";
        $handlerResult = $conn->query($getHandler);
        $handler = $handlerResult->fetch_assoc();
        //get handler stuff
        $getSitter = "SELECT personID FROM Sitter WHERE personid='$userid'";
        $sitterResult = $conn->query($getSitter);
        $sitter = $sitterResult->fetch_assoc();
        //get sitter stuff
        $getClient = "SELECT personID FROM Client WHERE personid='$userid'";
        $clientResult = $conn->query($getClient);
        $client = $clientResult->fetch_assoc();
        //get client stuff
        
        $password = $_GET['password'];
        $sql2 = "SELECT Password FROM Person WHERE personid='$userid'";
        $result2 = $conn->query($sql2);
        $row = $result2->fetch_assoc();


        if($handlerResult->num_rows > 0 && $userid == $handler['personID'] && $password == $row["Password"]){
            header("Location: handlerpage.php");
            exit();
        }
        else if($sitterResult->num_rows > 0 && $userid == $sitter['personID'] && $password == $row["Password"]){
            header("Location: sitterpage.php");
            exit();
        }
        else if($clientResult->num_rows > 0 && $userid == $client['personID'] && $password == $row["Password"]){
            header("Location: clientpage.php");
            exit();
        }
        else{
            echo '<h1 class=failure>Login Failed!</h1>';
        }
    }
?>
</body>
</html>