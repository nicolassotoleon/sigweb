<?php

session_start();
session_destroy();
header("Location:ingreso_usuarios.php");
error_reporting(0);
?>