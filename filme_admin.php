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


<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg navbar-dark navbar-orion">

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
    >

    <div class="banner-escuro"></div>

    <div class="container banner-conteudo">

        <div class="row">

            <div class="col-lg-7">

                <span class="badge bg-primary fs-6">

                    16 ANOS

                </span>

                <h1 class="titulo-filme">

                    Obsessão

                </h1>

                <p class="informacoes-filme">

                    Suspense • 2026 • 1h48min

                </p>

            </div>

        </div>

    </div>

</section>


<!-- ================= DETALHES ================= -->

<section class="container detalhes-filme">

    <div class="row">

        <!-- Poster -->

        <div class="col-lg-3 text-center">

            <img
                src="https://static.wikia.nocookie.net/dublagem/images/e/e5/Obsessao.png/revision/latest?cb=20260518183806&path-prefix=pt-br"
                class="poster-filme"
            >

        </div>


        <!-- Informações -->

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


            <!-- ELENCO / DIRETORES -->

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


            <!-- JANELA DE EXIBIÇÃO -->

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


            <!-- ================= ADMINISTRAÇÃO ================= -->

            <div class="admin-area">

                <h2>
                    Administração
                </h2>

                <p>
                    Ações disponíveis para este filme.
                </p>


                <button
                    type="button"
                    class="btn btn-danger btn-excluir"
                    data-bs-toggle="modal"
                    data-bs-target="#modalExcluir"
                >

                    <i class="bi bi-trash3"></i>

                    Excluir filme

                </button>

            </div>


        </div>

    </div>

</section>


<!-- ================= MODAL DE CONFIRMAÇÃO ================= -->

<div
    class="modal fade"
    id="modalExcluir"
    tabindex="-1"
    aria-labelledby="modalExcluirLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-orion">

            <div class="modal-header">

                <h5 class="modal-title" id="modalExcluirLabel">

                    Excluir filme

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Fechar"
                ></button>

            </div>


            <div class="modal-body">

                <p>

                    Tem certeza que deseja excluir o filme

                    <strong>Obsessão</strong>?

                </p>

                <p class="aviso-exclusao">

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


                <!-- FUTURO PHP -->

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