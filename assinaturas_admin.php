<?php

require_once(__DIR__ . "/includes/proteger_admin.php");

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ORION TV - Assinaturas</title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- CSS -->

    <link rel="stylesheet" href="css/assinaturas_admin.css">

</head>


<body>


<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-dark navbar-orion">

    <div class="container-fluid">

        <a href="tela_inicial.php" class="navbar-brand logo">
            ORION TV
        </a>

        <a href="tela_inicial_admin.php" class="btn btn-outline-light btn-voltar">

            <i class="bi bi-arrow-left"></i>

            Voltar

        </a>

    </div>

</nav>


<!-- ================= CONTEÚDO ================= -->

<main class="container-fluid pagina">


    <!-- CABEÇALHO -->

    <div class="cabecalho">

        <div>

            <h1>
                Assinaturas
            </h1>

            <p>
                Consulte e gerencie as assinaturas dos clientes.
            </p>

        </div>

    </div>


    <!-- ================= FILTROS ================= -->

    <div class="filtros">

        <div class="filtro-busca">

            <i class="bi bi-search"></i>

            <input
                type="text"
                placeholder="Buscar cliente..."
            >

        </div>


        <select class="filtro-status">

            <option value="">
                Todas as situações
            </option>

            <option value="ativa">
                Ativas
            </option>

            <option value="atrasada">
                Atrasadas
            </option>

            <option value="suspensa">
                Suspensas
            </option>

        </select>

         <a href="criar_contas_admin.php" class="btn-criar-conta">

        <i class="bi bi-person-plus"></i>

        Criar contas

    </a>

    </div>


    <!-- ================= CARDS ================= -->

    <div class="row g-4">


        <!-- CLIENTE 1 -->

        <div class="col-xl-4 col-lg-6 col-md-6">

            <div class="card-assinatura">


                <div class="cliente-topo">

                    <div class="avatar">

                        <i class="bi bi-person-fill"></i>

                    </div>

                    <div>

                        <h2>
                            João Silva
                        </h2>

                        <p>
                            joao@email.com
                        </p>

                    </div>

                </div>


                <div class="situacao ativa">

                    <span></span>

                    Assinatura ativa

                </div>


                <div class="informacoes">


                    <div class="info">

                        <span>
                            Plano
                        </span>

                        <strong>
                            Premium
                        </strong>

                    </div>


                    <div class="info">

                        <span>
                            Valor
                        </span>

                        <strong>
                            R$ 29,90
                        </strong>

                    </div>


                    <div class="info">

                        <span>
                            Início
                        </span>

                        <strong>
                            01/08/2026
                        </strong>

                    </div>


                    <div class="info">

                        <span>
                            Vencimento
                        </span>

                        <strong>
                            01/09/2026
                        </strong>

                    </div>


                </div>


                <button
                    class="btn-suspender"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSuspender"
                >

                    <i class="bi bi-pause-circle"></i>

                    Suspender assinatura

                </button>


            </div>

        </div>


        <!-- CLIENTE 2 -->

        <div class="col-xl-4 col-lg-6 col-md-6">

            <div class="card-assinatura">


                <div class="cliente-topo">

                    <div class="avatar">

                        <i class="bi bi-person-fill"></i>

                    </div>

                    <div>

                        <h2>
                            Pedro Santos
                        </h2>

                        <p>
                            pedro@email.com
                        </p>

                    </div>

                </div>


                <div class="situacao atrasada">

                    <span></span>

                    Pagamento atrasado

                </div>


                <div class="informacoes">


                    <div class="info">

                        <span>
                            Plano
                        </span>

                        <strong>
                            Básico
                        </strong>

                    </div>


                    <div class="info">

                        <span>
                            Valor
                        </span>

                        <strong>
                            R$ 19,90
                        </strong>

                    </div>


                    <div class="info">

                        <span>
                            Início
                        </span>

                        <strong>
                            15/07/2026
                        </strong>

                    </div>


                    <div class="info">

                        <span>
                            Vencimento
                        </span>

                        <strong>
                            15/08/2026
                        </strong>

                    </div>


                </div>


                <button
                    class="btn-suspender"
                    data-bs-toggle="modal"
                    data-bs-target="#modalSuspender"
                >

                    <i class="bi bi-pause-circle"></i>

                    Suspender assinatura

                </button>


            </div>

        </div>


        <!-- CLIENTE 3 -->

        <div class="col-xl-4 col-lg-6 col-md-6">

            <div class="card-assinatura">


                <div class="cliente-topo">

                    <div class="avatar">

                        <i class="bi bi-person-fill"></i>

                    </div>

                    <div>

                        <h2>
                            Lucas Oliveira
                        </h2>

                        <p>
                            lucas@email.com
                        </p>

                    </div>

                </div>


                <div class="situacao suspensa">

                    <span></span>

                    Assinatura suspensa

                </div>


                <div class="informacoes">


                    <div class="info">

                        <span>
                            Plano
                        </span>

                        <strong>
                            Premium
                        </strong>

                    </div>


                    <div class="info">

                        <span>
                            Valor
                        </span>

                        <strong>
                            R$ 29,90
                        </strong>

                    </div>


                    <div class="info">

                        <span>
                            Início
                        </span>

                        <strong>
                            10/06/2026
                        </strong>

                    </div>


                    <div class="info">

                        <span>
                            Vencimento
                        </span>

                        <strong>
                            10/07/2026
                        </strong>

                    </div>


                </div>


                <button class="btn-reativar">

                    <i class="bi bi-play-circle"></i>

                    Reativar assinatura

                </button>


            </div>

        </div>


    </div>


</main>


<!-- ================= MODAL ================= -->

<div
    class="modal fade"
    id="modalSuspender"
    tabindex="-1"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-orion">


            <div class="modal-header">

                <h5 class="modal-title">

                    Suspender assinatura

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <p>

                    Tem certeza que deseja suspender a assinatura deste cliente?

                </p>

                <p class="aviso">

                    O cliente perderá o acesso ao conteúdo enquanto a assinatura
                    estiver suspensa.

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

                    <i class="bi bi-pause-circle"></i>

                    Confirmar suspensão

                </button>

            </div>


        </div>

    </div>

</div>


<!-- Bootstrap JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>