<!DOCTYPE html>
<html lang="es">
<head>
    <title>PHP Sesion 2</title>
    <meta charset="utf-8"/>
    
    <meta name="author" content="Diego Trapiello Mendoza" /> 
    
    <link href="Ejercicio6.css" rel="stylesheet" />
</head>
    
<body>
    
    <h1>Generar Informe</h1>
        
    <section>
        <h2>Resultado interpretado</h2>
        <p>Se genera informe de la tabla en PruebasUsabilidad</p>
        
        <?php
            include_once 'BaseDatos.php';

            $baseDatos = new BaseDatos();

            $baseDatos->generarInforme();
        ?> 
    </section>

</body>
</html>