<?php
$dbhost ='localhost';
$dbname ='myDbName';
$dbPwd = '';
$dbUser='root';
try{
$db = new PDO('mysql:host=.db;port=3306;dbname=mysql;charset=utf8','user','password',array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
));
}catch(PDOException $pe){
    echo $pe->getMessage();
}   
?>