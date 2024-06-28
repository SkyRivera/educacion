<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Educación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php echo $this->renderSection("scriptshead"); ?>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }
        .container_section {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
        }
        footer {
            background-color: #343a40;
            color: white;
        }
        footer span {
            font-size: 0.9rem;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand,
        .navbar-nav .nav-link {
            color: black;
        }
        .navbar-brand:hover,
        .navbar-nav .nav-link:hover {
            color: gray;
        }
    </style>
</head>

<body>
    <?php echo $this->include('plantilla/menu'); ?>
    <div class='container_section'>
        <?php echo $this->renderSection("contenido"); ?>
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span>&copy; 2024 - Todos los derechos reservados</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php echo $this->renderSection("scriptsfooter"); ?>
</body>

</html>