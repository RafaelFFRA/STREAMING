<?php

session_start();

require_once(__DIR__ . "/conexao.php");
require_once(__DIR__ . "/../includes/alerta.php");


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../index.php");
    exit;
}


$email = trim($_POST["email"] ?? "");
$senha_digitada = $_POST["senha"] ?? "";


if ($email === "" || $senha_digitada === "") {

    mostrarAlerta("Preencha todos os campos.");
    exit;
}


/*
 * Procura o usuário pelo e-mail
 */

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


if (!mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    mostrarAlerta("Erro ao consultar o banco de dados.");
    exit;
}


$resultado = mysqli_stmt_get_result($stmt);


/*
 * Verifica se o e-mail existe
 */

if (mysqli_num_rows($resultado) === 0) {

    mysqli_stmt_close($stmt);

    mostrarAlerta("E-mail ou senha incorretos.");
    exit;
}


$usuario = mysqli_fetch_assoc($resultado);


/*
 * Verifica a senha
 */

if ($senha_digitada !== $usuario["senha"]) {

    mysqli_stmt_close($stmt);

    mostrarAlerta("E-mail ou senha incorretos.");
    exit;
}


/*
 * CRIA UMA NOVA SESSÃO PARA O USUÁRIO LOGADO
 */

session_regenerate_id(true);

$_SESSION["id_usuario"] = $usuario["id_usuario"];
$_SESSION["tipo_usuario"] = $usuario["tipo_usuario"];

/*
 * Redireciona conforme o tipo
 */

if ($usuario["tipo_usuario"] === "Administrador") {

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: ../escolha_admin.php");
    exit;

}


if ($usuario["tipo_usuario"] === "Distribuidor") {

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: ../enviar_filme.php");
    exit;

}


if ($usuario["tipo_usuario"] === "Cliente") {

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: ../tela_inicial.php");
    exit;

}


/*
 * Tipo de usuário inválido
 */

mysqli_stmt_close($stmt);
mysqli_close($conn);

session_destroy();

mostrarAlerta("Tipo de usuário inválido.");

exit;

