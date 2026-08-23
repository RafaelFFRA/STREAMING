<?php

require_once(__DIR__ . "/conexao.php");
require_once(__DIR__ . "/../includes/alerta.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $senha_digitada = $_POST["senha"];


    // Procura o usuário pelo e-mail
    $sql = "SELECT * FROM usuario WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {

        mostrarAlerta("Erro ao consultar o banco de dados.");

        exit;
    }


    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);


    // Verifica se o e-mail existe
    if (mysqli_num_rows($resultado) === 0) {

        mostrarAlerta("E-mail ou senha incorretos.");

        exit;
    }


    $usuario = mysqli_fetch_assoc($resultado);


    // Verifica a senha
    if ($senha_digitada !== $usuario["senha"]) {

        mostrarAlerta("E-mail ou senha incorretos.");

        exit;
    }


    // Identifica o tipo de usuário
    if ($usuario["tipo_usuario"] === "Administrador") {

        header("Location: ../tela_inicial_admin.php");

    } elseif ($usuario["tipo_usuario"] === "Distribuidor") {

        header("Location: ../enviar_filme.php");

    } else {

        header("Location: ../tela_inicial.php");
    }


    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    exit;

} else {

    header("Location: ../index.php");

    exit;
}

?>