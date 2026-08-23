<?php

function mostrarAlerta($mensagem, $acao = "history.back()") {

?>

<div id="orionAlerta" class="orion-overlay">

    <div class="orion-alerta">

        <div class="orion-logo">
            ORION TV
        </div>

        <div class="orion-mensagem">
            <?= htmlspecialchars($mensagem) ?>
        </div>

        <button
            type="button"
            class="orion-botao"
            onclick="fecharOrionAlerta()"
        >
            OK
        </button>

    </div>

</div>


<style>

    .orion-overlay {

        position: fixed;
        inset: 0;

        background: rgba(0, 0, 0, 0.75);

        display: flex;
        justify-content: center;
        align-items: center;

        padding: 20px;

        z-index: 9999;

        font-family: Arial, Helvetica, sans-serif;
    }


    .orion-alerta {

        width: 100%;
        max-width: 430px;

        background: #222;

        border-radius: 15px;

        padding: 30px;

        text-align: center;

        color: white;

        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);

        animation: orionEntrada 0.2s ease;
    }


    .orion-logo {

        font-size: 1.8rem;

        font-weight: bold;

        color: #006dcc;

        margin-bottom: 20px;
    }


    .orion-mensagem {

        font-size: 1rem;

        color: #f1f1f1;

        line-height: 1.5;

        margin-bottom: 25px;

        word-break: break-word;
    }


    .orion-botao {

        width: 100%;

        padding: 10px 20px;

        border: none;

        border-radius: 8px;

        background: #006dcc;

        color: white;

        font-size: 1rem;

        font-weight: 600;

        font-family: Arial, Helvetica, sans-serif;

        cursor: pointer;

        transition: background 0.2s;
    }


    .orion-botao:hover {

        background: #005aa3;
    }


    @keyframes orionEntrada {

        from {

            opacity: 0;

            transform: scale(0.95);
        }

        to {

            opacity: 1;

            transform: scale(1);
        }

    }


    @media (max-width: 576px) {

        .orion-alerta {

            max-width: 100%;

            padding: 25px 20px;
        }


        .orion-logo {

            font-size: 1.6rem;
        }


        .orion-mensagem {

            font-size: 0.95rem;
        }

    }

</style>


<script>

    function fecharOrionAlerta() {

        document.getElementById("orionAlerta").remove();

        <?= $acao ?>;

    }

</script>

<?php

}

?>