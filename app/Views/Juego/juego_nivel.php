<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('scriptshead'); ?>
<style>
    .game-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 70vh;
        padding: 20px;
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    }

    .bank-container {
        border: 2px dashed #333;
        padding: 20px;
        min-height: 200px;
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 20px;
        width: 100%;
        max-width: 600px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .bank-container:hover {
        border-color: #ff6f61;
    }

    .money-item, .dropped-item {
        margin: 10px;
        cursor: pointer;
        transition: transform 0.2s;
        font-size: 1.5rem;
        padding: 10px;
        border-radius: 5px;
        background-color: #ff6f61;
        color: #fff;
    }

    .money-item:hover, .dropped-item:hover {
        transform: scale(1.1);
    }

    .dropped-item {
        background-color: #66a6ff;
    }

    .completion-screen {
        display: none;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 70vh;
        background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
        text-align: center;
        padding: 20px;
    }

    .completion-screen h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #fff;
    }

    .completion-screen p {
        font-size: 1.5rem;
        margin-bottom: 30px;
        color: #fff;
    }

    .money-icons {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .btn-primary, .btn-success, .btn-secondary {
        margin: 5px;
    }

    .custom-alert {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        z-index: 1000;
    }

    @media (max-width: 600px) {
        .game-container {
            padding: 10px;
        }

        .money-item, .dropped-item {
            font-size: 1.2rem;
        }

        .completion-screen h1 {
            font-size: 2rem;
        }

        .completion-screen p {
            font-size: 1.2rem;
        }
    }
</style>
<?php echo $this->endSection(); ?>

<?php echo $this->section('contenido'); ?>
<div class="container game-container">
    <h1 class="display-4 text-center">Depósitos y Retiros - Nivel <?= $nivel ?></h1>
    <p class="lead text-center">Completa la cantidad: $<span id="target-amount"></span></p>
    <div class="bank-container" ondrop="drop(event)" ondragover="allowDrop(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)">
        <p id="drop-message" class="text-center">Arrastra y suelta los billetes y monedas aquí</p>
    </div>
    <div class="money-icons">
        <?php if ($nivel < 4): ?>
            <span class="money-item" id="billete100" draggable="true" ondragstart="drag(event)" data-value="100" ontouchstart="touchStart(event)">💵 Billete 100</span>
            <span class="money-item" id="billete10" draggable="true" ondragstart="drag(event)" data-value="10" ontouchstart="touchStart(event)">🪙 Moneda 10</span>
            <span class="money-item" id="billete1" draggable="true" ondragstart="drag(event)" data-value="1" ontouchstart="touchStart(event)">🪙 Moneda 1</span>
        <?php else: ?>
            <span class="money-item" id="billete1000" draggable="true" ondragstart="drag(event)" data-value="1000" ontouchstart="touchStart(event)">💵 Billete 1000</span>
            <span class="money-item" id="billete100" draggable="true" ondragstart="drag(event)" data-value="100" ontouchstart="touchStart(event)">💵 Billete 100</span>
            <span class="money-item" id="billete10" draggable="true" ondragstart="drag(event)" data-value="10" ontouchstart="touchStart(event)">🪙 Moneda 10</span>
            <span class="money-item" id="billete1" draggable="true" ondragstart="drag(event)" data-value="1" ontouchstart="touchStart(event)">🪙 Moneda 1</span>
        <?php endif; ?>
    </div>
    <div class="text-center">
        <button class="btn btn-success mt-3" onclick="checkAmount()">Listo</button>
        <button class="btn btn-secondary mt-3" onclick="resetGame()">Reiniciar</button>
        <a href="<?= site_url('juego') ?>" class="btn btn-secondary mt-3">Regresar</a>
        <button class="btn btn-primary mt-3" id="next-level-btn" style="display:none;" onclick="nextLevel()">Siguiente nivel</button>
    </div>
</div>

<div class="completion-screen">
    <h1>¡Felicidades!</h1>
    <p>Has completado correctamente la cantidad de dinero señalada.<br>Con lo que muestras que dominas la descomposición aditiva de los números.</p>
    <button class="btn btn-primary" onclick="resetGame()">Reiniciar</button>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    let targetAmount;
    let totalAmount = 0;
    let attempts = 0;
    const nivel = <?= $nivel ?>;

    function generateRandomAmount() {
        return nivel === 4 ? Math.floor(Math.random() * 9999) + 1 : Math.floor(Math.random() * 999) + 1;
    }

    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        const data = ev.dataTransfer.getData("text");
        const moneyItem = document.getElementById(data);
        const value = parseInt(moneyItem.getAttribute('data-value'));

        const clone = moneyItem.cloneNode(true);
        clone.id = `clone-${data}-${Date.now()}`;
        clone.classList.remove('money-item');
        clone.classList.add('dropped-item');
        clone.ondblclick = function () {
            totalAmount -= value;
            clone.remove();
        };
        ev.target.appendChild(clone);
        totalAmount += value;
    }

    function touchStart(ev) {
        ev.dataTransfer = {
            setData: function(type, val) {
                this[type] = val;
            },
            getData: function(type) {
                return this[type];
            }
        };
        drag(ev);
    }

    function touchMove(ev) {
        ev.preventDefault();
        const touch = ev.touches[0];
        const target = document.elementFromPoint(touch.clientX, touch.clientY);
        if (target && target.classList.contains('bank-container')) {
            drop(ev);
        }
    }

    function touchEnd(ev) {
        ev.preventDefault();
        const touch = ev.changedTouches[0];
        const target = document.elementFromPoint(touch.clientX, touch.clientY);
        if (target && target.classList.contains('bank-container')) {
            drop(ev);
        }
    }

    function checkAmount() {
        let message;
        let buttons;

        if (totalAmount < targetAmount) {
            message = 'El dinero en el recuadro es menor al indicado';
            playSound('error');
            buttons = '<button class="btn btn-secondary mt-3" onclick="closeAlert()">Aceptar</button>';
        } else if (totalAmount > targetAmount) {
            message = 'El dinero en el recuadro es mayor al indicado';
            playSound('error');
            buttons = '<button class="btn btn-secondary mt-3" onclick="closeAlert()">Aceptar</button>';
        } else {
            message = '¡Felicidades! Has completado correctamente la cantidad de dinero señalada. Con lo que muestras que dominas la descomposición aditiva de los números.';
            playSound('success');
            attempts++;
            buttons = attempts >= 5 
                ? '<button class="btn btn-primary mt-3" onclick="nextLevel()">Siguiente nivel</button>'
                : '<button class="btn btn-primary mt-3" onclick="closeAlert()">Aceptar</button>';
        }
        
        const alertHtml = `<div class="custom-alert">
                                <p>${message}</p>
                                ${buttons}
                            </div>`;
        $('body').append(alertHtml);
    }

    function closeAlert() {
        $('.custom-alert').remove();
        if (totalAmount === targetAmount && attempts < 5) {
            resetGame();
        }
    }

    function resetGame() {
        totalAmount = 0;
        targetAmount = generateRandomAmount();
        $('#target-amount').text(targetAmount);
        $('.bank-container').empty().append('<p id="drop-message" class="text-center">Arrastra y suelta los billetes y monedas aquí</p>');
        closeAlert();
    }

    function nextLevel() {
        window.location.href = '<?= site_url('juego/nivel/' . ($nivel + 1)) ?>';
    }

    function playSound(type) {
        let audio = new Audio();
        if (type === 'success') {
            audio.src = '<?= base_url('assets/sounds/success.mp3') ?>';
        } else if (type === 'error') {
            audio.src = '<?= base_url('assets/sounds/error.mp3') ?>';
        }
        audio.play();
    }

    $(document).ready(function () {
        targetAmount = generateRandomAmount();
        $('#target-amount').text(targetAmount);
    });
</script>
<?php echo $this->endSection(); ?>