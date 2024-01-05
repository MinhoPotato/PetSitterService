<!DOCTYPE html>
<html>
    <head>
        <title>Client Viewing Page</title>
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

        echo"<h1>All requests appear here</h1>
        <table>
        <tr>
			<th>Order Number</th>
			<th>Type of Order</th>
			<th>Date Posted</th>
			<th>Date Due</th>
            <th>Service State</th>
            <th>Client ID</th>
            <th>Sitter ID</th>
            <th>Comments</th>
            <th>Action</th>
		</tr>";

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "finalproject";

    $conn = new mysqli($servername, $username, $password, $dbname);
    session_start();

    if($conn->connect_error){
        die("<p style='color.red'>" . "Connection Failed: " . $conn->connect_error . "</p>");
    }

    $userid = $_SESSION['userID'];
    $sql = "SELECT * FROM Service WHERE Archived = 0 AND clientID = '$userid'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr>
				<td>" . $row["OrderNumber"] . "</td>
				<td>" . $row["TypeOfOrderID"] . "</td>
				<td>" . $row["DatePosted"] . "</td>
			    <td>" . $row["DateDue"] . "</td>
                <td>" . $row["ServiceState"] . "</td>
                <td>" . $row["ClientID"] . "</td>
                <td>" . $row["SitterID"] . "</td>".
                '<td> <form method="get" action="./comments.php"><input type="hidden" name="orderNum" value="' . $row["OrderNumber"]. '"><input type = "hidden" name = "userID" value = "'.$userid.'"><input type="submit" value="View Comments"></form></td>';
            
            if($row["SitterID"] != null && $row["ServiceState"] == "Pending"){
                echo '<td> <form method="get" action="./comments.php"><input type="submit" value="View Sitters"></form></td>'
                .'</tr>';
            }
            else if($row["ServiceState"] == "Completed"){
                echo '<td> <form method="post" action="./ArchiveOrder.php"><input type="hidden" name="orders" value="' .$row["OrderNumber"]. '"><input type="submit" value="Validate Completed Order"></form></td>'
                .'</tr>';
            }
            else{
                echo '<td> No Actions Avaliable </td></tr>';
            }
        }
    }
    else{
        echo "<tr> 0 results </tr>";
    }

    echo"</table>";

    echo '<h1>Request Service</h1>
    <form method="post" action="./servicePost.php">
        <label for="orderType">Order Type</label>
        <input type="text" name="orderType"><br>
        <label for="DueDate">Due Date</label>
        <input type="date" name="DateDue"><br>
        <input type="hidden" name="userID" value = "' .$userid. '">

        <input type="submit" value="Request Service">
    </form><br>';

    ?>
    </body>
</html>