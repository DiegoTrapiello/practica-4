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
    
    <h1>Borrar Datos en Tabla</h1>
    
    
    
    <section>
        <h2>Resultado interpretado</h2>  
        
        <p>Crear un formulario para buscar los datos de una persona en la base de datos pruebasusabilidad que será borrada</p>
        
        
        <form method="post" action="#">
                <p>ID: <input type="number" min=1 name="id" required/> </p>
                
                <input type="submit" value="Eliminar" />
        </form>

        <?php
        include_once 'BaseDatos.php';
        if (count($_POST) > 0) {
            $basedatos = new BaseDatos();
            $basedatos->borrarDatos($_POST['id']);
        }
        ?>

    </section>

</body>
</html>