<?php

session_start();

require_once(__DIR__ . "/conexao.php");
require_once(__DIR__ . "/../includes/alerta.php");


/*
 * Verifica se o formulário foi enviado
 */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../index.php");

    exit;
}


/*
 * Verifica se o cliente passou pelo pagamento
 *
 * Sem essa sessão, ele não pode chegar
 * diretamente ao cadastro.
 */

if (!isset($_SESSION["cadastro_assinatura"])) {

    mostrarAlerta(
        "É necessário iniciar o cadastro pelo pagamento.",
        "window.location.href = '../index.php'"
    );

    exit;
}


/*
 * Recupera os dados da assinatura
 */

$plano = $_SESSION["cadastro_assinatura"]["plano"];

$forma_pagamento =
    $_SESSION["cadastro_assinatura"]["forma_pagamento"];


/*
 * Recebe os dados do cadastro
 */

$nome = trim($_POST["nome"] ?? "");

$cpf = trim($_POST["cpf"] ?? "");

$aniversario = $_POST["aniversario"] ?? "";

$email = trim($_POST["email"] ?? "");

$senha = $_POST["senha"] ?? "";


/*
 * Verifica se os campos foram preenchidos
 */

if (
    $nome === "" ||
    $cpf === "" ||
    $aniversario === "" ||
    $email === "" ||
    $senha === ""
) {

    mostrarAlerta(
        "Preencha todos os campos.",
        "window.location.href = '../cadastro.php'"
    );

    exit;
}


/*
 * Remove pontos e traço do CPF
 *
 * Exemplo:
 * 123.456.789-00
 *
 * vira:
 * 12345678900
 */

$cpf = preg_replace("/\D/", "", $cpf);


/*
 * Verifica se o CPF possui 11 números
 */

if (strlen($cpf) !== 11) {

    mostrarAlerta(
        "Digite um CPF válido.",
        "window.location.href = '../cadastro.php'"
    );

    exit;
}


/*
 * Verifica a data de nascimento
 */

try {

    $data_nascimento = new DateTime($aniversario);

    $data_atual = new DateTime();

} catch (Exception $e) {

    mostrarAlerta(
        "Data de nascimento inválida.",
        "window.location.href = '../cadastro.php'"
    );

    exit;
}


/*
 * Impede data de nascimento no futuro
 */

if ($data_nascimento > $data_atual) {

    mostrarAlerta(
        "Data de nascimento inválida.",
        "window.location.href = '../cadastro.php'"
    );

    exit;
}


/*
 * Calcula a idade
 */

$idade = $data_atual->diff($data_nascimento)->y;


/*
 * Verifica se é maior de 18 anos
 */

if ($idade < 18) {

    /*
     * Remove os dados temporários da assinatura.
     *
     * O cadastro não será concluído.
     */

    unset($_SESSION["cadastro_assinatura"]);

    mostrarAlerta(
        "É necessário ter 18 anos ou mais para criar uma conta.",
        "window.location.href = '../index.php'"
    );

    exit;
}


/*
 * Verifica se o e-mail já existe
 */

$sql = "SELECT id_usuario FROM usuario WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    mostrarAlerta(
        "Erro ao consultar o banco de dados.",
        "window.location.href = '../index.php'"
    );

    exit;
}

mysqli_stmt_bind_param(
    $stmt,
    "s",
    $email
);

if (!mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    mostrarAlerta(
        "Erro ao consultar o e-mail.",
        "window.location.href = '../index.php'"
    );

    exit;
}

mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {

    mysqli_stmt_close($stmt);

    mostrarAlerta(
        "Este e-mail já possui uma conta.",
        "window.location.href = '../index.php'"
    );

    exit;
}

mysqli_stmt_close($stmt);


/*
 * Verifica se o CPF já existe
 */

$sql = "
    SELECT 1
    FROM cliente
    WHERE cpf_cliente = ?
";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    mostrarAlerta(
        "Erro ao consultar o CPF.",
        "window.location.href = '../index.php'"
    );

    exit;
}


