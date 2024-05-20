<?php 
$host = "108.167.151.34";
$dbname = "evolud85_idpb";
$user = "evolud85_chris";
$password = "vGT{R_A^-E+4"; 

try{
    $pdo = new PDO("mysql:host=".$host.";dbname=".$dbname, $user, $password);
    
} catch(PDOException){
    echo 'erro';
}