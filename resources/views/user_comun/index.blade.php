<x-navbar></x-navbar>

<body>
    <p id='titulo_mini'>Selecciona un minijuego</p>

    <div class="minijuegos">

    <?php foreach ($minijuegos as $minijuego): ?>
        <a href="pagina_minijuego.php?pk_minijuego=<?= $minijuego['pk_minijuegos'] ?>">
        <div class="cuadro-mini">
            
            <img id='img-mini' src="1.png" alt="a">

            <div class="titulo-mini">
                <p>PLAY</p>
                <P><?=$minijuego['titulo']?></P>
            </div>
        </div>
        </a>
    <?php endforeach; ?>
    </div>
</body>