```php
<?php

require_once(__DIR__ . "/php/conexao.php");
require_once(__DIR__ . "/includes/proteger_admin.php");
require_once(__DIR__ . "/includes/alerta.php");


// ============================================================
// FILTRO
// ============================================================

$filtro = $_GET["tipo"] ?? "Todos";

$tiposPermitidos = [
    "Todos",
    "Administrador",
    "Distribuidor",
    "Cliente"
];

if (!in_array($filtro, $tiposPermitidos, true)) {
    $filtro = "Todos";
}


// ============================================================
// EXCLUSÃO DE CONTA
// ============================================================

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["excluir_conta"])) {

    $id_usuario = filter_input(
        INPUT_POST,
        "id_usuario",
        FILTER_VALIDATE_INT
    );

    if (!$id_usuario) {

        header(
            "Location: gerenciar_contas.php?erro=id_invalido"
        );

        exit;
    }


    try {

        mysqli_begin_transaction($conn);


        // ====================================================
        // DESCOBRE O TIPO DO USUÁRIO
        // ====================================================

        $sqlTipo = "
            SELECT tipo_usuario
            FROM usuario
            WHERE id_usuario = ?
        ";

        $stmtTipo = mysqli_prepare(
            $conn,
            $sqlTipo
        );

        if (!$stmtTipo) {
            throw new Exception(
                "Erro ao preparar a consulta."
            );
        }

        mysqli_stmt_bind_param(
            $stmtTipo,
            "i",
            $id_usuario
        );

        mysqli_stmt_execute(
            $stmtTipo
        );

        $resultadoTipo =
            mysqli_stmt_get_result(
                $stmtTipo
            );

        $usuario =
            mysqli_fetch_assoc(
                $resultadoTipo
            );

        mysqli_stmt_close(
            $stmtTipo
        );


        if (!$usuario) {

            throw new Exception(
                "Conta não encontrada."
            );
        }


        $tipoUsuario =
            $usuario["tipo_usuario"];


        // ====================================================
        // CLIENTE
        // ====================================================

        if ($tipoUsuario === "Cliente") {


            $sqlCliente = "
                SELECT FK_cliente_id_cliente
                FROM cliente
                WHERE FK_cliente_id_usuario = ?
            ";

            $stmtCliente =
                mysqli_prepare(
                    $conn,
                    $sqlCliente
                );

            if (!$stmtCliente) {
                throw new Exception(
                    "Erro ao consultar o cliente."
                );
            }

            mysqli_stmt_bind_param(
                $stmtCliente,
                "i",
                $id_usuario
            );

            mysqli_stmt_execute(
                $stmtCliente
            );

            $resultadoCliente =
                mysqli_stmt_get_result(
                    $stmtCliente
                );

            $cliente =
                mysqli_fetch_assoc(
                    $resultadoCliente
                );

            mysqli_stmt_close(
                $stmtCliente
            );


            if ($cliente) {

                $id_cliente =
                    $cliente[
                        "FK_cliente_id_cliente"
                    ];


                // -------------------------------
                // Avaliações
                // -------------------------------

                $sql = "
                    DELETE FROM avaliacao
                    WHERE FK_avaliacao_id_cliente = ?
                ";

                $stmt =
                    mysqli_prepare(
                        $conn,
                        $sql
                    );

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_cliente
                );

                mysqli_stmt_execute(
                    $stmt
                );

                mysqli_stmt_close(
                    $stmt
                );


                // -------------------------------
                // Assinaturas
                // -------------------------------

                $sql = "
                    DELETE FROM assinatura
                    WHERE FK_assinatura_id_cliente = ?
                ";

                $stmt =
                    mysqli_prepare(
                        $conn,
                        $sql
                    );

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_cliente
                );

                mysqli_stmt_execute(
                    $stmt
                );

                mysqli_stmt_close(
                    $stmt
                );


                // -------------------------------
                // Cliente
                // -------------------------------

                $sql = "
                    DELETE FROM cliente
                    WHERE FK_cliente_id_usuario = ?
                ";

                $stmt =
                    mysqli_prepare(
                        $conn,
                        $sql
                    );

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_usuario
                );

                mysqli_stmt_execute(
                    $stmt
                );

                mysqli_stmt_close(
                    $stmt
                );
            }
        }


        // ====================================================
        // DISTRIBUIDOR
        // ====================================================

        elseif ($tipoUsuario === "Distribuidor") {


            $sqlDistribuidor = "
                SELECT id_distribuidor
                FROM distribuidor
                WHERE FK_distribuidor_id_usuario = ?
            ";

            $stmtDistribuidor =
                mysqli_prepare(
                    $conn,
                    $sqlDistribuidor
                );

            if (!$stmtDistribuidor) {
                throw new Exception(
                    "Erro ao consultar o distribuidor."
                );
            }

            mysqli_stmt_bind_param(
                $stmtDistribuidor,
                "i",
                $id_usuario
            );

            mysqli_stmt_execute(
                $stmtDistribuidor
            );

            $resultadoDistribuidor =
                mysqli_stmt_get_result(
                    $stmtDistribuidor
                );

            $distribuidor =
                mysqli_fetch_assoc(
                    $resultadoDistribuidor
                );

            mysqli_stmt_close(
                $stmtDistribuidor
            );


            if ($distribuidor) {

                $id_distribuidor =
                    $distribuidor[
                        "id_distribuidor"
                    ];


                // -------------------------------
                // Busca conteúdos
                // -------------------------------

                $sqlConteudos = "
                    SELECT id_conteudo
                    FROM conteudo
                    WHERE FK_conteudo_id_distribuidor = ?
                ";

                $stmtConteudos =
                    mysqli_prepare(
                        $conn,
                        $sqlConteudos
                    );

                mysqli_stmt_bind_param(
                    $stmtConteudos,
                    "i",
                    $id_distribuidor
                );

                mysqli_stmt_execute(
                    $stmtConteudos
                );

                $resultadoConteudos =
                    mysqli_stmt_get_result(
                        $stmtConteudos
                    );


                $idsConteudos = [];


                while (
                    $conteudo =
                    mysqli_fetch_assoc(
                        $resultadoConteudos
                    )
                ) {

                    $idsConteudos[] =
                        $conteudo["id_conteudo"];
                }


                mysqli_stmt_close(
                    $stmtConteudos
                );


                // -------------------------------
                // Avaliações dos conteúdos
                // -------------------------------

                foreach (
                    $idsConteudos
                    as $id_conteudo
                ) {

                    $sql = "
                        DELETE FROM avaliacao
                        WHERE FK_avaliacao_id_conteudo = ?
                    ";

                    $stmt =
                        mysqli_prepare(
                            $conn,
                            $sql
                        );

                    mysqli_stmt_bind_param(
                        $stmt,
                        "i",
                        $id_conteudo
                    );

                    mysqli_stmt_execute(
                        $stmt
                    );

                    mysqli_stmt_close(
                        $stmt
                    );
                }


                // -------------------------------
                // Conteúdos
                // -------------------------------

                $sql = "
                    DELETE FROM conteudo
                    WHERE FK_conteudo_id_distribuidor = ?
                ";

                $stmt =
                    mysqli_prepare(
                        $conn,
                        $sql
                    );

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_distribuidor
                );

                mysqli_stmt_execute(
                    $stmt
                );

                mysqli_stmt_close(
                    $stmt
                );


                // -------------------------------
                // Distribuidor
                // -------------------------------

                $sql = "
                    DELETE FROM distribuidor
                    WHERE FK_distribuidor_id_usuario = ?
                ";

                $stmt =
                    mysqli_prepare(
                        $conn,
                        $sql
                    );

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_usuario
                );

                mysqli_stmt_execute(
                    $stmt
                );

                mysqli_stmt_close(
                    $stmt
                );
            }
        }


        // ====================================================
        // ADMINISTRADOR
        // ====================================================

        elseif ($tipoUsuario === "Administrador") {

            $sql = "
                DELETE FROM administrador
                WHERE FK_administrador_id_usuario = ?
            ";

            $stmt =
                mysqli_prepare(
                    $conn,
                    $sql
                );

            mysqli_stmt_bind_param(
                $stmt,
                "i",
                $id_usuario
            );

            mysqli_stmt_execute(
                $stmt
            );

            mysqli_stmt_close(
                $stmt
            );
        }


        // ====================================================
        // REMOVE USUÁRIO
        // ====================================================

        $sql = "
            DELETE FROM usuario
            WHERE id_usuario = ?
        ";

        $stmt =
            mysqli_prepare(
                $conn,
                $sql
            );

        if (!$stmt) {
            throw new Exception(
                "Erro ao preparar exclusão da conta."
            );
        }

        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $id_usuario
        );

        mysqli_stmt_execute(
            $stmt
        );


        if (
            mysqli_stmt_affected_rows($stmt)
            <= 0
        ) {

            mysqli_stmt_close(
                $stmt
            );

            throw new Exception(
                "A conta não pôde ser excluída."
            );
        }


        mysqli_stmt_close(
            $stmt
        );


        // ====================================================
        // CONFIRMA TRANSAÇÃO
        // ====================================================

        mysqli_commit(
            $conn
        );


        header(
            "Location: gerenciar_contas.php?sucesso=conta_excluida"
        );

        exit;


    } catch (Throwable $erro) {

        mysqli_rollback(
            $conn
        );


        header(
            "Location: gerenciar_contas.php?erro=" .
            urlencode(
                $erro->getMessage()
            )
        );

        exit;
    }
}


// ============================================================
// BUSCA DAS CONTAS
// ============================================================

$sql = "

    SELECT

        usuario.id_usuario,
        usuario.email,
        usuario.aniversario,
        usuario.tipo_usuario,

        administrador.nome_admin,

        cliente.nome_cliente,
        cliente.cpf_cliente,
        cliente.status_conta_cliente,

        distribuidor.empresa_distribuidor,
        distribuidor.cnpj_empresa_distribuidor

    FROM usuario

    LEFT JOIN administrador
        ON administrador.FK_administrador_id_usuario =
           usuario.id_usuario

    LEFT JOIN cliente
        ON cliente.FK_cliente_id_usuario =
           usuario.id_usuario

    LEFT JOIN distribuidor
        ON distribuidor.FK_distribuidor_id_usuario =
           usuario.id_usuario
";


if ($filtro !== "Todos") {

    $sql .= "
        WHERE usuario.tipo_usuario = ?
    ";
}


$sql .= "
    ORDER BY usuario.id_usuario DESC
";


$stmt =
    mysqli_prepare(
        $conn,
        $sql
    );


if (!$stmt) {

    die(
        "Erro ao preparar consulta: " .
        htmlspecialchars(
            mysqli_error($conn)
        )
    );
}


if ($filtro !== "Todos") {

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $filtro
    );
}


mysqli_stmt_execute(
    $stmt
);


$resultado =
    mysqli_stmt_get_result(
        $stmt
);


$totalContas =
    mysqli_num_rows(
        $resultado
    );

?>


<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Gerenciar Contas - ORION TV</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {

            background-color: #080808;

            min-height: 100vh;

            color: white;

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        /* =====================================================
           TOPO
        ===================================================== */

        .topo {

            width: 100%;

            min-height: 80px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 15px 5%;

            background-color: #080808;

            border-bottom: 1px solid #292929;
        }


        .logo {

            font-size: 28px;

            font-weight: bold;

            color: #168cff;

            letter-spacing: 1px;

            text-decoration: none;
        }


        .logo:hover {
            color: #168cff;
        }


        .topo-direita {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .btn-voltar {

            text-decoration: none;

            color: white;

            background-color: #222;

            border: 1px solid #333;

            padding: 10px 20px;

            border-radius: 6px;

            font-size: 15px;

            transition: 0.3s;
        }


        .btn-voltar:hover {

            background-color: #333;

            color: white;
        }


        .btn-criar {

            text-decoration: none;

            color: white;

            background-color: #168cff;

            border: 1px solid #168cff;

            padding: 10px 20px;

            border-radius: 6px;

            font-size: 15px;

            transition: 0.3s;
        }


        .btn-criar:hover {

            background-color: #006dcc;

            border-color: #006dcc;

            color: white;
        }


        /* =====================================================
           CONTEÚDO
        ===================================================== */

        .pagina-container {

            width: 100%;

            max-width: 1250px;

            margin: 0 auto;

            padding: 45px 20px 70px;
        }


        .titulo-linha {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 8px;
        }


        .pagina-container h1 {

            font-size: 30px;

            margin-bottom: 8px;
        }


        .descricao {

            color: #999;

            font-size: 15px;

            margin-bottom: 30px;
        }


        .contador {

            color: #777;

            font-size: 13px;

            margin-top: 10px;
        }


        /* =====================================================
           FILTROS
        ===================================================== */

        .filtros {

            display: flex;

            flex-wrap: wrap;

            gap: 10px;

            margin-bottom: 25px;
        }


        .filtro {

            text-decoration: none;

            background-color: #1b1b1b;

            border: 1px solid #333;

            color: #cccccc;

            padding: 9px 18px;

            border-radius: 6px;

            font-size: 14px;

            transition: 0.3s;
        }


        .filtro:hover {

            border-color: #168cff;

            color: white;
        }


        .filtro.ativo {

            background-color: #168cff;

            border-color: #168cff;

            color: white;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .lista-card {

            background-color: #111111;

            border: 1px solid #292929;

            border-radius: 12px;

            overflow: hidden;

            box-shadow:
                0 10px 35px rgba(0, 0, 0, 0.4);
        }


        /* =====================================================
           TABELA
        ===================================================== */

        .tabela-container {

            width: 100%;

            overflow-x: auto;
        }


        .tabela-contas {

            width: 100%;

            min-width: 1050px;

            border-collapse: collapse;
        }


        .tabela-contas thead {

            background-color: #171717;
        }


        .tabela-contas th {

            color: #999;

            font-size: 13px;

            font-weight: normal;

            text-align: left;

            padding: 17px 20px;

            border-bottom: 1px solid #292929;
        }


        .tabela-contas td {

            padding: 18px 20px;

            border-bottom: 1px solid #292929;

            font-size: 14px;

            vertical-align: middle;
        }


        .tabela-contas tbody tr:last-child td {

            border-bottom: none;
        }


        .tabela-contas tbody tr {

            transition: 0.2s;
        }


        .tabela-contas tbody tr:hover {

            background-color: #171717;
        }


        /* =====================================================
           CONTA
        ===================================================== */

        .nome-usuario {

            font-weight: bold;

            font-size: 15px;

            color: white;
        }


        .email-usuario {

            color: #999;

            font-size: 13px;

            margin-top: 4px;
        }


        .id-usuario {

            color: #777;

            font-size: 13px;
        }


        /* =====================================================
           TIPO
        ===================================================== */

        .tipo {

            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 12px;
        }


        .tipo-administrador {

            background-color:
                rgba(22, 140, 255, 0.15);

            color: #5db2ff;
        }


        .tipo-distribuidor {

            background-color:
                rgba(130, 90, 255, 0.15);

            color: #b69cff;
        }


        .tipo-cliente {

            background-color:
                rgba(50, 200, 120, 0.12);

            color: #63d99a;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {

            font-size: 13px;
        }


        .status-ativo {
            color: #63d99a;
        }


        .status-inativo {
            color: #999;
        }


        .status-suspenso {
            color: #ff7777;
        }


        /* =====================================================
           BOTÃO EXCLUIR
        ===================================================== */

        .form-excluir {
            margin: 0;
        }


        .btn-excluir {

            border: 1px solid #4a2020;

            background-color:
                rgba(180, 40, 40, 0.12);

            color: #ff7777;

            padding: 7px 12px;

            border-radius: 6px;

            font-size: 13px;

            cursor: pointer;

            transition: 0.2s;
        }


        .btn-excluir:hover {

            background-color: #b52b2b;

            border-color: #b52b2b;

            color: white;
        }


        /* =====================================================
           VAZIO
        ===================================================== */

        .sem-contas {

            text-align: center;

            padding: 70px 20px;

            color: #999;
        }


        .sem-contas i {

            display: block;

            font-size: 42px;

            color: #444;

            margin-bottom: 15px;
        }


        .sem-contas strong {

            display: block;

            color: #ccc;

            font-size: 16px;

            margin-bottom: 7px;
        }


        .sem-contas p {

            font-size: 14px;

            margin: 0;

            color: #777;
        }


        /* =====================================================
           RESPONSIVIDADE
        ===================================================== */

        @media (max-width: 768px) {

            .topo {

                min-height: 70px;

                padding: 12px 4%;
            }


            .logo {

                font-size: 23px;
            }


            .topo-direita {

                gap: 7px;
            }


            .btn-voltar,
            .btn-criar {

                padding: 8px 12px;

                font-size: 13px;
            }


            .pagina-container {

                padding: 30px 15px 50px;
            }


            .pagina-container h1 {

                font-size: 26px;
            }


            .titulo-linha {

                flex-direction: column;

                gap: 5px;
            }

        }


        @media (max-width: 480px) {

            .topo {

                min-height: 65px;
            }


            .logo {

                font-size: 20px;
            }


            .btn-voltar {

                display: none;
            }


            .btn-criar {

                padding: 7px 11px;

                font-size: 12px;
            }


            .pagina-container h1 {

                font-size: 23px;
            }


            .descricao {

                font-size: 14px;

                margin-bottom: 25px;
            }


            .filtros {

                gap: 8px;
            }


            .filtro {

                padding: 8px 13px;

                font-size: 13px;
            }

        }

    </style>

</head>


<body>


<!-- =========================================================
     TOPO
========================================================= -->

<header class="topo">


    <a
        href="tela_inicial_admin.php"
        class="logo"
    >
        ORION TV
    </a>


    <div class="topo-direita">


        <a
            href="tela_inicial_admin.php"
            class="btn-voltar"
        >
            Voltar
        </a>


        <a
            href="criar_contar_admin.php"
            class="btn-criar"
        >

            <i class="bi bi-plus-lg"></i>

            Criar conta

        </a>


    </div>


</header>



<!-- =========================================================
     CONTEÚDO
========================================================= -->

<main class="pagina-container">


    <div class="titulo-linha">


        <div>

            <h1>
                Gerenciar contas
            </h1>


            <p class="descricao">

                Visualize, filtre e exclua as contas
                cadastradas na plataforma.

            </p>

        </div>


        <div class="contador">

            <?php

            echo $totalContas;

            echo $totalContas === 1
                ? " conta encontrada"
                : " contas encontradas";

            ?>

        </div>


    </div>



    <!-- =====================================================
         FILTROS
    ===================================================== -->

    <div class="filtros">


        <a
            href="gerenciar_contas.php?tipo=Todos"
            class="filtro
            <?php
            echo $filtro === "Todos"
                ? "ativo"
                : "";
            ?>"
        >
            Todas
        </a>


        <a
            href="gerenciar_contas.php?tipo=Administrador"
            class="filtro
            <?php
            echo $filtro === "Administrador"
                ? "ativo"
                : "";
            ?>"
        >
            Administradores
        </a>


        <a
            href="gerenciar_contas.php?tipo=Distribuidor"
            class="filtro
            <?php
            echo $filtro === "Distribuidor"
                ? "ativo"
                : "";
            ?>"
        >
            Distribuidores
        </a>


        <a
            href="gerenciar_contas.php?tipo=Cliente"
            class="filtro
            <?php
            echo $filtro === "Cliente"
                ? "ativo"
                : "";
            ?>"
        >
            Clientes
        </a>


    </div>



    <!-- =====================================================
         LISTA
    ===================================================== -->

    <div class="lista-card">


        <?php if ($totalContas > 0) { ?>


            <div class="tabela-container">


                <table class="tabela-contas">


                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Conta</th>

                            <th>Tipo</th>

                            <th>Informação</th>

                            <th>Status</th>

                            <th>Ações</th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php while (
                        $conta =
                        mysqli_fetch_assoc(
                            $resultado
                        )
                    ) { ?>


                        <?php

                        // -----------------------------------------
                        // Nome da conta
                        // -----------------------------------------

                        $nome = "Conta";


                        if (
                            $conta["tipo_usuario"]
                            === "Administrador"
                        ) {

                            $nome =
                                $conta["nome_admin"]
                                ?: "Administrador";

                        }

                        elseif (
                            $conta["tipo_usuario"]
                            === "Cliente"
                        ) {

                            $nome =
                                $conta["nome_cliente"]
                                ?: "Cliente";

                        }

                        elseif (
                            $conta["tipo_usuario"]
                            === "Distribuidor"
                        ) {

                            $nome =
                                $conta[
                                    "empresa_distribuidor"
                                ]
                                ?: "Distribuidor";
                        }

                        ?>


                        <tr>


                            <!-- ID -->

                            <td>

                                <span class="id-usuario">

                                    #<?php
                                    echo (int)
                                        $conta[
                                            "id_usuario"
                                        ];
                                    ?>

                                </span>

                            </td>



                            <!-- CONTA -->

                            <td>

                                <div class="nome-usuario">

                                    <?php

                                    echo htmlspecialchars(
                                        $nome
                                    );

                                    ?>

                                </div>


                                <div class="email-usuario">

                                    <?php

                                    echo htmlspecialchars(
                                        $conta[
                                            "email"
                                        ]
                                    );

                                    ?>

                                </div>

                            </td>



                            <!-- TIPO -->

                            <td>


                                <?php

                                $classeTipo = "";


                                if (
                                    $conta[
                                        "tipo_usuario"
                                    ]
                                    === "Administrador"
                                ) {

                                    $classeTipo =
                                        "tipo-administrador";

                                }

                                elseif (
                                    $conta[
                                        "tipo_usuario"
                                    ]
                                    === "Distribuidor"
                                ) {

                                    $classeTipo =
                                        "tipo-distribuidor";

                                }

                                elseif (
                                    $conta[
                                        "tipo_usuario"
                                    ]
                                    === "Cliente"
                                ) {

                                    $classeTipo =
                                        "tipo-cliente";
                                }

                                ?>


                                <span
                                    class="tipo
                                    <?php
                                    echo $classeTipo;
                                    ?>"
                                >

                                    <?php

                                    echo htmlspecialchars(
                                        $conta[
                                            "tipo_usuario"
                                        ]
                                    );

                                    ?>

                                </span>


                            </td>



                            <!-- INFORMAÇÃO -->

                            <td>


                                <?php

                                if (
                                    $conta[
                                        "tipo_usuario"
                                    ]
                                    === "Administrador"
                                ) {

                                    echo
                                        "Administrador da plataforma";

                                }

                                elseif (
                                    $conta[
                                        "tipo_usuario"
                                    ]
                                    === "Cliente"
                                ) {

                                    if (
                                        !empty(
                                            $conta[
                                                "cpf_cliente"
                                            ]
                                        )
                                    ) {

                                        echo "CPF: " .
                                            htmlspecialchars(
                                                $conta[
                                                    "cpf_cliente"
                                                ]
                                            );

                                    } else {

                                        echo
                                            "CPF não informado";
                                    }

                                }

                                elseif (
                                    $conta[
                                        "tipo_usuario"
                                    ]
                                    === "Distribuidor"
                                ) {

                                    if (
                                        !empty(
                                            $conta[
                                                "cnpj_empresa_distribuidor"
                                            ]
                                        )
                                    ) {

                                        echo "CNPJ: " .
                                            htmlspecialchars(
                                                $conta[
                                                    "cnpj_empresa_distribuidor"
                                                ]
                                            );

                                    } else {

                                        echo
                                            "CNPJ não informado";
                                    }
                                }

                                ?>

                            </td>



                            <!-- STATUS -->

                            <td>


                                <?php

                                if (
                                    $conta[
                                        "tipo_usuario"
                                    ]
                                    === "Cliente"
                                ) {


                                    $status =
                                        $conta[
                                            "status_conta_cliente"
                                        ]
                                        ?: "Inativo";


                                    if (
                                        $status === "Ativo"
                                    ) {

                                        $classeStatus =
                                            "status-ativo";

                                    }

                                    elseif (
                                        $status === "Suspenso"
                                    ) {

                                        $classeStatus =
                                            "status-suspenso";

                                    }

                                    else {

                                        $classeStatus =
                                            "status-inativo";
                                    }

                                    ?>


                                    <span
                                        class="status
                                        <?php
                                        echo $classeStatus;
                                        ?>"
                                    >

                                        <?php

                                        echo htmlspecialchars(
                                            $status
                                        );

                                        ?>

                                    </span>


                                    <?php

                                } else {

                                    ?>


                                    <span
                                        class="status status-ativo"
                                    >

                                        Ativo

                                    </span>


                                    <?php

                                }

                                ?>

                            </td>



                            <!-- AÇÕES -->

                            <td>


                                <form
                                    method="POST"
                                    action="gerenciar_contas.php"
                                    class="form-excluir"
                                >


                                    <input
                                        type="hidden"
                                        name="id_usuario"
                                        value="<?php
                                        echo (int)
                                            $conta[
                                                "id_usuario"
                                            ];
                                        ?>"
                                    >


                                    <button
                                        type="submit"
                                        name="excluir_conta"
                                        value="1"
                                        class="btn-excluir"
                                    >

                                        <i
                                            class="bi bi-trash3"
                                        ></i>

                                        Excluir

                                    </button>


                                </form>


                            </td>


                        </tr>


                    <?php } ?>


                    </tbody>


                </table>


            </div>


        <?php } else { ?>


            <div class="sem-contas">


                <i class="bi bi-people"></i>


                <strong>
                    Nenhuma conta encontrada
                </strong>


                <p>

                    <?php

                    if ($filtro === "Todos") {

                        echo
                            "Ainda não existem contas cadastradas.";

                    } else {

                        echo
                            "Não existem contas do tipo " .
                            htmlspecialchars(
                                $filtro
                            ) .
                            ".";

                    }

                    ?>

                </p>


            </div>


        <?php } ?>


    </div>


</main>



<!-- =========================================================
     ALERTAS
========================================================= -->

<?php if (
    isset($_GET["sucesso"])
    &&
    $_GET["sucesso"] === "conta_excluida"
) { ?>

    <script>

        mostrarAlerta(
            "Conta excluída com sucesso.",
            "window.location.href = 'gerenciar_contas.php'"
        );

    </script>

<?php } ?>


<?php if (isset($_GET["erro"])) { ?>

    <script>

        mostrarAlerta(
            "<?php
            echo htmlspecialchars(
                $_GET["erro"],
                ENT_QUOTES,
                "UTF-8"
            );
            ?>",
            "window.location.href = 'gerenciar_contas.php'"
        );

    </script>

<?php } ?>


</body>

</html>


<?php

mysqli_stmt_close(
    $stmt
);

?>

