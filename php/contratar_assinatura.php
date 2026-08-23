<?php

session_start();

require_once(__DIR__ . "/../includes/alerta.php");


/*
 * Verifica se o formulário foi enviado
 */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../index.php");

    exit;
}


/*
 * Recebe os dados da assinatura
 */

$plano = $_POST["plano"] ?? "";
$forma_pagamento = $_POST["forma_pagamento"] ?? "";


/*
 * Verifica o plano
 */

if ($plano !== "Mensal" && $plano !== "Anual") {

    mostrarAlerta(
        "Plano inválido.",
        "window.location.href = '../pagamento.php'"
    );

    exit;
}


/*
 * Verifica a forma de pagamento
 */

if (
    $forma_pagamento !== "Pix" &&
    $forma_pagamento !== "Cartão" &&
    $forma_pagamento !== "Boleto"
) {

    mostrarAlerta(
        "Forma de pagamento inválida.",
        "window.location.href = '../pagamento.php'"
    );

    exit;
}


/*
 * Guarda os dados temporariamente na sessão.
 *
 * NADA é enviado para o banco neste momento.
 */

$_SESSION["cadastro_assinatura"] = [

    "plano" => $plano,

    "forma_pagamento" => $forma_pagamento

];


/*
 * Vai para o cadastro do cliente
 */

header("Location: ../cadastro.php");

exit;

?>