<?php
/* 
session_start();
require "conexao.php";

$id_cliente = $_SESSION['id_cliente'];

if (isset($_POST['enviar'])) { // name="enviar" do formulário

$tipo_plano_assinatura = $_POST['tipo_plano']; //name = "" no formulário -- button no formulário, de duas opções
$data_inicio_assinatura = $_POST['data_inicio'];
$data_fim_assinatura = $_POST['data_fim'];
$status_assinatura = $_POST['status'];
$forma_pagamento_assinatura = $_POST['pagamento'];



$sql = "
INSERT INTO assinatura(

tipo_plano_assinatura,
data_inicio_assinatura,
data_fim_assinatura,
status_assinatura,
forma_pagamento_assinatura,
FK_assinatura_id_cliente

)

VALUES(

'$tipo_plano_assinatura',
'$data_inicio_assinatura',
'$data_fim_assinatura',
'$status_assinatura',
'$forma_pagamento_assinatura',
'$id_cliente'

)";



if (mysqli_query($conn, $sql)) {

    echo "Assinatura realizada com sucesso!";
    //header("Location: index.php");

} else {

    echo "Erro ao cadastrar assinatura: " . mysqli_error($conn);

}


} */


include("conexao.php");

if (isset($_POST["cadastrar"])) {

    // Dados do formulário
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];

    //Dados da conta
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Dados da assinatura
    $tipo_plano = $_POST["tipo_plano"];
    $data_inicio = $_POST["data_inicio"];
    $data_fim = $_POST["data_fim"];

    // ---------------------------------
    // 1. CADASTRA O USUÁRIO
    // ---------------------------------

    $sql_usuario = "INSERT INTO usuario
                    (senha, email, tipo_usuario)
                    VALUES
                    ('$senha', '$email', 'Cliente')";

    if (mysqli_query($conn, $sql_usuario)) {

        // Pega o ID do usuário recém-criado
        $id_usuario = mysqli_insert_id($conn);

        // ---------------------------------
        // 2. CADASTRA O CLIENTE
        // ---------------------------------

        $sql_cliente = "INSERT INTO cliente
                        (nome_cliente, cpf_cliente, status_conta_cliente, FK_cliente_id_usuario)
                        VALUES
                        ('$nome', '$cpf', 'Ativo', '$id_usuario')";

        if (mysqli_query($conn, $sql_cliente)) {

            // Pega o ID do cliente recém-criado
            $id_cliente = mysqli_insert_id($conn);

            // ---------------------------------
            // 3. CADASTRA A ASSINATURA
            // ---------------------------------
            //
            // A forma de pagamento ainda não está
            // no seu formulário.
            //
            // Portanto, a assinatura será cadastrada
            // depois que o pagamento for escolhido.

            echo "Cliente cadastrado com sucesso!";
        } else {

            echo "Erro ao cadastrar cliente: " . mysqli_error($conn);
        }
    } else {

        echo "Erro ao cadastrar usuário: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
```

?>