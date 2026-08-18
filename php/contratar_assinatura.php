<?php

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


}

?>