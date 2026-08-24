<?php

require_once(__DIR__ . "/includes/proteger_cliente.php");

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ORION TV</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/filme.css">

</head>

<body>


<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-dark navbar-orion">

    <div class="container-fluid">

        <a class="navbar-brand logo" href="tela_inicial.php">
            ORION TV
        </a>

        <a href="tela_inicial.php" class="btn btn-outline-light">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>

    </div>

</nav>


<!-- ================= BANNER ================= -->

<section class="banner-filme">

    <img
        src="https://br.web.img3.acsta.net/c_640_360/img/bb/d5/bbd568870de0ab7e8f903696885d3801.png"
        class="banner-img"
        alt="Obsessão"
    >

    <div class="banner-escuro"></div>

    <div class="container banner-conteudo">

        <span class="badge bg-primary">
            16 ANOS
        </span>

        <h1 class="titulo-filme">
            Obsessão
        </h1>

        <p class="informacoes-filme">
            Suspense • 2026 • 1h48min
        </p>

        <div class="botoes-filme">

            <button class="btn btn-light btn-lg">
                <i class="bi bi-play-fill"></i>
                Assistir
            </button>

            <button class="btn btn-secondary btn-lg">
                <i class="bi bi-plus-lg"></i>
                Minha Lista
            </button>

        </div>

    </div>

</section>


<!-- ================= CONTEÚDO ================= -->

<section class="container detalhes-filme">


    <!-- ================= ABAS ================= -->

    <ul class="nav nav-tabs abas-filme" id="filmeTabs">

        <li class="nav-item">

            <button
                class="nav-link active"
                data-bs-toggle="tab"
                data-bs-target="#informacoes">

                <i class="bi bi-info-circle"></i>
                Informações

            </button>

        </li>

        <li class="nav-item">

            <button
                class="nav-link"
                data-bs-toggle="tab"
                data-bs-target="#comentarios">

                <i class="bi bi-chat-left-text"></i>
                Comentários

            </button>

        </li>

    </ul>


    <!-- ================= CONTEÚDO DAS ABAS ================= -->

    <div class="tab-content">


        <!-- ================= INFORMAÇÕES ================= -->

        <div class="tab-pane fade show active" id="informacoes">

            <div class="row">


                <!-- POSTER -->

                <div class="col-lg-3 poster-container">

                    <img
                        src="https://static.wikia.nocookie.net/dublagem/images/e/e5/Obsessao.png/revision/latest?cb=20260518183806&path-prefix=pt-br"
                        class="poster-filme"
                        alt="Poster Obsessão">

                </div>


                <!-- INFORMAÇÕES -->

                <div class="col-lg-9">


                    <!-- SINOPSE -->

                    <div class="card-orion">

                        <h2>
                            Sinopse
                        </h2>

                        <p>
                            Sinopse
                        </p>

                    </div>


                    <!-- ELENCO / DIRETOR -->

                    <div class="row mt-4 g-4">

                        <div class="col-md-6">

                            <div class="card-orion">

                                <h3>
                                    Elenco
                                </h3>

                                <p>
                                    Elenco
                                </p>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="card-orion">

                                <h3>
                                    Diretores
                                </h3>

                                <p>
                                    Nome do Diretor
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- GÊNERO / CLASSIFICAÇÃO / DURAÇÃO -->

                    <div class="row mt-4 g-4">

                        <div class="col-md-4">

                            <div class="card-orion">

                                <h3>
                                    Gênero
                                </h3>

                                <p>
                                    Suspense
                                </p>

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="card-orion">

                                <h3>
                                    Classificação
                                </h3>

                                <p>
                                    16 anos
                                </p>

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="card-orion">

                                <h3>
                                    Duração
                                </h3>

                                <p>
                                    1h48min
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- DATAS -->

                    <div class="row mt-4 g-4">

                        <div class="col-md-6">

                            <div class="card-orion">

                                <h3>
                                    Disponível a partir de
                                </h3>

                                <p>
                                    01/09/2026
                                </p>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="card-orion">

                                <h3>
                                    Disponível até
                                </h3>

                                <p>
                                    30/09/2026
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- ================= COMENTÁRIOS ================= -->

        <div class="tab-pane fade" id="comentarios">

            <div class="comentarios">


                <h2>
                    Comentários
                </h2>


                <!-- FORMULÁRIO -->

                <div class="comentario-form">

                    <label for="comentario">
                        Deixe seu comentário
                    </label>

                    <textarea
                        id="comentario"
                        class="form-control"
                        rows="4"
                        placeholder="O que você achou do filme?"></textarea>

                    <button class="btn btn-primary mt-3">

                        <i class="bi bi-send"></i>
                        Comentar

                    </button>

                </div>


                <!-- COMENTÁRIO -->

                <div class="comentario">

                    <div class="usuario-comentario">

                        <div class="avatar">
                            F
                        </div>

                        <div>

                            <strong>
                                Felicio
                            </strong>

                            <small>
                                Hoje
                            </small>

                        </div>

                    </div>

                    <p>
                        Gostei bastante do filme. A história é muito boa!
                    </p>

                </div>


                <!-- OUTRO COMENTÁRIO -->

                <div class="comentario">

                    <div class="usuario-comentario">

                        <div class="avatar">
                            R
                        </div>

                        <div>

                            <strong>
                                Rafael
                            </strong>

                            <small>
                                Ontem
                            </small>

                        </div>

                    </div>

                    <p>
                        O suspense ficou muito bom.
                    </p>

                </div>


            </div>

        </div>

    </div>

</section>


<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>