<?php
session_start();

if(isset($_GET["logout"]) == 1){
  header("Location:/index.php?logout=1");
}

?>
