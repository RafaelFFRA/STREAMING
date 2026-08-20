<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ORION TV - Pagamento</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #141414, #1f1f1f);
            min-height: 100vh;
            color: white;
        }

        .pagamento-card {
            background: #222;
            border: none;
            border-radius: 15px;
            color: white;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #0d6efd;
        }

        .titulo-secao {
            color: #0d6efd;
            font-size: 1.2rem;
            font-weight: bold;
            border-bottom: 1px solid #444;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }

        .form-control,
        .form-select {
            background: #333;
            color: white;
            border: none;
        }

        .form-control:focus,
        .form-select:focus {
            background: #333;
            color: white;
            box-shadow: none;
            border: 1px solid #0d6efd;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .form-label {
            color: #ddd;
        }

        .plano {
            background: #333;
            border: 1px solid #444;
            border-radius: 10px;
            padding: 18px;
            cursor: pointer;
            transition: 0.2s;
        }

        .plano:hover {
            border-color: #0d6efd;
        }

        .plano-selecionado {
            border: 2px solid #0d6efd;
        }

        .preco {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0d6efd;
        }

        .resumo {
            background: #181818;
            border-radius: 10px;
            padding: 20px;
        }

        .linha-resumo {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-12 col-md-10 col-lg-8">

                <div class="card pagamento-card shadow-lg p-4 p-md-5">

                    <!-- LOGO -->

                    <div class="text-center mb-4">

                        <div class="logo">
                            ORION TV
                        </div>

                        <p class="text-secondary">
                            Finalize sua assinatura
                        </p>

                    </div>


                    <form method="$_POST" action="assinatura.php">


                        <!-- ESCOLHA DO PLANO -->

                        <div class="titulo-secao">
                            Escolha seu plano
                        </div>


                        <div class="row g-3 mb-4">

                            <!-- PLANO MENSAL -->

                            <div class="col-md-6">

                                <div class="plano plano-selecionado">

                                    <div class="d-flex justify-content-between">

                                        <div>

                                            <h5>
                                                Plano Mensal
                                            </h5>

                                            <p class="text-secondary mb-0">
                                                Cobrança mensal
                                            </p>

                                        </div>

                                        <input
                                            type="radio"
                                            name="plano"
                                            value="mensal"
                                            checked
                                            require>

                                        <!--  COMO COLOCAR O NAME? É RADIO -->

                                    </div>

                                    <div class="preco mt-3">
                                        R$ 19,90
                                    </div>

                                    <small class="text-secondary">
                                        por mês
                                    </small>

                                </div>

                            </div>


                            <!-- PLANO ANUAL -->

                            <div class="col-md-6">

                                <div class="plano">

                                    <div class="d-flex justify-content-between">

                                        <div>

                                            <h5>
                                                Plano Anual
                                            </h5>

                                            <p class="text-secondary mb-0">
                                                Cobrança anual
                                            </p>

                                        </div>

                                        <input
                                            type="radio"
                                            name="plano"
                                            value="anual">

                                        <!--  COMO COLOCAR O NAME? É RADIO -->

                                    </div>

                                    <div class="preco mt-3">
                                        R$ 199,90
                                    </div>

                                    <small class="text-secondary">
                                        por ano
                                    </small>

                                </div>

                            </div>

                        </div>


                        <!-- FORMA DE PAGAMENTO -->

                        <div class="titulo-secao mt-4">
                            Forma de pagamento
                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Método
                            </label>

                            <select
                                class="form-select"
                                name="forma_pagamento"
                                required>

                                <option selected disabled>
                                    Escolha uma forma de pagamento
                                </option>

                                <option value="pix">
                                    PIX
                                </option>

                                <option value="cartao">
                                    Cartão de crédito
                                </option>

                                <option value="boleto">
                                    Boleto
                                </option>

                                <!--  COMO COLOCAR O NAME? É OPTION -->

                            </select>

                        </div>


                        <!-- DADOS DO CARTÃO -->

                        <div class="titulo-secao mt-4">
                            Dados do pagamento
                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Nome no cartão
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Nome presente no cartão"
                                name="nome_cartao"
                                required>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Número do cartão
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="0000 0000 0000 0000"
                                name="numero_cartao"
                                required>

                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Validade
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="MM/AA"
                                    name="validade"
                                    required>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    CVV
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="000"
                                    name="cvv"
                                    required>

                            </div>

                        </div>


                        <!-- RESUMO -->

                        <div class="titulo-secao mt-4">
                            Resumo do pedido
                        </div>


                        <div class="resumo mb-4">

                            <div class="linha-resumo">

                                <span>
                                    Plano
                                </span>

                                <span>
                                    Mensal
                                </span>

                            </div>


                            <div class="linha-resumo">

                                <span>
                                    Valor
                                </span>

                                <span>
                                    R$ 19,90
                                </span>

                            </div>


                            <hr>


                            <div class="linha-resumo fw-bold">

                                <span>
                                    Total
                                </span>

                                <span class="text-primary">
                                    R$ 19,90
                                </span>

                            </div>

                        </div>


                        <!-- BOTÃO -->

                        <a href="perfil.php" class="btn btn-primary w-100 py-2">
                            Finalizar pagamento
                        </a>

                        <button class="btn btn-primary w-100 py-2" type="submit" name="finalizar_assinatura"></button>


                        <a
                            href="cadastro.php"
                            class="btn btn-outline-secondary w-100 mt-2">
                            Voltar
                        </a>


                    </form>

                </div>

            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>