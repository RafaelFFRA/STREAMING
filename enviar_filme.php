<?php

require_once(__DIR__ . "/includes/proteger_distribuidor.php");

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orion TV - Enviar Filme</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/enviar_filme.css">
</head>

<body>

    <!-- TOPO -->
    <header class="topo">

        <div class="logo">
            ORION TV
        </div>

        <a href="index.php" class="btn-voltar">
            Sair
        </a>

    </header>


    <!-- CONTEÚDO -->
    <main class="container formulario-container">

        <div class="formulario-card">

            <h1>Enviar filme</h1>

            <p class="descricao">
                Preencha as informações do filme e envie os arquivos necessários.
            </p>


            <form enctype="multipart/form-data">


                <!-- TÍTULO -->
                <div class="campo">

                    <label for="titulo">
                        Título
                    </label>

                    <input
                        type="text"
                        id="titulo"
                        name="titulo"
                        class="form-control"
                        placeholder="Digite o título do filme"
                        required
                    >

                </div>


                <!-- SINOPSE -->
                <div class="campo">

                    <label for="sinopse">
                        Sinopse
                    </label>

                    <textarea
                        id="sinopse"
                        name="sinopse"
                        class="form-control"
                        placeholder="Digite a sinopse do filme"
                        rows="5"
                        required
                    ></textarea>

                </div>


                <!-- ELENCO -->
                <div class="campo">

                    <label for="elenco">
                        Elenco
                    </label>

                    <input
                        type="text"
                        id="elenco"
                        name="elenco"
                        class="form-control"
                        placeholder="Ex: Ator 1, Ator 2, Ator 3"
                        required
                    >

                </div>


                <!-- DIRETORES -->
                <div class="campo">

                    <label for="diretores">
                        Diretores
                    </label>

                    <input
                        type="text"
                        id="diretores"
                        name="diretores"
                        class="form-control"
                        placeholder="Digite o(s) diretor(es)"
                        required
                    >

                </div>


                <!-- GÊNERO -->
                <div class="campo">

                    <label for="genero">
                        Gênero
                    </label>

                    <select
                        id="genero"
                        name="genero"
                        class="form-select"
                        required
                    >

                        <option value="" selected disabled >
                            Selecione o gênero
                        </option>

                        <option value="acao">
                            Ação
                        </option>

                        <option value="aventura">
                            Aventura
                        </option>

                        <option value="comedia">
                            Comédia
                        </option>

                        <option value="drama">
                            Drama
                        </option>

                        <option value="ficcao">
                            Ficção científica
                        </option>

                        <option value="terror">
                            Terror
                        </option>

                        <option value="romance">
                            Romance
                        </option>

                        <option value="suspense">
                            Suspense
                        </option>

                        <option value="outro">
                            Outro
             <!--    OUTRO?? -->
                          
                        </option>

                 

                    </select>

                </div>


                <!-- CLASSE ETÁRIA -->
                <div class="campo">

                    <label for="classe_etaria">
                        Classe etária
                    </label>

                    <select
                        id="classe_etaria"
                        name="classe_etaria"
                        class="form-select"
                        required
                    >

                        <option value="" selected disabled>
                            Selecione a classificação
                        </option>

                        <option value="livre">
                            Livre
                        </option>

                        <option value="10">
                            10 anos
                        </option>

                        <option value="12">
                            12 anos
                        </option>

                        <option value="14">
                            14 anos
                        </option>

                        <option value="16">
                            16 anos
                        </option>

                        <option value="18">
                            18 anos
                        </option>

                         <!--    COMO PROSSEGUIR COM OPTION -->

                    </select>

                </div>


                <!-- JANELA INICIAL -->
                <div class="campo">

                    <label for="janela_inicial">
                        Janela de exibição inicial
                    </label>

                    <input
                        type="date"
                        id="janela_inicial"
                        name="janela_inicial"
                        class="form-control"
                        required
                    >

                </div>


                <!-- JANELA FINAL -->
                <div class="campo">

                    <label for="janela_final">
                        Janela de exibição final
                    </label>

                    <input
                        type="date"
                        id="janela_final"
                        name="janela_final"
                        class="form-control"
                        required
                    >

                </div>


                <!-- THUMB -->
                <div class="campo">

                    <label for="thumb">
                        Capa do filme
                    </label>

                    <div class="upload-box">

                        <i class="bi bi-image"></i>

                        <span>
                            Selecione a capa do filme
                        </span>

                        <input
                            type="file"
                            id="thumb"
                            name="thumb"
                            accept="image/*"
                            required
                        >

                    </div>

                    <small>
                        Formatos recomendados: JPG, JPEG ou PNG.
                    </small>

                </div>


                <!-- VÍDEO -->
                <div class="campo">

                    <label for="video">
                        Vídeo do filme
                    </label>

                    <div class="upload-box">

                        <i class="bi bi-camera-reels"></i>

                        <span>
                            Selecione o vídeo do filme
                        </span>

                        <input
                            type="file"
                            id="video"
                            name="video"
                            accept="video/*"
                            required
                        >

                    </div>

                    <small>
                        Selecione o arquivo de vídeo do filme.
                    </small>

                </div>


                <!-- BOTÃO -->
                <button
                    type="submit"
                    class="btn-enviar"
                >
                    <i class="bi bi-cloud-arrow-up"></i>
                    Enviar filme
                </button>


            </form>

        </div>

    </main>

</body>
</html>