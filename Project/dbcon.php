<?php 
$hostname = "localhost";
$username = "id10949994_teamtreasurehng";
$password = "tenmembers";
$dbname = "id10949994_team_treasure";
// Create connection
$connect2db= mysqli_connect($hostname, $username, $password, $dbname);

// Check connection
if (!$connect2db) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";
?>
