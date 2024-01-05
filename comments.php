<!DOCTYPE html>
<html>
    <head>
        <title>Comments Page</title>
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
<table>
        <tr>
			<th>Name</th>
			<th>Date Posted</th>
			<th>Body Text</th>
		</tr>
    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "finalproject";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("<p style='color.red'>" . "Connection Failed: " . $conn->connect_error . "</p>");
    }


    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $OrderNumber=$_GET['orderNum'];
        $sql = "SELECT * FROM Comment WHERE OrderNumber='$OrderNumber' ORDER BY DatePosted DESC";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $userid = $row["PersonID"];
                $sql2 = "SELECT FirstName, LastName FROM Person WHERE PersonID = '$userid'";
                $result2 = $conn->query($sql2);
                while($row2 = $result2->fetch_assoc()){
                    echo "<td>" .$row2["FirstName"] . " " . $row2["LastName"] ."</td>";

                echo "<td>" . $row["DatePosted"] ."</td>".
                "<td>" . $row["BodyText"] . "</td></tr>";
                }
            }
        }
    }
    else{
        //echo "No Comments";
    }

    $OrderNumber=$_GET['orderNum'];
    $userNumber=$_GET['userID'];

    echo '<h1>Enter Comment Here</h1>
    <form method="post" action="./commentpost.php">
        <label for="bodyText">Body Text</label>
        <input type="text" name="bodyText"><br>
        <input type="hidden" name="orderNum" value = "' .$OrderNumber. '">
        <input type="hidden" name="userID" value = "' .$userNumber. '">

        <input type="submit" value="Post Comment">
    </form>';

    ?>
    </table>

</body>
</html>