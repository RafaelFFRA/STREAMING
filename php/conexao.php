<?php
//CONECTA NO BANCO TODAS AS VEZES, É A "TOMADA"
date_default_timezone_set('America/Sao_Paulo');

   $host = "localhost";
$user = "root";
$pass = "";
$db = "streaming";  

/*  $host = "sql101.infinityfree.com";
$user = "if0_42497673";
$pass = "2026stream67";
$db = "if0_42497673_streaming";    */

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");







/* listar

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar os dados do banco</title>
</head>
<body>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>SALA</th>
        <th>DATA DE MATRICÚLA</th>
        <th colspan="2">Ações</th>
    </tr>



    <?php

include "conexao.php";

$dados = "SELECT * FROM aluno ORDER BY nome asc"; // ASPAS DUPLAS  -- ORDEM ALFABÉTICA, SENÃO É POR ID

// Para exibir os dados, é necessária uma conversão de Array -> String


$result = mysqli_query($con, $dados);
    while ($aluno = mysqli_fetch_assoc($result)){
        $id = $aluno['id'];
        $nome = $aluno['nome'];
        $sala = $aluno['sala'];
        $dtmat = $aluno['data_matricula'];
        
        //nome = atributo do BANCO

        echo "
        <tr>
        <td>$id</td>        
        <td>$nome</td>         
        <td>$sala</td>         
        <td>$dtmat</td>         
        <td><a href = 'alterar.php?id=$id'>Alterar</a></td>
        <td><a href = 'excluir.php?id=$id'>Excluir</a></td>
        </tr>";         

    }

    ?>
    </table>
    
</body>
</html>

 */