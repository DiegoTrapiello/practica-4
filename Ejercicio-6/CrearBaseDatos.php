<!DOCTYPE html>
<html lang="es">
<head>
    <title>PHP Sesion 2</title>
    <meta charset="utf-8"/>
    
    <meta name="author" content="Diego Trapiello Mendoza"/> 
    
    <link href="Ejercicio6.css" rel="stylesheet" />
</head>
    
<body>
    
    <h1>Crear Base de Datos</h1>
        
    <section>
        <h2>Resultado interpretado</h2>
        <p>Se crea la base de datos PruebasUsabilidad</p> 
        <p>PRECONDICIÓN: debe existir el usuario en la base de datos MySQL </p>
        
        <?php
            include_once 'BaseDatos.php';

            $baseDatos = new BaseDatos();

            $baseDatos->crearBaseDatos();
        ?> 
    </section>

</body>
</html>