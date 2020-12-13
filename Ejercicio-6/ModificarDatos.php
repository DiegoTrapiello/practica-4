<!DOCTYPE html>
<html lang="es">
<head>
    <title>PHP Sesion 2</title>
    <meta charset="utf-8"/>
    <meta name="author" content="Diego Trapiello Mendoza" /> 
    <link href="Ejercicio6.css" rel="stylesheet"/>
</head>

<body>
    <h1>Modificar Datos en Tabla</h1>

    <section>
        <h2>Resultado interpretado</h2>  
        
        <p>Formulario para modificar datos de personas en la base de datos pruebasusabilidad</p>
        
        <form method="post" action="#" id="usrform">
                <p>ID:<input type="number" name="id" min="1" required/> </p>
                <p>Nombre:<input type="text" name="nombre" required/></p>
                <p>Apellidos:<input type="text" name="apellidos"required/></p>
                <p>Email:<input type="text" name="email" required/></p>
                <p>Telefono:<input type="number" name="telefono" min="1" max="999999999" required/></p>
                <p>Edad:<input type="number" name="edad" min="1" max="150" required/></p>
                <p>Sexo: Hombre<input type="radio" name="sexo" value="Hombre" required/>
                Mujer<input type="radio" name="sexo" value="Mujer" /></p>
                <p>Nivel: 0<input type="radio" name="nivel" value=0 required>
                1<input type="radio" name="nivel" value=1>
                2<input type="radio" name="nivel" value=2>
                3<input type="radio" name="nivel" value=3>
                4<input type="radio" name="nivel" value=4>
                5<input type="radio" name="nivel" value=5>
                6<input type="radio" name="nivel" value=6>
                7<input type="radio" name="nivel" value=7>
                8<input type="radio" name="nivel" value=8>
                9<input type="radio" name="nivel" value=9>
                10<input type="radio" name="nivel" value=10></p>
                <p>Tiempo(Segundos):<input type="number" name="tiempo" min="1" required/></p>
                <p>Correcto: Sí<input type="radio" name="correcto" value="si" required/> 
                No<input type="radio" name="correcto" value="no"/> </p>
                <p>Comentarios(255 caracteres): <input type="text" name="comentarios" required/></p>
                <p>Propuestas(255 caracteres):<input type="text" name="propuestas" required/></p>
                <p>Valoración: 0<input type="radio" name="valoracion" value=0 required>
                1<input type="radio" name="valoracion" value=1>
                2<input type="radio" name="valoracion" value=2>
                3<input type="radio" name="valoracion" value=3>
                4<input type="radio" name="valoracion" value=4>
                5<input type="radio" name="valoracion" value=5>
                6<input type="radio" name="valoracion" value=6>
                7<input type="radio" name="valoracion" value=7>
                8<input type="radio" name="valoracion" value=8>
                9<input type="radio" name="valoracion" value=9>
                10<input type="radio" name="valoracion" value=10></p>

                <input type="submit" value="Modificar datos" />
        </form>
        <?php
        include_once 'BaseDatos.php';
        if (count($_POST) > 0) {
            $basedatos = new BaseDatos();
            $basedatos->modificarDatos(
                $_POST['id'],
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['email'],
                $_POST['telefono'],
                $_POST['edad'],
                $_POST['sexo'],
                $_POST['nivel'],
                $_POST['tiempo'],
                $_POST['correcto'],
                $_POST['comentarios'],
                $_POST['propuestas'],
                $_POST['valoracion']
            );
            }
        ?>
    </section>

</body>
</html>