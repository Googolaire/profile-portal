<?php
$servername = "localhost";
$username = "carlamaster";
$password = "Styl3R3ady";
$dbname = "fashioncoordinators";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT ID, First_Name, Last_Name, City, State FROM clients";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["ID"]. " - Name: ". $row["First_Name"]. " " . $row["Last_Name"]. " ". $row["City"] . ", " .$row["State"]."<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
