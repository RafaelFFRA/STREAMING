<!DOCTYPE html>

<html lang="pt-br">

<head>


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ORION TV</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- CSS -->
<link rel="stylesheet" href="css/tela_inicial.css">


</head>

<style>

    .criar-conta-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        background-color: #168cff;
        color: white !important;

        font-size: 15px;
        font-weight: 600;

        padding: 7px 14px;

        border-radius: 7px;

        text-decoration: none;

        transition: 0.2s ease;
    }

    .criar-conta-btn i {
        color: white !important;
        font-size: 17px;
    }

    .criar-conta-btn:hover {
        background-color: #006dcc;
        color: white !important;

        text-decoration: none;
        transform: translateY(-1px);
    }

</style>

<body>


<!-- NAVBAR -->

<nav class="navbar navbar-dark bg-dark navbar-orion">

    <div class="navbar-container">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold" href="#">
            ORION TV
        </a>

        <!-- MENU -->
        <!-- <div class="navbar-nav menu-orion">

            <a class="nav-link" href="#">Em Alta</a>
            <a class="nav-link" href="#">Filmes</a>
            <a class="nav-link" href="#">Séries</a>
            <a class="nav-link" href="#">Kids</a>

        </div> -->

        <!-- BOTÕES -->
        <div class="nav-buttons">

            <a href="busca_deslogado.php" class="btn btn-dark nav-icon">
                <i class="bi bi-search"></i>
            </a>

            <!-- <a href="conta.php" class="btn btn-dark nav-icon">
                <i class="bi bi-person-circle"></i>
            </a> -->

            <a href="pagamento.php" class="criar-conta-btn" title="Criar Conta">

                <i class="bi bi-person-plus-fill"></i>

                Criar Conta

            </a>

        </div>

    </div>

</nav>


<!-- BANNER -->

<section class="banner">

    <img src="https://br.web.img3.acsta.net/c_640_360/img/bb/d5/bbd568870de0ab7e8f903696885d3801.png"
        class="banner-img" alt="Obsessão">

    <div class="banner-info">

        <h1>OBSESSÃO</h1>

        <p>
            O filme mais assistido da semana.
        </p>

        <div class="banner-buttons">

            <!-- <a href="filme.php">
                <button class="btn btn-light btn-lg">
                     ▶  Assistir 
                </button>
            </a> -->

            <!-- <button class="btn btn-secondary btn-lg">
                + Minha Lista
            </button> -->

        </div>

    </div>

</section>


<!-- CONTINUE ASSISTINDO -->

<section class="filmes-section">

    <h3>Continue Assistindo</h3>

    <div class="lista-filmes">

        <a href="filme_deslogado.php">
            <img src="https://static.wikia.nocookie.net/dublagem/images/3/3c/I_Am_Not_Okay_With_This.png/revision/latest?cb=20260106013924&path-prefix=pt-br"
                alt="I Am Not Okay With This">
        </a>

        <img src="https://a.ltrbxd.com/resized/film-poster/2/2/9/1/8/22918-pixote-0-600-0-900-crop.jpg?v=c69d3e271c"
            alt="Filme">

        <img src="https://static.wikia.nocookie.net/dublagem/images/0/04/The_end_of_the_fucking_world_poster.jpg/revision/latest?cb=20200530041710&path-prefix=pt-br"
            alt="The End of the F***ing World">

        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWMG6cn_5d9EriI8n_iNW3uhIRfqMUHsJmnRWnqnctT5Tj5M58ihwRurc&s=10"
            alt="Série">

        <img src="https://static.wikia.nocookie.net/dublagem/images/e/e5/Obsessao.png/revision/latest?cb=20260518183806&path-prefix=pt-br"
            alt="Obsessão">

    </div>

</section>


<!-- FILMES -->

<section class="filmes-section">

    <h3>Filmes</h3>

    <div class="lista-filmes">

        <img src="https://a.ltrbxd.com/resized/film-poster/2/2/9/1/8/22918-pixote-0-600-0-900-crop.jpg?v=c69d3e271c"
            alt="Filme">

        <img src="https://static.wikia.nocookie.net/dublagem/images/e/e5/Obsessao.png/revision/latest?cb=20260518183806&path-prefix=pt-br"
            alt="Obsessão">

        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThdrDmxue3HrAW26LBPosNUloADC_IrMl-nZRP_tbnZ_E_T5T655DC2ys&s=10"
            alt="Filme">

        <img src="https://upload.wikimedia.org/wikipedia/pt/3/3d/Scott_Pilgrim_vs._the_World.png"
            alt="Scott Pilgrim">

        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgeNoVAwjIg5qa9RUnaiKlb1NKIJGE6enlzsDExl_IzMNvOyigrcmFCFFyvqf_myTJjS7Im-A-7tSWi3Vil3qOVfGA9VasnqQic1WxnSneX4UkSyTLQmRwJbtqdrzOC_Ypv-IHZIM3cKOE/w1200-h630-p-k-no-nu/rua+do+medo+parte+1+1994+critica+divulgantemorte.jpg"
            alt="Rua do Medo">

    </div>

</section>


<!-- SÉRIES -->

<section class="filmes-section ultima-section">

    <h3>Séries</h3>

    <div class="lista-filmes">

        <img src="https://static.wikia.nocookie.net/dublagem/images/3/3c/I_Am_Not_Okay_With_This.png/revision/latest?cb=20260106013924&path-prefix=pt-br"
            alt="I Am Not Okay With This">

        <img src="https://static.wikia.nocookie.net/dublagem/images/0/04/The_end_of_the_fucking_world_poster.jpg/revision/latest?cb=20200530041710&path-prefix=pt-br"
            alt="The End of the F***ing World">

        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWMG6cn_5d9EriI8n_iNW3uhIRfqMUHsJmnRWnqnctT5Tj5M58ihwRurc&s=10"
            alt="Série">

        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-TZbUbSdSw-TbmxLD6Q8bo_CzW_BkK6-Di_o19HtrRN8TyZ7ARmdjzOgp&s=10"
            alt="Série">

        <img src="https://i.pinimg.com/564x/00/ea/7c/00ea7c88e9e80f8bea6d13f3f7f0a810.jpg"
            alt="Série">

    </div>

</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
