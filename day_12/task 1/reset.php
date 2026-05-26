<?php

session_start();

unset($_SESSION['books']);

header("Location: index.php");

exit;

?>