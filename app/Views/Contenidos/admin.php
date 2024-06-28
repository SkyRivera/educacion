<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('contenido'); ?>

<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-4">Administración de Contenidos</h1>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contenidos as $contenido) : ?>
                    <tr>
                        <td><?= esc($contenido['titulo']) ?></td>
                        <td>
                            <a href="<?= site_url('contenidos/edit/' . $contenido['id']) ?>" class="btn btn-warning btn-sm mx-1">Editar</a>
                            <a href="<?= site_url('contenidos/delete/' . $contenido['id']) ?>" class="btn btn-danger btn-sm mx-1">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-4">
        <a href="<?= site_url('contenidos/create') ?>" class="btn btn-success btn-lg">Nuevo Contenido</a>
        <a href="<?= site_url('/') ?>" class="btn btn-primary btn-lg">Volver a la pantalla principal</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?php echo $this->endSection(); ?>