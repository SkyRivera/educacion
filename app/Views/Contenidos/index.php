<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('contenido'); ?>

<div class="container my-4">
    <div class="row text-center">
        <div class="col-12 mb-4">
            <h1 class="display-4">Últimos Contenidos</h1>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
        <?php foreach ($contenidos as $contenido) : ?>
            <div class="col">
                <div class="card h-100 border border-2 rounded shadow">
                    <img src="<?= base_url('public/uploads/' . $contenido['imagen_previa']) ?>" class="card-img-top mx-auto d-block" style="max-width: 100%;" alt="Thumbnail">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($contenido['titulo']) ?></h5>
                        <p class="card-text"><?= esc($contenido['descripcion']) ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="<?= site_url('contenidos/' . $contenido['id']) ?>" class="btn btn-sm btn-outline-primary">Ver más</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col text-center mt-4">
            <a href="<?= site_url('contenidos/admin') ?>" class="btn btn-primary btn-lg">Administrar Contenidos</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?php echo $this->endSection(); ?>