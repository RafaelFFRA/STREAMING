<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Streaming</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg, #141414, #1f1f1f);
            min-height: 100vh;
        }

        .login-card{
            width:100%;
            max-width:420px;
            background:#222;
            border:none;
            border-radius:15px;
            color:white;
        }

        .logo{
            font-size:2rem;
            font-weight:bold;
            color:#e50914;
        }

        .btn-login{
            background:#e50914;
            border:none;
        }

        .btn-login:hover{
            background:#b20710;
        }

        .form-control{
            background:#333;
            color:white;
            border:none;
        }

        .form-control:focus{
            background:#333;
            color:white;
            box-shadow:none;
            border:1px solid #0944e5;
        }

        a{
            color:#e50914;
            text-decoration:none;
        }

        a:hover{
            text-decoration:underline;
        }
    </style>

</head>

<body>
   <body>




<div class="container">
    ...
</div>


</body>


<div class="container">

    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-11 col-sm-8 col-md-6 col-lg-4">

            <div class="card login-card shadow-lg p-4">

                <div class="text-center mb-4">
                    <div class="logo text-primary">ORION TV</div>
                    <p class="text-white">
                        Faça login para continuar
                    </p>
                </div>

                <form>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                        type="email"
                        class="form-control"
                        placeholder="Digite seu email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input
                        type="password"
                        class="form-control"
                        placeholder="Digite sua senha">
                    </div>

                    <div class="d-flex justify-content-between mb-4">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Lembrar-me
                            </label>
                        </div>

                        <a href="esqueci_senha.php" class=text-primary>
                            Esqueceu a senha?
                        </a>

                    </div>

                   <a href="perfil.php" class="btn btn-primary w-100 text-white text-decoration-none">
                     Entrar</a>
                </form>

                <div class="text-center mt-4 text-primary"> 

                    <p>
                        Não possui conta?
                        <a href="cadastro.php" class=text-primary>Cadastre-se</a>
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>