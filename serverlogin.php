<?php
//error_reporting(E_ALL);
$servername = "localhost";
$serverusername = "root";
$password = "";
$dbname = "llama";
$conn = new mysqli($servername, $serverusername, $password, $dbname);
session_start();
// Check connection
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
//echo "Connected successfully";
?>