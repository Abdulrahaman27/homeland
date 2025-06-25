<?php 
// host

try {
if(!defined('HOSTNAME')) define("HOSTNAME", "localhost");
if(!defined('DBNAME')) define("DBNAME", "homeland");
if(!defined('USER'))define("USER", "root");
if(!defined('PASS'))define("PASS", "");

$conn = new PDO("mysql:host=".HOSTNAME. "; dbname=".DBNAME.";", USER, PASS);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database connection Failed: " . $e->getMessage());
}