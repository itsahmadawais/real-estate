<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
   unset($_SESSION['loggedin']);
   unset($_SESSION['uid']);
   unset($_SESSION['mtype']);
   unset($_SESSION['role']);
   unset($_SESSION['email']);
}
session_destroy();
header("location: login.php");
?>