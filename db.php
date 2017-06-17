<?php
ini_set('display_errors', 'On');

$HOST = '127.0.0.1';
$USER = 'root';
$PASSWORD = 'root';
$DATABASE = 'qfood';

$db = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);
if ($db === false) {
    die('Database connection error ' . mysqli_connect_error());
}
