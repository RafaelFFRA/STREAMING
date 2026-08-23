<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciar Usuário - ORION TV</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #141414, #1f1f1f);
            min-height: 100vh;
            color: white;
        }

        .usuario-card {
            width: 100%;
            max-width: 600px;
            background: #222;
            border: none;
            border-radius: 15px;
            color: white;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #e50914;
        }

        .btn-orion {
            background: #e50914;
            border: none;
            color: white;
        }

        .btn-orion:hover {
            background: #b20710;
            color: white;
        }

        .btn-cancelar {
            background: #444;
            border: none;
            color: white;
        }

        .btn-cancelar:hover {
            background: #555;
            color: white;
        }

        .form-control,
        .form-select {
            background: #333;
            color: white;
            border: 1px solid #444;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .form-control:focus,
        .form-select:focus {
            background: #333;
            color: white;
            box-shadow: none;
            border: 1px solid #0944e5;
        }

        .form-select option {
            background: #333;
            color: white;
        }

        .form-label {
            font-weight: 500;
        }

        @media (max-width: 576px) {

            .usuario-card {
                padding: 1.5rem !important;
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

                    <!-- Cabeçalho -->
                    <div class="text-center mb-4">

                        <div class="logo">
                            ORION TV
                        </div>

                        <p class="text-white mb-0">
                            Criar nova conta
                        </p>

                    </div>


                    <!-- Formulário -->
                    <form method="POST" action="php/criar_usuario_admin.php">


                        <!-- Email -->
                        <div class="mb-3">

                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Digite o email"
                                required>

                        </div>


                        <!-- Senha -->
                        <div class="mb-3">

                            <label for="senha" class="form-label">
                                Senha
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="senha"
                                name="senha"
                                placeholder="Digite a senha"
                                required>

                        </div>


                        <!-- Confirmar senha -->
                        <div class="mb-3">

                            <label for="confirmar_senha" class="form-label">
                                Confirmar senha
                            </label>

                            <input
                                type="password"
                                class="form-control"
                                id="confirmar_senha"
                                name="confirmar_senha"
                                placeholder="Digite novamente a senha"
                                required>

                        </div>


                        <!-- Data de nascimento -->
                        <div class="mb-3">

                            <label for="aniversario" class="form-label">
                                Data de nascimento
                            </label>

                            <input
                                type="date"
                                class="form-control"
                                id="aniversario"
                                name="aniversario"
                                required>

                        </div>


                        <!-- Tipo de usuário -->
                        <div class="mb-4">

                            <label for="tipo_usuario" class="form-label">
                                Tipo de usuário
                            </label>

                            <select
                                class="form-select"
                                id="tipo_usuario"
                                name="tipo_usuario"
                                required>

                                <option value="" selected disabled>
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


                        <!-- Botões -->
                        <div class="d-grid gap-2 d-sm-flex">

                            <button
                                type="submit"
                                name="salvar"
                                class="btn btn-orion flex-sm-fill">

                                Criar conta

                            </button>


                            <a
                                href="assinaturas_admin.php"
                                class="btn btn-cancelar flex-sm-fill">

                                Cancelar

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>