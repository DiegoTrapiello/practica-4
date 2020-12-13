<!DOCTYPE html>
<html lang="es">
<head>
    <title>PHP Sesion 2</title>
    <meta charset="utf-8"/>
    
    <meta name="author" content="Diego Trapiello Mendoza"/> 
    
    <link href="Ejercicio6.css" rel="stylesheet" />
</head>
    
<body>
    
    <h1>Crear Tabla</h1>
        
    <section>
        <h2>Resultado interpretado</h2>
        <p>Se crea la tabla en PruebasUsabilidad</p> 
        <p>PruebasUsabilidad(edad,nombre,apellidos,email,telefono,sexo,nivel,tiempo,correcto,comentarios,propuestas,valoracion) </p>
        
        <?php
            include_once 'BaseDatos.php';

            $baseDatos = new BaseDatos();

            $baseDatos->crearTabla();
        ?> 
    </section>

</body>
</html>