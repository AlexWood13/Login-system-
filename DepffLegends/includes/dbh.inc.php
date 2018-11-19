<?php

$servername = "depffleague.co.uk.mysql";
$dBUsername = "depffleague_co_uk";
$dBUpassword = "v344zhgSJ54KYsjMrJVykaWi";
$dBName = "depffleague_co_uk";

$conn = mysqli_connect($servername, $dBUsername, $dBUpassword, $dBName);

if (!$conn) {
  die("Connection Failed: ".mysqli_connect_error());
}
