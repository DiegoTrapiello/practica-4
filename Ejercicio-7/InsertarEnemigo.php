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
        <h2>Añadir nuevo enemigo a la base de datos</h2>  
        
        <p>Formulario para añadir nuevos enemigos</p>
        
        <form method="post" action="#" id="usrform">
                <p>Nombre:<input type="text" name="nombre" required/></p>
                <p>Zona:<input type="text" name="zona" required/></p>
                <input type="submit" value="Insertar Datos" />
        </form>
        <?php
        include_once 'BaseDatos.php';
        if (count($_POST) > 0) {
            $basedatos = new BaseDatos();
            $basedatos->añadirEnemigo(
                $_POST['nombre'],
                $_POST['zona']
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