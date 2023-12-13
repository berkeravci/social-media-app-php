<?php

const DSN = "mysql:host=localhost;dbname=deneme;port=8889;charset=utf8mb4" ;
const USER = "root" ; // use your own user account, probably, "root"
const PASSWORD = "root" ;

 $db = new PDO(DSN, USER, PASSWORD) ;
 
 function checkUser($email, $pass) {
     global $db ;
     $user = getUser($email) ;
     if ( $user ) {
         return password_verify($pass, $user["password"]) ;
     }
     return false ;
 }

 function validSession() {
     return isset($_SESSION["user"]) ;
 }

 function getUser($email) {
     global $db ;
     $stmt = $db->prepare("select * from auth where email=?") ;
     $stmt->execute([$email]);
     return $stmt->fetch() ;
 }

