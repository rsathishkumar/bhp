<?php
$make = $_REQUEST['make'];
include_once("connect.php");
$make_res = @mysqli_query("SELECT * FROM node WHERE type='make' AND LOWER(title)='".strtolower($make)."'");
if(@mysqli_num_rows($make_res)>0)
{
echo "1";
}
else
{
echo "0";
}
?>
