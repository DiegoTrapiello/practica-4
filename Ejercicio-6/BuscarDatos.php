<!DOCTYPE html>
<html lang="es">
<head>
    <title>PHP Sesion 2</title>
    <meta charset="utf-8"/>
    
    <meta name="author" content="Diego Trapiello Mendoza" /> 
    
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio6.css" rel="stylesheet" >
</head>
    
<body>
    
    <h1>Buscar Datos en Tabla</h1> 
    
    <section>
        <h2>Resultado interpretado</h2>  
        
        <p>Crear un formulario para buscar los datos de una personas en la base de datos agenda</p>
        
        
        <form method="post" action="#">
                <p>ID: <input type="number" name="id" min=1 required/> </p> 
                <input type="submit" value="Buscar" />
        </form>

        <?php
        include_once 'BaseDatos.php';
        if (count($_POST) > 0) {
            $basedatos = new BaseDatos();
            $basedatos->buscarDatos($_POST['id']);
        }
        ?>

    </section>

</body>
</html>