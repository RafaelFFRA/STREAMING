<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ORION TV - Pagamento</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

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


                    <!-- FORMULÁRIO -->

                    <form method="POST" action="php/contratar_assinatura.php">


                        <!-- ESCOLHA DO PLANO -->

                        <div class="titulo-secao">
                            Escolha seu plano
                        </div>


                        <div class="row g-3 mb-4">


                            <!-- PLANO MENSAL -->

                            <div class="col-md-6">

                                <label
                                    class="plano plano-selecionado w-100"
                                    id="planoMensal">

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
                                            value="Mensal"
                                            checked
                                            required
                                            class="form-check-input plano-radio">

                                    </div>

                                    <div class="preco mt-3">
                                        R$ 19,90
                                    </div>

                                    <small class="text-secondary">
                                        por mês
                                    </small>

                                </label>

                            </div>


                            <!-- PLANO ANUAL -->

                            <div class="col-md-6">

                                <label
                                    class="plano w-100"
                                    id="planoAnual">

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
                                            value="Anual"
                                            class="form-check-input plano-radio">

                                    </div>

                                    <div class="preco mt-3">
                                        R$ 199,90
                                    </div>

                                    <small class="text-secondary">
                                        por ano
                                    </small>

                                </label>

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

                                <option
                                    value=""
                                    selected
                                    disabled>

                                    Escolha uma forma de pagamento

                                </option>

                                <option value="Pix">
                                    PIX
                                </option>

                                <option value="Cartão">
                                    Cartão de crédito
                                </option>

                                <option value="Boleto">
                                    Boleto
                                </option>

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
                                id="numero_cartao"
                                required
                                maxlength="19"
                                inputmode="numeric">

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
                                    id="validade"
                                    required
                                    maxlength="5"
                                    inputmode="numeric">

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
                                    id="cvv"
                                    required
                                    maxlength="3"
                                    inputmode="numeric">

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

                                <span id="resumoPlano">
                                    Mensal
                                </span>

                            </div>


                            <div class="linha-resumo">

                                <span>
                                    Valor
                                </span>

                                <span id="resumoValor">
                                    R$ 19,90
                                </span>

                            </div>


                            <hr>


                            <div class="linha-resumo fw-bold">

                                <span>
                                    Total
                                </span>

                                <span
                                    class="text-primary"
                                    id="resumoTotal">

                                    R$ 19,90

                                </span>

                            </div>

                        </div>


                        <!-- BOTÃO -->

                        <button
                            class="btn btn-primary w-100 py-2"
                            type="submit"
                            name="finalizar_assinatura">

                            Finalizar pagamento

                        </button>


                        <a
                            href="index.php"
                            class="btn btn-outline-secondary w-100 mt-2">

                            Voltar

                        </a>


                    </form>

                </div>

            </div>

        </div>

    </div>


    <!-- FORMATAÇÃO DOS CAMPOS -->

    <script>

        /*
         * NÚMERO DO CARTÃO
         * Aceita somente 16 números
         * Formato: 0000 0000 0000 0000
         */

        const numeroCartao = document.getElementById("numero_cartao");

        numeroCartao.addEventListener("input", function () {

            let valor = this.value.replace(/\D/g, "");

            valor = valor.substring(0, 16);

            valor = valor.replace(/(\d{4})(?=\d)/g, "$1 ");

            this.value = valor;

        });


        /*
         * VALIDADE
         * Aceita somente 4 números
         * Formato: MM/AA
         */

        const validade = document.getElementById("validade");

        validade.addEventListener("input", function () {

            let valor = this.value.replace(/\D/g, "");

            valor = valor.substring(0, 4);

            if (valor.length > 2) {

                valor = valor.substring(0, 2) + "/" + valor.substring(2);

            }

            this.value = valor;

        });


        /*
         * CVV
         * Aceita somente 3 números
         */

        const cvv = document.getElementById("cvv");

        cvv.addEventListener("input", function () {

            let valor = this.value.replace(/\D/g, "");

            valor = valor.substring(0, 3);

            this.value = valor;

        });


    </script>


    <!-- ATUALIZAÇÃO DO RESUMO -->

    <script>

        const radios = document.querySelectorAll(".plano-radio");

        const planoMensal = document.getElementById("planoMensal");
        const planoAnual = document.getElementById("planoAnual");

        const resumoPlano = document.getElementById("resumoPlano");
        const resumoValor = document.getElementById("resumoValor");
        const resumoTotal = document.getElementById("resumoTotal");


        radios.forEach(function (radio) {

            radio.addEventListener("change", function () {

                planoMensal.classList.remove("plano-selecionado");
                planoAnual.classList.remove("plano-selecionado");


                if (this.value === "Mensal") {

                    planoMensal.classList.add("plano-selecionado");

                    resumoPlano.textContent = "Mensal";
                    resumoValor.textContent = "R$ 19,90";
                    resumoTotal.textContent = "R$ 19,90";

                }


                if (this.value === "Anual") {

                    planoAnual.classList.add("plano-selecionado");

                    resumoPlano.textContent = "Anual";
                    resumoValor.textContent = "R$ 199,90";
                    resumoTotal.textContent = "R$ 199,90";

                }

            });

        });

    </script>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>