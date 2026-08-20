<?php

$conn = new mysqli($host, $user, $pass, $db);
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
$email = $_POST["email"];
$senha_digitada = $_POST["senha"];

$sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha_digitada'";

$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    if ($usuario["tipo_usuario"] == "Administrador") {

        header("Location: tela_inicial_admin.php");

    } elseif ($usuario["tipo_usuario"] == "Distribuidor") {

        header("Location: enviar_filme.php");

    } else {
        header("Location: tela_inicial.php");
    }

    exit();

} else {

    echo "Email ou senha incorretos.";
}
$conexao->close();
