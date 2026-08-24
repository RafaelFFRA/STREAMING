<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orion TV - Busca</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS da página -->
    <link rel="stylesheet" href="css/busca.css">
</head>

<body>

    <!-- CABEÇALHO -->
    <header class="topo">

        <div class="logo">
            ORION TV
        </div>

        <a href="tela_inicial_admin.php" class="btn-voltar">
            Voltar
        </a>

    </header>


    <!-- CONTEÚDO -->
    <main class="container busca-container">

        <!-- CAMPO DE BUSCA -->
        <div class="area-busca">

            <div class="campo-busca">

                <span class="icone-busca">⌕</span>

                <input 
                    type="text"
                    placeholder="Pesquisar filmes e séries..."
                    class="input-busca"
                    name="pesquisa"
                >

                <button class="btn-pesquisar">
                    Pesquisar
                </button>

            </div>

        </div>


        <!-- TÍTULO -->
        <div class="titulo-resultados">
            <h2>Resultados da busca</h2>
        </div>


        <!-- CARDS -->
        <div class="row g-4">

            <!-- FILME 1 -->
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="filme.php?id=1" class="card-filme">

                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThdrDmxue3HrAW26LBPosNUloADC_IrMl-nZRP_tbnZ_E_T5T655DC2ys&s=10" alt="Filme 1">

                    <h3>IT: A coisa</h3>

                </a>
            </div>


            <!-- FILME 2 -->
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="filme.php?id=2" class="card-filme">

                    <img src="https://a.ltrbxd.com/resized/film-poster/2/2/9/1/8/22918-pixote-0-600-0-900-crop.jpg?v=c69d3e271c" alt="Filme 2">

                    <h3>Pixote</h3>

                </a>
            </div>


            <!-- FILME 3 -->
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="filme.php?id=3" class="card-filme">

                    <img src="https://static.wikia.nocookie.net/dublagem/images/3/3c/I_Am_Not_Okay_With_This.png/revision/latest?cb=20260106013924&path-prefix=pt-br" alt="Filme 3">

                    <h3>IANOWT</h3>

                </a>
            </div>


            <!-- FILME 4 -->
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="filme.php?id=4" class="card-filme">

                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWMG6cn_5d9EriI8n_iNW3uhIRfqMUHsJmnRWnqnctT5Tj5M58ihwRurc&s=10" alt="Filme 4">

                    <h3>Apenas Um Show</h3>

                </a>
            </div>


            <!-- FILME 5 -->
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="filme.php?id=5" class="card-filme">

                    <img src="https://upload.wikimedia.org/wikipedia/pt/3/3d/Scott_Pilgrim_vs._the_World.png" alt="Filme 5">

                    <h3>Scott Pilgrim </h3>

                </a>
            </div>


            <!-- FILME 6 -->
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <a href="filme.php?id=6" class="card-filme">

                    <img src=https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-TZbUbSdSw-TbmxLD6Q8bo_CzW_BkK6-Di_o19HtrRN8TyZ7ARmdjzOgp&s=10 alt="Filme 6">

                    <h3>Evangelion</h3>

                </a>
            </div>

        </div>

    </main>


</body>
</html>