<?php

require_once(__DIR__ . "/includes/proteger_admin.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Usuário - ORION TV</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

 <style>

    body {
        background-color: #080808;

        min-height: 100vh;

        color: white;

        font-family: Arial, Helvetica, sans-serif;
    }


    .usuario-card {

        width: 100%;

        max-width: 600px;

        background-color: #111111;

        border: 1px solid #292929;

        border-radius: 12px;

        color: white;

        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.4);
    }


    .logo {

        font-size: 2rem;

        font-weight: bold;

        color: #168cff;

        letter-spacing: 1px;
    }


    .btn-orion {

        background-color: #168cff;

        border: none;

        color: white;

        transition: 0.3s;
    }


    .btn-orion:hover {

        background-color: #006dcc;

        color: white;
    }


    .btn-cancelar {

        background-color: #242424;

        border: none;

        color: white;

        transition: 0.3s;
    }


    .btn-cancelar:hover {

        background-color: #333;

        color: white;
    }


    .form-control,
    .form-select {

        background-color: #1b1b1b;

        color: white;

        border: 1px solid #333;

        border-radius: 6px;
    }


    .form-control::placeholder {

        color: #777;
    }


    .form-control:focus,
    .form-select:focus {

        background-color: #1b1b1b;

        color: white;

        box-shadow: 0 0 0 2px rgba(22, 140, 255, 0.15);

        border: 1px solid #168cff;
    }


    .form-select option {

        background-color: #1b1b1b;

        color: white;
    }


    .form-label {

        font-weight: 500;

        color: #ddd;
    }


    /* Campos específicos */

    .campo-tipo {

        display: none;
    }


    @media (max-width: 576px) {

        .usuario-card {

            padding: 1.5rem !important;

            border-radius: 10px;
        }


        .logo {

            font-size: 1.7rem;
        }

    }

</style>

</head>


<body>


<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100 py-4">

        <div class="col-11 col-sm-10 col-md-8 col-lg-6">

            <div class="card usuario-card shadow-lg p-4 p-md-5">


                <!-- CABEÇALHO -->

                <div class="text-center mb-4">

                    <div class="logo">
                        ORION TV
                    </div>

                    <p class="text-white mb-0">
                        Criar nova conta
                    </p>

                </div>


                <!-- FORMULÁRIO -->

                <form
                    method="POST"
                    action="php/criar_usuario_admin.php"
                >


                    <!-- TIPO DE USUÁRIO -->

                    <div class="mb-4">

                        <label
                            for="tipo_usuario"
                            class="form-label"
                        >
                            Tipo de usuário
                        </label>


                        <select
                            class="form-select"
                            id="tipo_usuario"
                            name="tipo_usuario"
                            required
                        >

                            <option
                                value=""
                                selected
                                disabled
                            >
                                Selecione o tipo de usuário
                            </option>


                            <option value="Administrador">
                                Administrador
                            </option>


                            <option value="Distribuidor">
                                Distribuidor
                            </option>

                        </select>

                    </div>


                    <!-- NOME DO ADMINISTRADOR -->

                    <div
                        class="mb-3 campo-tipo"
                        id="campo_admin"
                    >

                        <label
                            for="nome_admin"
                            class="form-label"
                        >
                            Nome do administrador
                        </label>


                        <input
                            type="text"
                            class="form-control"
                            id="nome_admin"
                            name="nome_admin"
                            placeholder="Digite o nome do administrador"
                            maxlength="100"
                        >

                    </div>


                    <!-- EMPRESA DO DISTRIBUIDOR -->

                    <div
                        class="mb-3 campo-tipo"
                        id="campo_distribuidor"
                    >

                        <label
                            for="empresa_distribuidor"
                            class="form-label"
                        >
                            Empresa
                        </label>


                        <input
                            type="text"
                            class="form-control"
                            id="empresa_distribuidor"
                            name="empresa_distribuidor"
                            placeholder="Digite o nome da empresa"
                            maxlength="100"
                        >

                    </div>


                    <!-- CNPJ DO DISTRIBUIDOR -->

                    <div
                        class="mb-3 campo-tipo"
                        id="campo_cnpj"
                    >

                        <label
                            for="cnpj_empresa_distribuidor"
                            class="form-label"
                        >
                            CNPJ
                        </label>


                        <input
                            type="text"
                            class="form-control"
                            id="cnpj_empresa_distribuidor"
                            name="cnpj_empresa_distribuidor"
                            placeholder="00.000.000/0000-00"
                            maxlength="18"
                        >

                    </div>


                    <!-- EMAIL -->

                    <div class="mb-3">

                        <label
                            for="email"
                            class="form-label"
                        >
                            Email
                        </label>


                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Digite o email"
                            required
                        >

                    </div>


                    <!-- SENHA -->

                    <div class="mb-3">

                        <label
                            for="senha"
                            class="form-label"
                        >
                            Senha
                        </label>


                        <input
                            type="password"
                            class="form-control"
                            id="senha"
                            name="senha"
                            placeholder="Digite a senha"
                            required
                        >

                    </div>


                    <!-- CONFIRMAR SENHA -->

                    <div class="mb-3">

                        <label
                            for="confirmar_senha"
                            class="form-label"
                        >
                            Confirmar senha
                        </label>


                        <input
                            type="password"
                            class="form-control"
                            id="confirmar_senha"
                            name="confirmar_senha"
                            placeholder="Digite novamente a senha"
                            required
                        >

                    </div>


                    <!-- DATA DE NASCIMENTO -->

                 <!--    <div class="mb-4">

                        <label
                            for="aniversario"
                            class="form-label"
                        >
                            Data de nascimento
                        </label>


                        <input
                            type="date"
                            class="form-control"
                            id="aniversario"
                            name="aniversario"
                            required
                        >

                    </div> -->


                    <!-- BOTÕES -->

                    <div class="d-grid gap-2 d-sm-flex">

                        <button
                            type="submit"
                            name="salvar"
                            class="btn btn-orion flex-sm-fill"
                        >
                            Criar conta
                        </button>


                        <a
                            href="assinaturas_admin.php"
                            class="btn btn-cancelar flex-sm-fill"
                        >
                            Cancelar
                        </a>

                    </div>


                </form>

            </div>

        </div>

    </div>

