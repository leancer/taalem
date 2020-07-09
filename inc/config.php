<?php

$dm = "assests/img/default_M.png";
$df = "assests/img/default_F.png";

require_once 'envfile.php';

define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', dirname($_SERVER['SCRIPT_NAME']));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER.'/');



$con = mysqli_connect("localhost","root",""); 
$res = mysqli_query($con,"SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'academydb'");
if (mysqli_num_rows($res) == 0) {
 
 $query = '';
$sqlScript = file('dbbackup/academydb.sql');
foreach ($sqlScript as $line)   {
    
    $startWith = substr(trim($line), 0 ,2);
    $endWith = substr(trim($line), -1 ,1);
    
    if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
        continue;
    }
        
    $query = $query . $line;
    if ($endWith == ';') {
        mysqli_query($con,$query) or die("not import");
        $query= '';     
    }
}   


}





function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'dXxlvut9xe';
    $secret_iv = 'dXxlvut9xe';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}
if (isset($_COOKIE['username'])) {
	$_SESSION['regid'] = my_simple_crypt($_COOKIE['regid'],"d");
    $_SESSION['username'] = my_simple_crypt($_COOKIE['username'],"d");
    $_SESSION['usertype'] = $_COOKIE['usertype'];
}