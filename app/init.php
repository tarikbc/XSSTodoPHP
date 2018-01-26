<?php

session_start();
header("X-XSS-Protection: 0");
$_SESSION['user_id'] = 1;

$db = new PDO('mysql:host=localhost;dbname=todo', 'root', 'root');


if(!isset($_SESSION['user_id'])) {
    die("You are not signed in.");
}
