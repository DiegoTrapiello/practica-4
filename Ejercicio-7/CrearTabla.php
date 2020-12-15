<!DOCTYPE html>
<html lang="es">
<head>
<title>Ejercicio 7</title>
    <meta charset="utf-8"/>
    <meta name="author" content="Diego Trapiello Mendoza"/> 
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <link href="Ejercicio7.css" rel="stylesheet" />
</head>
    
<body>
    
<h1>Aplicacion Objetos RPG</h1>
        
    <section>
        <h2>Crear tabla</h2>
        <p>Se crean las tablas en BaseDatosRPG.</p> 
        <p>!OJO! Se crean sin datos, para añadir datos utilice la funcion de importar datos desde fichero csv o añadalos a mano</p>
        <p>Enemigos(nombre,zona)</p>
        <p>Objetos(nombre,tipo,obtenido)</p>
        <p>Drops(idEnemigo,idObjeto,porcentaje)</p>

        <?php
            include_once 'BaseDatos.php';

            $baseDatos = new BaseDatos();

            $baseDatos->crearTabla();
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