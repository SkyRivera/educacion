<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('contenido'); ?>

<div class="container my-4">
    <div class="card text-center shadow-lg p-3 mb-5 bg-white rounded">
        <div class="card-header bg-dark text-light">
            <h1 class="display-4"><?= esc($contenido['titulo']) ?></h1>
        </div>
        <div class="card-body">
            <img src="<?= base_url('writable/uploads/' . $contenido['imagen_portada']) ?>" class="img-fluid mb-4" alt="Portada">
            <p class="card-text"><?= $contenido['contenido_html'] ?></p>
        </div>
    </div>
    <div class="text-center">
        <a href="<?= site_url('/') ?>" class="btn btn-lg btn-primary">Volver a la pantalla principal</a>
    </div>
</div>

<?php echo $this->endSection(); ?>