<?php
 $host = 'localhost';
 $dbUsername = 'root';
 $dbPassword = '';
 $database = 'crud_demo';
 $port = '3308';


 $connection = mysqli_connect($host,$dbUsername,$dbPassword,$database,$port);

 if(!$connection){
     die("Connection failed: " . mysqli_connect_error());
 }