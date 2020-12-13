<!DOCTYPE html>
<html lang="es">
<head>
<title>Ejercicio 7</title>
    <meta charset="utf-8"/>
    <meta name="author" content="Diego Trapiello Mendoza" /> 
    <link href="Ejercicio7.css" rel="stylesheet"/>
</head>

<body>
    <h1>Aplicacion Objetos RPG</h1>

    <section>
        <h2>Añadir nuevo objeto a la base de datos</h2>  
        
        <p>Formulario para añadir nuevos objetos</p>
        
        <form method="post" action="#" id="usrform">
                <p>Nombre:<input type="text" name="nombre" required/></p>
                <p>Tipo de objeto: <select name="tipoobjeto">
                <option disabled selected> -- Seleccionar Tipo -- </option>
                <?php
                  include_once 'BaseDatos.php';
                  $basedatos = new BaseDatos();
                  $basedatos->obtenerTipos();
                ?>
                </select>
                </p>
                <input type="submit" value="Insertar Datos" />
        </form>
        <?php
        if (count($_POST) > 0) {
            $basedatos->añadirObjeto(
                $_POST['nombre'],
                $_POST['tipoobjeto']
            );
        }
        ?>
    </section>
    <a href="Ejercicio7.php" class="button">Volver</a>
    <footer>
    <p>
        <img style="border:0;width:88px;height:31px"
            src="https://jigsaw.w3.org/css-validator/images/vcss"
            alt="¡CSS Válido!" />

            <img style="border:0;width:88px;height:31px"
            src="https://jigsaw.w3.org/css-validator/images/vcss-blue"
            alt="¡CSS Válido!" />
    </p> 
    </footer>
</body>
</html>