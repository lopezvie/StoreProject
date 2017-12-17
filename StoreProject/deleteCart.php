<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();

include 'DatabaseClass.php';

$db->deleteCart($_SESSION['id_user']);

echo $temp;