<!DOCTYPE html>
<html lang="es">
<head>
    <title>PHP Sesion 2</title>
    <meta charset="utf-8"/>
    
    <meta name="author" content="Diego Trapiello Mendoza" /> 
    
    <link href="Ejercicio6.css" rel="stylesheet" />
</head>
    
<body>
    
    <h1>Crear Tabla</h1>
        
    <section>
        <h2>Resultado interpretado</h2>
        <p>Se crea la tabla en PruebasUsabilidad</p> 
        <p>PruebasUsabilidad(edad,nombre,apellidos,email,telefono,sexo,nivel,tiempo,correcto,comentarios,propuestas,valoracion) </p>
        
        <form action='#' method='post' enctype='multipart/form-data'>
            <p>Archivo csv a cargar</p> 
            <p>
                <input type='file' name='archivo'/>
            </p>
            <p>
                <input type='submit' value='Enviar'/>
            </p>
        </form>
<?php
include_once 'BaseDatos.php';
if ($_FILES) {
    session_start();

    if (isset($_SESSION["file"]))
        $file=$_FILES;
    $baseDatos = new BaseDatos();

    $baseDatos->cargarArchivo($_FILES);
}
?>
    </section>

</body>
</html>