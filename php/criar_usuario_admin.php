<?php

session_start();

require_once("conexao.php");
require_once(__DIR__ . "/../includes/alerta.php");

/*
 * SOMENTE ADMINISTRADOR PODE ACESSAR
 */

if (
    !isset($_SESSION["id_usuario"]) ||
    !isset($_SESSION["tipo_usuario"]) ||
    $_SESSION["tipo_usuario"] !== "Administrador"
) {

    header("Location: ../index.php");

    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];
/*     $aniversario = $_POST["aniversario"]; */
    $tipo_usuario = $_POST["tipo_usuario"];


    // Verifica se as senhas são iguais
    if ($senha !== $confirmar_senha) {

        
          mostrarAlerta("As senhas não coincidem.");

    exit;
    

     
    }


    // Verifica se o tipo de usuário é válido
    if (
        $tipo_usuario !== "Administrador" &&
        $tipo_usuario !== "Distribuidor"
    ) {

         mostrarAlerta("Tipo de usuário inválido");

        exit;
    }


    // Verifica se o e-mail já existe
    $sql_verificar = "SELECT id_usuario FROM usuario WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql_verificar);

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);


    if (mysqli_num_rows($resultado) > 0) {

       mostrarAlerta("Este e-mail já possui uma conta.");

        exit;
    }


    // Insere o usuário no banco
    $sql = "
        INSERT INTO usuario
        (
            senha,
            email,
            aniversario,
            tipo_usuario
        )
        VALUES
        (
            ?,
            ?,
            ?,
            ?
        )
    ";


    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $senha,
        $email,
        $aniversario,
        $tipo_usuario
    );


    if (mysqli_stmt_execute($stmt)) {

        mostrarAlerta("Conta criada com sucesso!");

    } else {

         mostrarAlerta("Erro ao criar conta.");

    }


    mysqli_stmt_close($stmt);

    mysqli_close($conn);

} else {

    header("Location: ../assinaturas_admin.php");

    exit;
}

?>