<?php
/**
 * Created by IntelliJ IDEA.
 * User: joseph
 * Date: 1/4/14
 * Time: 1:02 PM
 */

 //sample usage

$username = "your@mtbusername.com" ;
$password="thatpassword";
$appId="1234";
$wsdl="http://go.mytxtbuddy.com/ws/mtbservice?wsdl";

include_once "Integrator.php";

$mtb = new Integrator($wsdl,$username,$password,$appId);
$mtb->sendMessage("test from new php API","test message","233268888338,233208270323","DJ. Joseph");
