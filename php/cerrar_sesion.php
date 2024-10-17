<?php

// Inicia la sesión (si aún no está iniciada)
session_start();

// Destruye la sesión actual
session_destroy();

// Redirige al usuario a la página "../index.php"
header("location: ../php/login.php");

?>