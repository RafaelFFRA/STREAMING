<?php

session_start();
require "conexao.php";

$id_distribuidor = $_SESSION['id_distribuidor'];

if (isset($_POST['enviar'])){ //Name do formulário name = 'enviar'

$titulo_conteudo = $_POST['titulo']; //Estes serão os name = "" lá no formulário
$sinopse_conteudo = $_POST['sinopse'];
$elenco_conteudo = $_POST['elenco'];
$diretores_conteudo = $_POST['diretores'];
$genero_conteudo = $_POST['genero'];
$classe_etaria_conteudo = $_POST['classe_etaria'];
$janela_exib_inicio_conteudo = $_POST['janela_inicio'];
$janela_exib_fim_conteudo = $_POST['janela_fim'];
$thumb_conteudo = $_FILES['thumb'];
$video_conteudo = $_FILES['video'];


// Nome dos arquivos enviados
    $nome_thumb = $thumb_conteudo['name'];
    $nome_video = $video_conteudo['name']; //name é o nome do arquivo, aqui obtenho ele

    // Onde eles serão salvos no projeto
    $caminho_thumb = "thumbs/" . $nome_thumb;
    $caminho_video = "videos/" . $nome_video; //o nome do arquivo é pego, junto do arquivo (enviado), apenas transfiro ele


if    (
move_uploaded_file( $thumb_conteudo['tmp_name'], $caminho_thumb) &&
move_uploaded_file( $video_conteudo['tmp_name'], $caminho_video)
){
    echo "ARQUIVOS MOVIDOS E SALVOS PARA AS PASTAS THUMB E VÍDEO"; //Depois remover este IF
}

$sql = "
INSERT INTO conteudo(

titulo_conteudo,
sinopse_conteudo,
elenco_conteudo,
diretores_conteudo,
genero_conteudo,
classe_etaria_conteudo,
janela_exib_inicio_conteudo,
janela_exib_fim_conteudo,
thumb_conteudo,
video_conteudo,
FK_conteudo_id_distribuidor

)

VALUES(

'$titulo_conteudo',
'$sinopse_conteudo',
'$elenco_conteudo',
'$diretores_conteudo',
'$genero_conteudo',
'$classe_etaria_conteudo',
'$janela_exib_inicio_conteudo',
'$janela_exib_fim_conteudo',
'$caminho_thumb',
'$caminho_video',
'$id_distribuidor'

)";

if (mysqli_query($conn, $sql)) {
    echo "Conteúdo cadastrado com sucesso!"; //header("Location: index.php"); -> Mandar para a tela seguinte
} else {
    echo "Erro ao cadastrar: " . mysqli_error($conn);
}





/* CREATE TABLE IF NOT EXISTS `conteudo` (
  `id_conteudo` int NOT NULL AUTO_INCREMENT COMMENT 'ID identificador do conteúdo',
  `titulo_conteudo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Título do conteúdo',
  `sinopse_conteudo` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Sinopse do conteúdo',
  `elenco_conteudo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Elenco do conteúdo',
  `diretores_conteudo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Diretores do conteúdo',
  `genero_conteudo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Genêro do conteúdo',
  `classe_etaria_conteudo` int NOT NULL COMMENT 'Classe etária do conteúdo:',
  `janela_exib_inicio_conteudo` date NOT NULL COMMENT 'Janela de exibição do conteúdo: Início',
  `janela_exib_fim_conteudo` date NOT NULL COMMENT 'Janela de exibição do conteúdo: Fim',
  `thumb_conteudo` varchar(255) NOT NULL COMMENT 'Caminho da thumbnail',
  `video_conteudo` varchar(255) NOT NULL COMMENT 'Caminho do arquivo de vídeo',
  `FK_conteudo_id_distribuidor` int NOT NULL COMMENT 'ID identificador do distribuidor',
  PRIMARY KEY (`id_conteudo`),
  KEY `FK_conteudo_distribuidor` (`FK_conteudo_id_distribuidor`) USING BTREE,
  CONSTRAINT `FK_conteudo_distribuidor` FOREIGN KEY (`FK_conteudo_id_distribuidor`) REFERENCES `distribuidor` (`id_distribuidor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci; */


/* <form action="upload.php" method="POST" enctype="multipart/form-data">

    ...

    <button type="submit" name="enviar">
        Enviar Filme
    </button>

</form> */
