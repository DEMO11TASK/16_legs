<?php

//connecting to the Database

$servername = "localhost";
$username = "root";
$password = "";

//create a Connection

$conn = mysqli_connect($servername, $username, $password);


//to conform connection between database

if(!$conn)
{
die("Sorry we failed to connect: ". mysql_connect_error());
}
else
{
echo "Connection was succesful";
}

?>