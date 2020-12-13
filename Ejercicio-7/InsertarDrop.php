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
        <h2>Añadir nuevo drop a la base de datos</h2>  
        
        <p>Formulario para añadir nuevos drops</p>
        
        <form method="post" action="#" id="usrform">
        <p>Enemigo: <select name="enemigo">
                <option disabled selected> -- Seleccionar Enemigo -- </option>
                <?php
                  include_once 'BaseDatos.php';
                  $basedatos = new BaseDatos();
                  $basedatos->obtenerEnemigos();
                ?>
                </select>
                </p>
                <p>Objeto: <select name="objeto">
                <option disabled selected> -- Seleccionar Objeto -- </option>
                <?php
                  $basedatos->obtenerObjetos();
                ?>
                </select>
                </p>
                <p>Porcentaje: <input type="number" id="quantity" name="porcentaje" min="0" max="100" step="0.01"></p>
                <input type="submit" value="Insertar Datos" />
        </form>
        <?php
        if (count($_POST) > 0) {
            $basedatos->añadirDrop(
                $_POST['enemigo'],
                $_POST['objeto'],
                $_POST['porcentaje']
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