mysqli_stmt_bind_param(
    $stmt,
    "s",
    $cpf
);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($resultado) > 0) {

    mysqli_stmt_close($stmt);

    mostrarAlerta(
        "Este CPF já possui uma conta.",
        "window.location.href = '../index.php'"
    );

    exit;
}

mysqli_stmt_close($stmt);


/*
 * Dados automáticos
 */

$tipo_usuario = "Cliente";

$status_cliente = "Ativo";

$status_assinatura = "Ativa";


/*
 * Define as datas da assinatura
 *
 * A assinatura começa no dia do cadastro.
 */

$data_inicio = new DateTime();


if ($plano === "Mensal") {

    $data_fim = clone $data_inicio;

    $data_fim->modify("+1 month");

} else {

    $data_fim = clone $data_inicio;

    $data_fim->modify("+1 year");
}


$data_inicio_assinatura =
    $data_inicio->format("Y-m-d");

$data_fim_assinatura =
    $data_fim->format("Y-m-d");


/*
 * INICIA A TRANSAÇÃO
 *
 * A partir daqui:
 *
 * ou tudo é cadastrado,
 * ou nada é cadastrado.
 */

mysqli_begin_transaction($conn);


try {


    /*
     * CRIA O USUÁRIO
     */

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


    if (!$stmt) {

        throw new Exception();
    }


    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $senha,
        $email,
        $aniversario,
        $tipo_usuario
    );


    if (!mysqli_stmt_execute($stmt)) {

        throw new Exception();
    }


    /*
     * ID do usuário criado
     */

    $id_usuario = mysqli_insert_id($conn);

    mysqli_stmt_close($stmt);


    /*
     * CRIA O CLIENTE
     */

    $sql = "
        INSERT INTO cliente
        (
            nome_cliente,
            cpf_cliente,
            status_conta_cliente,
            FK_cliente_id_usuario
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


    if (!$stmt) {

        throw new Exception();
    }


    mysqli_stmt_bind_param(
        $stmt,
        "sssi",
        $nome,
        $cpf,
        $status_cliente,
        $id_usuario
    );


    if (!mysqli_stmt_execute($stmt)) {

        throw new Exception();
    }


    /*
     * ID do cliente criado
     */

    $id_cliente = mysqli_insert_id($conn);

    mysqli_stmt_close($stmt);


    /*
     * CRIA A ASSINATURA
     */

    $sql = "
        INSERT INTO assinatura
        (
            tipo_plano_assinatura,
            data_inicio_assinatura,
            data_fim_assinatura,
            status_assinatura,
            forma_pagamento_assinatura,
            FK_assinatura_id_cliente
        )
        VALUES
        (
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
        )
    ";

    $stmt = mysqli_prepare($conn, $sql);


    if (!$stmt) {

        throw new Exception();
    }


    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $plano,
        $data_inicio_assinatura,
        $data_fim_assinatura,
        $status_assinatura,
        $forma_pagamento,
        $id_cliente
    );


    if (!mysqli_stmt_execute($stmt)) {

        throw new Exception();
    }


    mysqli_stmt_close($stmt);


    /*
     * TUDO DEU CERTO
     */

    mysqli_commit($conn);

    mysqli_close($conn);


    /*
     * Remove os dados temporários
     */

    unset($_SESSION["cadastro_assinatura"]);


    /*
     * Cadastro concluído.
     *
     * Vai para a tela normal do cliente.
     */

    mostrarAlerta(
        "Conta criada com sucesso!",
        "window.location.href = '../tela_inicial.php'"
    );

    exit;


} catch (Exception $e) {


    /*
     * Se qualquer INSERT falhar,
     * desfaz TODOS os INSERTs.
     */

    mysqli_rollback($conn);

    mysqli_close($conn);


    mostrarAlerta(
        "Não foi possível concluir o cadastro. Tente novamente.",
        "window.location.href = '../cadastro.php'"
    );

    exit;
}

?>