<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orion TV - Esqueci minha senha</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/esqueci_senha.css">
</head>

<body>

    <main class="pagina">

        <div class="card-senha">

            <!-- LOGO -->
            <div class="logo">
                ORION TV
            </div>


            <!-- TÍTULO -->
            <h1>Esqueceu sua senha?</h1>

            <p class="descricao">
                Digite o e-mail cadastrado na sua conta e a nova senha.
                
            </p>


            <!-- FORMULÁRIO -->
            <form method="POST" action="php/esqueci_senha.php">

                <div class="campo">

                    <label for="email">
                        E-mail
                    </label>

                    <input
                        type="email"
                        id="email"
                        class="form-control"
                        placeholder="Digite seu e-mail"
                        required
                        name="email"
                    >

                </div>

                <div class="campo">

                    <label for="senha">
                        Senha
                    </label>

                    <input
                        type="password"
                        id="senha"
                        class="form-control"
                        placeholder="Digite a nova senha"
                        required
                        name="senha"
                    >

                </div>


                <button type="submit" class="btn-enviar" name="instrucoes_esqueci_senha">
                    Enviar 
                </button>

            </form>


            <!-- VOLTAR -->
            <a href="index.php" class="voltar">
                ← Voltar para o login
            </a>

        </div>

    </main>

</body>

</html>