<?php
mb_language("ja");
mb_internal_encoding("UTF-8");
$event = array();
//$timestamp = strtotime("2016-09-18 11:00:31");
//$timestamp = strtotime("now");
$timestamp = strtotime("-3 hours");
$timehi = date("Hi", $timestamp);
echo $timehi;
?>
