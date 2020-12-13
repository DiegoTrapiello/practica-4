<!DOCTYPE html>
<html lang="es">
<head>
<title>Ejercicio 7</title>
    <meta charset="utf-8"/>
    
    <meta name="author" content="Diego Trapiello Mendoza" /> 
    
    <!-- enlace a la hoja de estilos -->
    <link href="Ejercicio7.css" rel="stylesheet" >
</head>
    
<body>
    
    <h1>Aplicacion Objetos RPG</h1> 
    
    <section>
        <h2>Ver objetos por enemigo</h2>  
        
        <p>Menú dropdown que permite seleccionar un enemigo y ver los objetos que se pueden obtener de dicho enemigo</p>
        
        <form method="post" action="">
                <select name="buscarobjeto">
                <option disabled selected> --Seleccionar Enemigo -- </option>
                <?php
                  include_once 'BaseDatos.php';
                  $basedatos = new BaseDatos();
                  $basedatos->obtenerEnemigos();
                ?>
                </select>
                <input type="submit" value="Buscar" />
        </form>

                
                <?php
                  if (count($_POST) > 0) {
                    $basedatos->buscarObjetosPorEnemigo($_POST['buscarobjeto']);
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