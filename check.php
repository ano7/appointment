<?php
 if(in_array("mysql",PDO::getAvailableDrivers()))
{
   echo " You have PDO for MySQL driver installed ";
 }
else{
   echo "PDO driver for MySQL is not installed in your system";
 }
?>