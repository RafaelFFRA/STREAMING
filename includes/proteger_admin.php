<?php

session_start();

if (
    !isset($_SESSION["id_usuario"]) ||
    !isset($_SESSION["tipo_usuario"])
) {

    header("Location: ../index.php");

    exit;
}

if ($_SESSION["tipo_usuario"] !== "Administrador") {

    header("Location: ../index.php");

    exit;
}