</div>


<script>

const tipoUsuario = document.getElementById("tipo_usuario");

const campoAdmin = document.getElementById("campo_admin");

const campoDistribuidor =
    document.getElementById("campo_distribuidor");

const campoCnpj =
    document.getElementById("campo_cnpj");


const nomeAdmin =
    document.getElementById("nome_admin");

const empresaDistribuidor =
    document.getElementById("empresa_distribuidor");

const cnpjDistribuidor =
    document.getElementById("cnpj_empresa_distribuidor");


tipoUsuario.addEventListener("change", function () {


    /* Esconde todos */

    campoAdmin.style.display = "none";

    campoDistribuidor.style.display = "none";

    campoCnpj.style.display = "none";


    /* Remove required */

    nomeAdmin.required = false;

    empresaDistribuidor.required = false;

    cnpjDistribuidor.required = false;


    /* ADMINISTRADOR */

    if (this.value === "Administrador") {

        campoAdmin.style.display = "block";

        nomeAdmin.required = true;

    }


    /* DISTRIBUIDOR */

    if (this.value === "Distribuidor") {

        campoDistribuidor.style.display = "block";

        campoCnpj.style.display = "block";

        empresaDistribuidor.required = true;

        cnpjDistribuidor.required = true;

    }

});

</script>


<script>

document
    .getElementById("cnpj_empresa_distribuidor")
    .addEventListener("input", function () {

        let valor = this.value.replace(/\D/g, "");

        valor = valor.substring(0, 14);


        if (valor.length > 12) {

            valor =
                valor.replace(
                    /^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/,
                    "$1.$2.$3/$4-$5"
                );

        } else if (valor.length > 8) {

            valor =
                valor.replace(
                    /^(\d{2})(\d{3})(\d{3})(\d{1,4})$/,
                    "$1.$2.$3/$4"
                );

        } else if (valor.length > 5) {

            valor =
                valor.replace(
                    /^(\d{2})(\d{3})(\d{1,3})$/,
                    "$1.$2.$3"
                );

        } else if (valor.length > 2) {

            valor =
                valor.replace(
                    /^(\d{2})(\d{1,3})$/,
                    "$1.$2"
                );

        }


        this.value = valor;

    });

</script>


</body>

</html>