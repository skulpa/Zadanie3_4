<?php
$servername = "mysql";
$username = "root";
$password = "mysql";
$dbname = "Crawler";

if(!empty($_GET['search'])){
    $searchTerm = $_GET['search'];
}

// Polaczenie z baza danych 
$conn = new mysqli($servername, $username, $password, $dbname);

// Polaczenie z baza danych 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getResults($conn, $searchTerm) {
    $sql = "SELECT `id`, `site`, `content`, `date` FROM `SitesViewed` WHERE 1";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$myArray = [];

	    // output data of each row
	    while($row = $result->fetch_assoc()) {
            $myArray[] = $row;
	    }

	    echo json_encode($myArray);
	} else {
	    echo "0 results";
	}
}

if(isset($searchTerm)) {
	getResults($conn, $searchTerm);
}

// Zamykanie bazy danych 
$conn->close();

?>