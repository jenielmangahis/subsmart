<?php
include_once("includes.php");


$regId = array("fANZx07ybETJo5zENNjKpE:APA91bHSYsGSIwP1M6OneEpCxJaLhiAORQ2L6-ThmSb03o1oUMMRXoII0oP8QCe-OtwRD9tyQ1vF1Z5r6sfsZysd6HRXuww_JE7Yyz5grU6Rebytp0ufjW1cAFBfBxmSnCdo2l_V63PR");

send_ios_push($regId, "Sample Push", "Lorem ipsum dolor amet");
?>
