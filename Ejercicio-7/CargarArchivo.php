<!DOCTYPE html>
<html lang="es">
<head>
<title>Ejercicio 7</title>
    <meta charset="utf-8"/>
    
    <meta name="author" content="Diego Trapiello Mendoza" /> 
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <link href="Ejercicio7.css" rel="stylesheet" />
</head>
    
<body>
    
    <h1>Aplicacion Objetos RPG</h1>
        
    <section>
        <h2>Cargar Archivos</h2>
        <p>Botones para cargar ficheros .csv con datos para la base de datos </p>
        

        <form method="post" action="" enctype='multipart/form-data' title="Formulario">
                <p>Cargar Fichero Enemigos</p>
                <input type="file"  name = "fileEnemigos" title="Fichero enemigos"/>
                <input type='submit' value='Enviar' name="enemigos" />
                <p>Cargar Fichero Objetos</p>
                <input type="file"  name = "fileObjetos" title="Fichero Objetos"/>
                <input type='submit' value='Enviar' name="objetos"/>
                <p>Cargar Fichero Drops</p>
                <input type="file"  name = "fileDrops" title="Fichero Drops"/>
                <input type='submit' value='Enviar' name="drops" />
        </form>
<?php
include_once 'BaseDatos.php';
$baseDatos = new BaseDatos();
if (isset($_POST['enemigos'])) {
    if ($_FILES["fileEnemigos"]["size"] > 0) {
        $baseDatos->cargarEnemigos($_FILES["fileEnemigos"]["tmp_name"]);
        }
}
if (isset($_POST['objetos'])) {
    if ($_FILES["fileObjetos"]["size"] > 0) {
        $baseDatos->cargarObjetos($_FILES["fileObjetos"]["tmp_name"]);
        }
}
if (isset($_POST['drops'])) {
    if ($_FILES["fileDrops"]["size"] > 0) {
        $baseDatos->cargarDrops($_FILES["fileDrops"]["tmp_name"]);
        }
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