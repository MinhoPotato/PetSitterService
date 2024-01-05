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

            echo"<h1>All Sitters appear here</h1>
        <table>
        <tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Phone</th>
			<th>Email Address</th>
            <th>Assign Sitter</th>
		</tr>";

            if($conn->connect_error){
                die("<p style='color.red'>" . "Connection Failed: " . $conn->connect_error . "</p>");
            }

            $sql = "SELECT * FROM Sitter";
            $result = $conn->query($sql);
            $orderNum = $_GET["orderNum"];

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $person = $row['PersonID'];
                    $sql2 = "SELECT * FROM Person WHERE PersonID = $person";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();

                    echo "<tr>
                        <td>" . $row2["FirstName"] . "</td>
                        <td>" . $row2["LastName"] . "</td>
                        <td>" . $row2["Phone"] . "</td>
                        <td>" . $row2["Email"] . "</td>".
                        '<td> <form method="post" action="./sitterAssigned.php"><input type="hidden" name="orderNum" value="' . $orderNum . '">'.
                        '<input type="hidden" name="personID" value="' . $person . '"><input type="submit" value="Assign This Sitter"></form></td>';
                }
            }
            else{
                echo "<tr> 0 results </tr>";
            }
        ?>


</body>
</html>