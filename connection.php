<?php
$dbhost = "sql201.byetcluster.com";
$dbuser = "epiz_33025911";
$dbpass = "juACwFlGd0ktMu";
$dbname = "epiz_33025911_middlefund";  

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
$base_url = "http://middlefund.lovestoblog.com/SignInUpNew/";
$base_url1 = "http://middlefund.lovestoblog.com/investor/";
$my_email = "malti@ripplesfoundation.org";

?>