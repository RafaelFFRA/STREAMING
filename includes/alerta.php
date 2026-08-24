<?php

function mostrarAlerta($mensagem, $acao = "history.back()") {

?>

<div id="orionAlerta" class="orion-overlay">

    <div
        class="orion-alerta"
        role="alertdialog"
        aria-modal="true"
    >

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

    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }


    .orion-overlay {

        position: fixed;

        top: 0;
        right: 0;
        bottom: 0;
        left: 0;

        width: 100vw;
        min-height: 100vh;

        background: rgba(0, 0, 0, 0.75);

        display: flex;

        justify-content: center;
        align-items: center;

        padding: 16px;

        z-index: 999999;

        font-family:
            Arial,
            Helvetica,
            sans-serif;

    }


    .orion-alerta {

        width: min(430px, 100%);

        background: #222;

        border-radius: 16px;

        padding: clamp(20px, 5vw, 30px);

        text-align: center;

        color: white;

        box-shadow:
            0 10px 40px
            rgba(0, 0, 0, 0.5);

        animation:
            orionEntrada
            0.2s
            ease;

    }


    .orion-logo {

        font-size:
            clamp(1.5rem, 6vw, 1.8rem);

        font-weight: bold;

        color: #006dcc;

        margin-bottom: 18px;

    }


    .orion-mensagem {

        font-size:
            clamp(0.95rem, 4vw, 1rem);

        color: #f1f1f1;

        line-height: 1.5;

        margin-bottom: 24px;

        overflow-wrap: break-word;

    }


    .orion-botao {

        width: 100%;

        min-height: 44px;

        padding: 12px 20px;

        border: none;

        border-radius: 8px;

        background: #006dcc;

        color: white;

        font-size:
            clamp(1rem, 4vw, 1.1rem);

        font-weight: 600;

        font-family:
            Arial,
            Helvetica,
            sans-serif;

        cursor: pointer;

        transition:
            background
            0.2s;

    }


    .orion-botao:hover {

        background: #005aa3;

    }


    .orion-botao:active {

        transform: scale(0.98);

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


    @media (max-width: 400px) {

        .orion-overlay {

            padding: 12px;

        }


        .orion-alerta {

            border-radius: 14px;

        }

    }

</style>


<script>

    function fecharOrionAlerta() {

        document
            .getElementById("orionAlerta")
            .remove();

        <?= $acao ?>;

    }

</script>


<?php

}

?>