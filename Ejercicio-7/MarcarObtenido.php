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
        <h2>Marcar como obtenido un objeto</h2>  
        
        <p>Menú dropdown que permite seleccionar un objeto no obtenido como obtenido</p>

        <p>Desde este menu desplegable puede seleccionar que se ha obtenido un objeto de la lista de objetos no obtenidos</p>
        
        <form method="post" action="" title="Formulario">
                <select name="marcarobjeto" title="Marcar Objeto">
                <option disabled selected> --Seleccionar Objeto -- </option>
                <?php
                  include_once 'BaseDatos.php';
                  $basedatos = new BaseDatos();
                  $basedatos->obtenerObjetos();
                  if (count($_POST) > 0) {
                    $basedatos->marcarObtenido($_POST['marcarobjeto']);
                }
                ?>
                </select>
                <input type="submit" value="Marcar" />
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