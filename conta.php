<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orion TV - Perfil</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/conta.css">
</head>

<body>

    <!-- TOPO -->
    <header class="topo">

        <div class="logo">
            ORION TV
        </div>

        <a href="tela_inicial.php" class="btn-voltar">
            Voltar
        </a>

    </header>


    <!-- CONTEÚDO -->
    <main class="perfil-container">

        <div class="perfil-card">

            <!-- TÍTULO -->
            <h1>Meu perfil</h1>


            <!-- FOTO -->
            <div class="foto-container">

                <img src="img/perfil.jpg" alt="Foto de perfil" class="foto-perfil">

                <button class="btn-alterar-foto">
                    <i class="bi bi-camera-fill"></i>
                    Alterar foto
                </button>

            </div>


            <!-- INFORMAÇÕES -->
            <div class="informacoes">

                <!-- NOME -->
                <div class="campo">

                    <label for="nome">
                        Nome
                    </label>

                    <input
                        type="text"
                        id="nome"
                        value="Pedro"
                    >

                </div>


                <!-- EMAIL -->
                <div class="campo">

                    <label for="email">
                        E-mail
                    </label>

                    <input
                        type="email"
                        id="email"
                        value="usuario@email.com"
                    >

                </div>


                <!-- BOTÃO SALVAR -->
                <button class="btn-salvar">
                    <i class="bi bi-check-lg"></i>
                    Salvar alterações
                </button>

            </div>


            <!-- ASSINATURA -->
            <div class="secao">

                <h2>
                    <i class="bi bi-credit-card"></i>
                    Assinatura
                </h2>


                <div class="assinatura">

                    <div class="informacao-assinatura">

                        <span class="titulo-plano">
                            Plano atual
                        </span>

                        <strong>Premium</strong>

                    </div>


                    <div class="informacao-assinatura">

                        <span class="titulo-plano">
                            Próxima cobrança
                        </span>

                        <strong>20/09/2026</strong>

                    </div>

                </div>


               
            </div>


            <!-- CONTA -->
            <div class="secao conta">

                <h2>
                    <i class="bi bi-person-circle"></i>
                    Conta
                </h2>


                <!-- SAIR -->
                <button class="btn-sair">
                    <i class="bi bi-box-arrow-right"></i>
                    Sair da conta
                </button>


                <!-- CANCELAR -->
                <button
                    class="btn-cancelar"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCancelar"
                >
                    Cancelar assinatura
                </button>

            </div>

        </div>

    </main>


    <!-- MODAL DE CANCELAMENTO -->
    <div
        class="modal fade"
        id="modalCancelar"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content modal-orion">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Cancelar assinatura?
                    </h5>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                    ></button>

                </div>


                <div class="modal-body">

                    <p>
                        Tem certeza que deseja cancelar sua assinatura?
                    </p>

                    <p class="texto-aviso">
                        Você continuará tendo acesso aos benefícios
                        do plano até o final do período atual.
                    </p>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-voltar-modal"
                        data-bs-dismiss="modal"
                    >
                        Voltar
                    </button>

                    <button
                        type="button"
                        class="btn-confirmar-cancelamento"
                    >
                        Confirmar cancelamento
                    </button>

                </div>

            </div>

        </div>

    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>