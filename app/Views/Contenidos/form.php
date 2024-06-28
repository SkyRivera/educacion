<?php echo $this->extend('plantilla/layout'); ?>

<?php echo $this->section('scriptshead'); ?>
<script src="https://cdn.tiny.cloud/1/xejlwxubyn1ba1sinvazgaf4lam4a2xdwaj0q5e592mw7bvh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#contenido_html',
        menubar: false,
        plugins: 'lists',
        toolbar: 'bold italic | alignleft aligncenter alignright | bullist numlist'
    });
</script>
<style>
    /* Estilos adicionales para hacer el formulario más atractivo */
    .container {
        max-width: 800px; /* Ancho máximo del contenido para mantenerlo centrado y legible */
    }

    .form-control {
        border-radius: 10px; /* Bordes redondeados para los campos de formulario */
        border: 1px solid #ced4da; /* Borde del campo de formulario */
    }

    .img-thumbnail {
        max-width: 200px; /* Limitar el ancho de las imágenes para que no se salgan del diseño */
    }

    .btn-primary {
        background-color: #6c757d; /* Color de fondo del botón principal */
        border-color: #6c757d; /* Color del borde del botón principal */
    }

    .btn-primary:hover {
        background-color: #495057; /* Color de fondo del botón principal al pasar el mouse */
        border-color: #495057; /* Color del borde del botón principal al pasar el mouse */
    }

    .btn-secondary {
        background-color: #343a40; /* Color de fondo del botón secundario */
        border-color: #343a40; /* Color del borde del botón secundario */
    }

    .btn-secondary:hover {
        background-color: #212529; /* Color de fondo del botón secundario al pasar el mouse */
        border-color: #212529; /* Color del borde del botón secundario al pasar el mouse */
    }
</style>
<?php echo $this->endSection(); ?>

<?php echo $this->section('contenido'); ?>

<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-4"><?= isset($contenido) ? 'Editar' : 'Nuevo' ?> Contenido</h1>
    </div>
    <?= form_open_multipart(isset($contenido) ? 'contenidos/update/' . $contenido['id'] : 'contenidos/store', ['class' => 'needs-validation', 'novalidate' => '']) ?>
    <div class="row mb-3">
        <label for="titulo" class="col-sm-2 col-form-label">Título:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= isset($contenido) ? esc($contenido['titulo']) : '' ?>" maxlength="150" required>
            <div class="invalid-feedback">
                Por favor, ingrese un título.
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="palabras_clave" class="col-sm-2 col-form-label">Palabras clave:</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="palabras_clave" name="palabras_clave" maxlength="200"><?= isset($contenido) ? esc($contenido['palabras_clave']) : '' ?></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <label for="area_conocimiento" class="col-sm-2 col-form-label">Área de Conocimiento:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="area_conocimiento" name="area_conocimiento" value="<?= isset($contenido) ? esc($contenido['area_conocimiento']) : '' ?>" required>
            <div class="invalid-feedback">
                Por favor, ingrese el área de conocimiento.
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="tipo_contenido" class="col-sm-2 col-form-label">Tipo de Contenido:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="tipo_contenido" name="tipo_contenido" value="<?= isset($contenido) ? esc($contenido['tipo_contenido']) : '' ?>" required>
            <div class="invalid-feedback">
                Por favor, ingrese el tipo de contenido.
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="imagen_portada" class="col-sm-2 col-form-label">Imagen de Portada:</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="imagen_portada" name="imagen_portada">
            <?php if (isset($contenido) && $contenido['imagen_portada']) : ?>
                <img src="<?= base_url('writable/uploads/' . $contenido['imagen_portada']) ?>" alt="Imagen de Portada" class="img-thumbnail mt-2">
            <?php endif; ?>
        </div>
    </div>
    <div class="row mb-3">
        <label for="imagen_previa" class="col-sm-2 col-form-label">Imagen Previa:</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="imagen_previa" name="imagen_previa">
            <?php if (isset($contenido) && $contenido['imagen_previa']) : ?>
                <img src="<?= base_url('writable/uploads/' . $contenido['imagen_previa']) ?>" alt="Imagen Previa" class="img-thumbnail mt-2">
            <?php endif; ?>
        </div>
    </div>
    <div class="row mb-3">
        <label for="descripcion" class="col-sm-2 col-form-label">Descripción:</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="descripcion" name="descripcion" maxlength="200"><?= isset($contenido) ? esc($contenido['descripcion']) : '' ?></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <label for="contenido_html" class="col-sm-2 col-form-label">Contenido HTML:</label>
        <div class="col-sm-10">
            <textarea id="contenido_html" class="form-control" name="contenido_html"><?= isset($contenido) ? $contenido['contenido_html'] : '' ?></textarea>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
    </div>
    <?= form_close() ?>
    <div class="text-center mt-4">
        <a href="<?= site_url('contenidos/admin') ?>" class="btn btn-secondary btn-lg">Volver a Administración</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    // Bootstrap form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<?php echo $this->endSection(); ?>