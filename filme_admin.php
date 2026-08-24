<?php

require_once(__DIR__ . "/includes/proteger_admin.php");

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ORION TV - Administrador</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/filme_admin.css">

</head>

<body>


<!-- =========================================
     NAVBAR
========================================= -->

<nav class="navbar navbar-dark navbar-orion">

    <div class="navbar-container">

        <a href="tela_inicial_admin.php" class="logo">
            ORION TV
        </a>

        <a href="tela_inicial_admin.php" class="btn-voltar">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>

    </div>

</nav>


<!-- =========================================
     BANNER
========================================= -->

<section class="banner-filme">

    <img
        src="https://br.web.img3.acsta.net/c_640_360/img/bb/d5/bbd568870de0ab7e8f903696885d3801.png"
        class="banner-img"
        alt="Obsessão"
    >

    <div class="banner-escuro"></div>

    <div class="banner-conteudo">

        <span class="classificacao">
            16 ANOS
        </span>

        <h1>Obsessão</h1>

        <p>
            Suspense • 2026 • 1h48min
        </p>

    </div>

</section>


<!-- =========================================
     CONTEÚDO DO FILME
========================================= -->

<main class="conteudo">


    <!-- POSTER -->

    <div class="poster-container">

        <img
            src="https://static.wikia.nocookie.net/dublagem/images/e/e5/Obsessao.png/revision/latest?cb=20260518183806&path-prefix=pt-br"
            class="poster"
            alt="Poster do filme"
        >

    </div>


    <!-- INFORMAÇÕES -->

    <div class="informacoes">


        <!-- SINOPSE -->

        <section class="card">

            <h2>Sinopse</h2>

            <p>
                Sinopse do filme. Aqui ficará o texto cadastrado
                sobre a história de Obsessão.
            </p>

        </section>


        <!-- ELENCO E DIRETORES -->

        <div class="grid grid-2">

            <section class="card">

                <h3>Elenco</h3>

                <p>
                    Elenco
                </p>

            </section>


            <section class="card">

                <h3>Diretores</h3>

                <p>
                    Nome do Diretor
                </p>

            </section>

        </div>


        <!-- GÊNERO / CLASSIFICAÇÃO / DURAÇÃO -->

        <div class="grid grid-3">

            <section class="card">

                <h3>Gênero</h3>

                <p>
                    Suspense
                </p>

            </section>


            <section class="card">

                <h3>Classificação</h3>

                <p>
                    16 anos
                </p>

            </section>


            <section class="card">

                <h3>Duração</h3>

                <p>
                    1h48min
                </p>

            </section>

        </div>


        <!-- DATAS -->

        <div class="grid grid-2">

            <section class="card">

                <h3>Disponível a partir de</h3>

                <p>
                    01/09/2026
                </p>

            </section>


            <section class="card">

                <h3>Disponível até</h3>

                <p>
                    30/09/2026
                </p>

            </section>

        </div>


        <!-- =====================================
             COMENTÁRIOS
        ====================================== -->

        <section class="comentarios">

            <div class="titulo-comentarios">

                <h2>Comentários</h2>

                <span>3 comentários</span>

            </div>


            <!-- COMENTÁRIO 1 -->

            <div class="comentario">

                <div class="comentario-info">

                    <div>

                        <strong>Felicio</strong>

                        <span>há 2 horas</span>

                    </div>

                    <button class="btn-excluir-comentario">

                        <i class="bi bi-trash3"></i>

                        Excluir

                    </button>

                </div>

                <p>
                    Gostei bastante do filme, principalmente do final.
                </p>

            </div>


            <!-- COMENTÁRIO 2 -->

            <div class="comentario">

                <div class="comentario-info">

                    <div>

                        <strong>Rafael</strong>

                        <span>ontem</span>

                    </div>

                    <button class="btn-excluir-comentario">

                        <i class="bi bi-trash3"></i>

                        Excluir

                    </button>

                </div>

                <p>
                    Achei a história muito interessante.
                </p>

            </div>


            <!-- COMENTÁRIO 3 -->

            <div class="comentario">

                <div class="comentario-info">

                    <div>

                        <strong>Vini Jr</strong>

                        <span>há 3 dias</span>

                    </div>

                    <button class="btn-excluir-comentario">

                        <i class="bi bi-trash3"></i>

                        Excluir

                    </button>

                </div>

                <p>
                    O filme foi muito bom.
                </p>

            </div>

        </section>


        <!-- =====================================
             ADMINISTRAÇÃO DO FILME
        ====================================== -->

        <section class="administracao">

            <h2>Administração</h2>

            <p>
                Ações administrativas disponíveis para este filme.
            </p>

            <button
                class="btn-excluir-filme"
                data-bs-toggle="modal"
                data-bs-target="#modalExcluir"
            >

                <i class="bi bi-trash3"></i>

                Excluir filme

            </button>

        </section>


    </div>

</main>


<!-- =========================================
     MODAL EXCLUIR FILME
========================================= -->

<div
    class="modal fade"
    id="modalExcluir"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-orion">

            <div class="modal-header">

                <h5 class="modal-title">
                    Excluir filme
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <p>
                    Tem certeza que deseja excluir o filme
                    <strong>Obsessão</strong>?
                </p>

                <p class="aviso">
                    Essa ação não poderá ser desfeita.
                </p>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Cancelar
                </button>

                <button
                    type="button"
                    class="btn btn-danger"
                >
                    <i class="bi bi-trash3"></i>
                    Confirmar exclusão
                </button>

            </div>

        </div>

    </div>

</div>


<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>