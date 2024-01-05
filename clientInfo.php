<!DOCTYPE html>
<html>
    <head><title>Client Info</title>
    <link rel="stylesheet" href="style.css"></head>
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

            
            if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['client'])){
                $client=$_GET['client'];
                $sql = "SELECT * FROM Person WHERE PersonID='$client'";
                $result = $conn->query($sql);
            
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    echo "<h1>" . $row["FirstName"] ." " . $row["LastName"] . "</h1>";
                    if($row["Phone"] != null){
                        echo "<h2>" . $row["Phone"] . "</h2>";
                    }
                    else{
                        echo "<h2>" . "No Phone Number Given" . "</h2>";
                    }
                    
                    echo "<h3>" . $row["Email"] . "</h3>";
                }
            }
            else{
                echo "Error 404";
            }
        ?>

        </body>
</html>