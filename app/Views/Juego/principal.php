<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('scriptshead'); ?>
<style>
    .container_section {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 70vh;
        padding: 20px;
    }

    .card {
        background: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 20px;
        max-width: 600px;
        width: 100%;
        margin-top: 20px;
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        /* Añade un margen arriba para separar del contenido superior */
    }

    .card-header {
        background-color: #007bff;
        color: white;
        font-size: 1.5rem;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        margin-bottom: 20px;
        /* Espacio inferior para separar del contenido siguiente */
    }

    .card h1 {
        font-size: 2.5rem;
        margin: 20px 0;
    }

    .btn-group-vertical .btn {
        margin-bottom: 10px;
        font-size: 1.25rem;
        padding: 15px;
        border-radius: 50px;
    }

    .btn-group-vertical .btn:hover {
        background-color: #0056b3;
    }
</style>
<?php echo $this->endSection(); ?>

<?php echo $this->section('contenido'); ?>
<div class="card text-center">
    <div class="card-header">
        Juego
    </div>
    <h1>Depósitos y Retiros</h1>
    <div class="btn-group-vertical">
        <a href="<?= site_url('juego/nivel/1') ?>" class="btn btn-primary">Nivel 1</a>
        <a href="<?= site_url('juego/nivel/2') ?>" class="btn btn-primary">Nivel 2</a>
        <a href="<?= site_url('juego/nivel/3') ?>" class="btn btn-primary">Nivel 3</a>
        <a href="<?= site_url('juego/nivel/4') ?>" class="btn btn-primary">Nivel 4</a>
    </div>
</div>
<?php echo $this->endSection(); ?>