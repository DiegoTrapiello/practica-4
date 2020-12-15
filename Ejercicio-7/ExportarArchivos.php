<?php

     include_once 'BaseDatos.php';
    $basedatos = new BaseDatos();
     if (count($_POST) > 0) {
         if (isset($_POST['enemigos'])) $basedatos->exportarEnemigos();
        if (isset($_POST['objetos'])) $basedatos->exportarObjetos();
         if (isset($_POST['drops'])) $basedatos->exportarDrops();
     }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Ejercicio 7</title>
    <meta charset="utf-8"/>
    
    <meta name="author" content="Diego Trapiello Mendoza" /> 
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio7.css" rel="stylesheet" >
</head>
    
<body>
    
    <h1>Aplicacion Objetos RPG</h1> 
    
    <section>
        <h2>Exportar archivos</h2>  
        
        <p>Botones que generan ficheros .csv con los datos de la base de datos</p>
        
        <form method="post" action="" title="Formulario">
                <input type="submit" value="Generar Fichero Enemigos" name="enemigos"/>
                <input type="submit" value="Generar Fichero Objetos" name="objetos"/>
                <input type="submit" value="Generar Fichero Drops" name="drops" />
        </form>
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