<?php 
$host = "localhost"
$dbname = "database_name"
$user = "username"
$password = "password"

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password")

if (!$conn) {
    die("Connection failed:" . pg_last_error())
}