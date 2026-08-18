<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Perfis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
 

</head>

<style>

    .perfil img {
        transition: 0.3s;
    }

    .perfil:hover img {
        transform: scale(1.1);
    }

    /* CELULAR */
    @media (max-width: 600px) {

        .row {
            flex-direction: column;
            align-items: center;
        }

        .perfil {
            width: 100%;
            max-width: 200px;
            margin-bottom: 30px;
        }

    }

</style>

<body class="bg-dark text-white">
<h1 class="text-center mt-5">
    Quem está assistindo?
</h1>
<div class="container mt-5">

    <div class="row justify-content-center">

        <!-- Perfil 1 -->
        <a href="tela_inicial.php" class="col-md-2 text-center perfil text-white text-decoration-none">

    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKCXfQyj_oWlMoJCRRjNxf8TcORUptm1DHM8qi8Hp8NJAqZq637DRkjiU&s=10"
    class="rounded-circle"
    width="120"
    height="120">

    <h4 class="mt-3">
        Felicio
    </h4>

</a>


        <!-- Perfil 2 -->
        <div class="col-md-2 text-center perfil">

            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMdm9sVDoz_p2ZZKuBi6gGNoFUUE7u7JnD1IBaYEF67y3anEoi"
            class="rounded-circle"
            width="120"
            height="120">

            <h4 class="mt-3">
                Rafael
            </h4>

        </div>


        <!-- Perfil 3 -->
        <div class="col-md-2 text-center perfil">

            <img src="https://aseguirniteroi.com.br/wp-content/uploads/2023/11/caricatura-vini-jr-por-dan.jpg"
            class="rounded-circle"
            width="120"
            height="120">

            <h4 class="mt-3">
                Vini Jr
            </h4>

        </div>


    </div>

</div>

</body>

</html>