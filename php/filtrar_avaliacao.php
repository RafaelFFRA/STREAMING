<?php

session_start();
require "conexao.php";


$id_avaliacao = $_GET['id']; //identificação da avaliação 


$sql = "

DELETE FROM avaliacao

WHERE id_avaliacao = '$id_avaliacao'

";


if (mysqli_query($conn, $sql)) {

    echo "Avaliação excluída com sucesso!";
    //header("Location: filme.php?id=..."); volta a página do filme

} else {

    echo "Erro ao excluir: " . mysqli_error($conn);

}

?>