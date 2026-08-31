<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {

    header("Location: ../index.php");

    exit;
}

if (
    $_SESSION["tipo_usuario"] !== "Distribuidor" &&
    $_SESSION["tipo_usuario"] !== "Administrador"
) {

    header("Location: /streaming/index.php");

    exit;
}

/*  if ($_SESSION["tipo_usuario"] !== "Distribuidor") {

    header("Location: ../index.php");

    exit;
}  */