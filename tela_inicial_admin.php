<?php

require_once(__DIR__ . "/includes/proteger_admin.php");

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ORION TV</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/tela_inicial2.css">

</head>

<body>

    <!-- NAVBAR -->
   
    <nav class="navbar navbar-expand navbar-dark bg-dark">

        <a class="navbar-brand fw-bold fs-3" href="#">
            ORION TV
        </a>

        <div class="navbar-nav ms-5">

            <a class="nav-link" href="#">Em Alta</a>
            <a class="nav-link" href="#">Filmes</a>
            <a class="nav-link" href="#">Séries</a>
            <a class="nav-link" href="#">Kids</a>

        </div>

        <div class="ms-auto d-flex align-items-center">

          <a href="busca.php" class="btn btn-dark me-3">
    <i class="bi bi-search"></i>
</a>
        
      <a href="assinaturas_admin.php" class="btn btn-dark">
    <i class="bi bi-person-circle"></i> 
</a>
        </div>

    </nav>

    <!-- BANNER -->

    <div class="banner">

        <img src="https://br.web.img3.acsta.net/c_640_360/img/bb/d5/bbd568870de0ab7e8f903696885d3801.png" class="banner-img">

        <div class="banner-info">

            <h1>OBSESSÃO</h1>

            <p>
                O filme mais assistido da semana.
            </p>

          <!--  <a href="filme_admin.php"> <button class="btn btn-light btn-lg">
                ▶ Assistir
            </button>
                </a>
            <button class="btn btn-secondary btn-lg">
                + Minha Lista
            </button> -->

        </div>

    </div>


    <!-- CONTINUE ASSISTINDO -->

    <div class="container-fluid mt-5">

        <h3 class="text-white mb-3">
            Continue Assistindo
        </h3>

        <div class="lista-filmes">

           <a href="filme_admin.php">
        <img src="https://static.wikia.nocookie.net/dublagem/images/3/3c/I_Am_Not_Okay_With_This.png/revision/latest?cb=20260106013924&path-prefix=pt-br">
        </a>
            <img src="https://a.ltrbxd.com/resized/film-poster/2/2/9/1/8/22918-pixote-0-600-0-900-crop.jpg?v=c69d3e271c">
            <img src="https://static.wikia.nocookie.net/dublagem/images/0/04/The_end_of_the_fucking_world_poster.jpg/revision/latest?cb=20200530041710&path-prefix=pt-br">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWMG6cn_5d9EriI8n_iNW3uhIRfqMUHsJmnRWnqnctT5Tj5M58ihwRurc&s=10">
            <img src="https://static.wikia.nocookie.net/dublagem/images/e/e5/Obsessao.png/revision/latest?cb=20260518183806&path-prefix=pt-br">

        </div>

    </div>


    <!-- FILMES -->

    <div class="container-fluid mt-5">

        <h3 class="text-white mb-3">
            Filmes
        </h3>

        <div class="lista-filmes">

            <img src="https://a.ltrbxd.com/resized/film-poster/2/2/9/1/8/22918-pixote-0-600-0-900-crop.jpg?v=c69d3e271c">
            <img src="https://static.wikia.nocookie.net/dublagem/images/e/e5/Obsessao.png/revision/latest?cb=20260518183806&path-prefix=pt-br">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThdrDmxue3HrAW26LBPosNUloADC_IrMl-nZRP_tbnZ_E_T5T655DC2ys&s=10">
            <img src="https://upload.wikimedia.org/wikipedia/pt/3/3d/Scott_Pilgrim_vs._the_World.png">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgeNoVAwjIg5qa9RUnaiKlb1NKIJGE6enlzsDExl_IzMNvOyigrcmFCFFyvqf_myTJjS7Im-A-7tSWi3Vil3qOVfGA9VasnqQic1WxnSneX4UkSyTLQmRwJbtqdrzOC_Ypv-IHZIM3cKOE/w1200-h630-p-k-no-nu/rua+do+medo+parte+1+1994+critica+divulgantemorte.jpg">

        </div>

    </div>


    <!-- SÉRIES -->

    <div class="container-fluid mt-5 mb-5">

        <h3 class="text-white mb-3">
            Séries
        </h3>

        <div class="lista-filmes">

            <img src="https://static.wikia.nocookie.net/dublagem/images/3/3c/I_Am_Not_Okay_With_This.png/revision/latest?cb=20260106013924&path-prefix=pt-br">
            <img src="https://static.wikia.nocookie.net/dublagem/images/0/04/The_end_of_the_fucking_world_poster.jpg/revision/latest?cb=20200530041710&path-prefix=pt-br">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWMG6cn_5d9EriI8n_iNW3uhIRfqMUHsJmnRWnqnctT5Tj5M58ihwRurc&s=10">
            <img src=https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-TZbUbSdSw-TbmxLD6Q8bo_CzW_BkK6-Di_o19HtrRN8TyZ7ARmdjzOgp&s=10>
            <img src=https://i.pinimg.com/564x/00/ea/7c/00ea7c88e9e80f8bea6d13f3f7f0a810.jpg>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>