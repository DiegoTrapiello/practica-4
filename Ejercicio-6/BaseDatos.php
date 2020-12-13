<?php

class BaseDatos
{

    protected $servername;
    protected $username;
    protected $password;
    protected $db;
    protected $database;

    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "DBUSER2020";
        $this->password = "DBPSWD2020";
        $this->database = "basedatos";
    }

    public function conectarGen()
    {
        $this->db = new mysqli($this->servername, $this->username, $this->password); 
        //comprobamos conexión
        if ($this->db->connect_error) {
            exit("<p>ERROR de conexión:" . $this->db->connect_error . "</p>");
        } else {
            echo "<p>Conexión establecida.</p>";
        }
    }

    public function conectar()
    {
        $this->db = new mysqli($this->servername, $this->username, $this->password, $this->database); 
        //comprobamos conexión
        if ($this->db->connect_error) {
            exit("<p>ERROR de conexión:" . $this->db->connect_error . "</p>");
        } else {
            //echo "<p>Conexión establecida.</p>";
        }
    }

    public function desconectar()
    {
        $this->db->close();
    }

    public function crearBaseDatos()
    {
        $this->conectarGen();
        $cadenaSQL = "CREATE DATABASE IF NOT EXISTS BaseDatos COLLATE utf8_spanish_ci";
        if ($this->db->query($cadenaSQL) === true) {
            echo "<p>Base de datos BaseDatos creada con éxito</p>";
        } else {
            echo "<p>ERROR en la creación de la Base de Datos BaseDatos</p>";
            exit();
        }
        $this->desconectar();
    }

    public function crearTabla()
    {
        $this->conectar();
        $crearTabla = "CREATE TABLE IF NOT EXISTS PruebasUsabilidad(id INT NOT NULL AUTO_INCREMENT,
                        nombre VARCHAR(20) NOT NULL,
                        apellidos VARCHAR(40) NOT NULL,
                        email VARCHAR(40) NOT NULL,
                        telefono INT NOT NULL,
                        edad INT NOT NULL,
                        sexo VARCHAR(10) NOT NULL,
                        nivel INT NOT NULL,
                        tiempo INT  NOT NULL,
                        correcto VARCHAR(2) NOT NULL,
                        comentarios VARCHAR(255) NOT NULL,
                        propuestas VARCHAR(255) NOT NULL,
                        valoracion INT NOT NULL,
                        PRIMARY KEY (id))";
        if ($this->db->query($crearTabla) === true) {
            echo "<p>Tabla PruebasUsabilidad creada con éxito </p>";
        } else {
            echo "<p>ERROR en la creación de la tabla PruebasUsabilidad</p>";
            exit();
        }
        $this->desconectar();
    }

    public function insertarDatos($nombre, $apellidos, $email, $telefono, $edad, $sexo, $nivel, $tiempo, $correcto, $comentarios, $propuestas, $valoracion)
    {
        if (strlen($propuestas) > 255 || strlen($comentarios) > 255)
            echo "El texto de comentarios y propuestas no puede ser de más de 255 caracteres";
        else {
            $this->conectar();
            $consultaPre = $this->db->prepare("INSERT INTO pruebasusabilidad (nombre, apellidos, email, telefono, edad, sexo, nivel,
                            tiempo,correcto,comentarios,propuestas,valoracion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");   
        
            //añado los parámetros de la variable Predefinida $_POST
            $consultaPre->bind_param(
                'sssiisiisssi',
                $nombre, 
                $apellidos, 
                $email, 
                $telefono,
                $edad,
                $sexo,
                $nivel,
                $tiempo,
                $correcto,
                $comentarios,
                $propuestas,
                $valoracion
            );    

            //ejecuto la sentencia
            $consultaPre->execute();

            //muestro los resultados
            echo "<p>Filas agregadas: " . $consultaPre->affected_rows . "</p>";
            $ultid = $this->db->insert_id;
            echo "IMPORTANTE: Guarde el ID siguiente para futuras modificaciones o consultas: ID=" . $ultid;
            //cierro la base de datos
            $consultaPre->close();
            $this->desconectar();
        }
    }

    public function buscarDatos($id)
    {
        $this->conectar();
         // preparao la consulta
        $consultaPre = $this->db->prepare("SELECT * FROM pruebasusabilidad WHERE id = ?");   
        
         // obtengo los parámetros de la variable predefinida $_POST
        $consultaPre->bind_param('i', $id);    

         //ejecuto la consulta
        $consultaPre->execute();

         //obtengo los resultados
        $resultado = $consultaPre->get_result();

         //verifico los resultados
        if ($resultado->num_rows > 0) {
             // Mostrar los datos en un lista
            echo "<p>Datos de la prueba buscada son:<br>";
            while ($row = $resultado->fetch_assoc()) {
                echo "Id: " . $id . " Nombre: " . $row['nombre'] . " Apellidos: " . $row['apellidos'] . " email: " . $row['email'] . " Teléfono: " . $row['telefono'] . " Edad: " . $row['edad'] . " Sexo: " . $row['sexo'] . " Nivel: " . $row['nivel'] .
                    "<br>Tiempo: " . $row['tiempo'] . " Correcta: " . $row['correcto'] .
                    "<br>Comentarios: " . $row['comentarios'] . "<br>Propuestas: " . $row['propuestas'] . "<br>" . "Valoración: " . $row['valoracion'] . "</p>";
            }

        } else {
            echo "Sin resultados";
        }
        
         // cierro la consulta y la base de datos
        $consultaPre->close();
        $this->desconectar();
    }

    public function modificarDatos($id, $nombre, $apellidos, $email, $telefono, $edad, $sexo, $nivel, $tiempo, $correcto, $comentarios, $propuestas, $valoracion)
    {
        $this->conectar();
         // preparao la consulta
        $consultaPre = $this->db->prepare("SELECT * FROM pruebasusabilidad WHERE id = ?");   
        
         // obtengo los parámetros de la variable predefinida $_POST
        $consultaPre->bind_param('i', $id);    

         //ejecuto la consulta
        $consultaPre->execute();

         //obtengo los resultados
        $resultado = $consultaPre->get_result();

         //verifico los resultados
        if ($resultado->num_rows > 0) {
            if (strlen($propuestas) > 255 || strlen($comentarios) > 255)
                echo "El texto de comentarios y propuestas no puede ser de más de 255 caracteres";
            else {
                $consultaPre = $this->db->prepare("UPDATE pruebasusabilidad set nombre =?, apellidos=?, email = ?, telefono = ?, edad=?, sexo=?, nivel=?,
                            tiempo=?,correcto=?,comentarios=?,propuestas=?,valoracion=? where id=?");   
        
            //añado los parámetros de la variable Predefinida $_POST
                $consultaPre->bind_param(
                    'sssiisiisssii',
                    $nombre, 
                    $apellidos, 
                    $email, 
                    $telefono,
                    $edad,
                    $sexo,
                    $nivel,
                    $tiempo,
                    $correcto,
                    $comentarios,
                    $propuestas,
                    $valoracion,
                    $id
                );    

            //ejecuto la sentencia
                $consultaPre->execute();

            //muestro los resultados
                echo "<p>Filas modificadas: " . $consultaPre->affected_rows . "</p>";
            //cierro la base de datos
                $consultaPre->close();
            }
        } else
            echo "No hay ningún usuarion con esa ID";
        $this->desconectar();
    }

    public function borrarDatos($id)
    {
        $this->conectar();
         // preparao la consulta
        $consultaPre = $this->db->prepare("SELECT * FROM pruebasusabilidad WHERE id = ?");   
        
         // obtengo los parámetros de la variable predefinida $_POST
        $consultaPre->bind_param('i', $id);    

         //ejecuto la consulta
        $consultaPre->execute();

         //obtengo los resultados
        $resultado = $consultaPre->get_result();

         //verifico los resultados
        if ($resultado->num_rows > 0) {
             // Mostrar los datos en un lista
            echo "<p>Datos de la prueba buscada son:<br>";
            while ($row = $resultado->fetch_assoc()) {
                echo "Id: " . $id . " Nombre: " . $row['nombre'] . " Apellidos: " . $row['apellidos'] . " email: " . $row['email'] . " Teléfono: " . $row['telefono'] . " Edad: " . $row['edad'] . " Sexo: " . $row['sexo'] . " Nivel: " . $row['nivel'] .
                "<br>Tiempo: " . $row['tiempo'] . " Correcta: " . $row['correcto'] .
                "<br>Comentarios: " . $row['comentarios'] . "<br>Propuestas: " . $row['propuestas'] . "<br>" . "Valoración: " . $row['valoracion'] . "</p>";
            }

            $consultaPre = $this->db->prepare("DELETE FROM pruebasusabilidad WHERE id = ?");   
            
            //obtengo los parámetros de la variable almacenada
            $consultaPre->bind_param('i', $id);
            
            //ejecuto la consulta
            $consultaPre->execute();
            
            // cierro la consulta y la base de datos
            $consultaPre->close();
            echo "Se ha borrado la prueba.";
        } else {
            echo "Sin resultados";
        }
        $this->desconectar();
    }

    public function generarInforme()
    {
        $this->conectar();
        $consulta = "SELECT * FROM pruebasusabilidad";
        $resultado = mysqli_query($this->db, $consulta);
        if ($resultado->num_rows > 0) {
            $consulta = "SELECT AVG(edad),AVG(nivel),AVG(valoracion) FROM pruebasusabilidad";
            $resultado = mysqli_query($this->db, $consulta);
            $medias = mysqli_fetch_row($resultado);
            $media_edad = $medias[0];
            $media_nivel = $medias[1];
            $media_valor = $medias[2];
            $consulta = "SELECT COUNT(sexo) FROM pruebasusabilidad WHERE sexo='Hombre'";
            $numHombres = mysqli_fetch_row(mysqli_query($this->db, $consulta));
            $consulta = "SELECT COUNT(sexo) FROM pruebasusabilidad WHERE sexo='Mujer'";
            $numMujeres = mysqli_fetch_row(mysqli_query($this->db, $consulta));
            $porcentajeHombres = (float)$numHombres[0] / ((float)$numHombres[0] + (float)$numMujeres[0]) * 100;
            $porcentajeMujeres = (float)$numMujeres[0] / ((float)$numHombres[0] + (float)$numMujeres[0]) * 100;
            $consulta = "SELECT COUNT(correcto) FROM pruebasusabilidad WHERE correcto='si'";
            $correcto = mysqli_fetch_row(mysqli_query($this->db, $consulta));
            $consulta = "SELECT COUNT(correcto) FROM pruebasusabilidad WHERE correcto='no'";
            $incorrecto = mysqli_fetch_row(mysqli_query($this->db, $consulta));
            $porcentajeCorrecto = (float)$correcto[0] / ((float)$correcto[0] + (float)$incorrecto[0]) * 100;
            $consulta = "SELECT AVG(tiempo) from pruebasusabilidad";
            $resultado = mysqli_query($this->db, $consulta);
            $mediaTiempo = mysqli_fetch_row($resultado);

            echo "Edad media: " . $media_edad;
            echo "<br>Porcentaje hombres: " . $porcentajeHombres . "%";
            echo "<br>Porcentaje mujeres: " . $porcentajeMujeres . "%";
            echo "<br>Tiempo medio: " . $mediaTiempo[0] ;
            echo "<br>Porcentaje correcto: " . $porcentajeCorrecto . "%";
            echo "<br>Nivel medio: " . $media_nivel;
            echo "<br>Valoración media: " . $media_valor;
        } else
            echo "No hay datos en la tabla";
        $this->desconectar();
    }

    public function exportarArchivo()
    {
        $filename = "pruebasUsabilidad.csv";
        $this->conectar();

        $query = mysqli_query($this->db, 'select * from pruebasusabilidad');

        if ($query->num_rows > 0) {

            $delimiter = ";";
     
            $f = fopen('php://memory', 'w'); 
            while ($row = $query->fetch_assoc()) {

                $lineData = array(
                    $row['id'],$row['nombre'],$row['apellidos'],$row['email'],$row['telefono'],$row['edad'], $row['sexo'], $row['nivel'], $row['tiempo'],
                    $row['correcto'], $row['comentarios'], $row['propuestas'], $row['valoracion']
                );
                fputcsv($f, $lineData, $delimiter);
            }
     
            fseek($f, SEEK_SET);
     
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
     
            fpassthru($f);
        } else
            echo "No hay datos en la tabla";
        $this->desconectar();
    }

    public function cargarArchivo($file)
    {
        $this->conectar();
        $file = fopen($file['archivo']['tmp_name'], "r");

        while (($column = fgetcsv($file, 10000, ";")) !== false) {
            if($column[0]!=null){
            $sqlInsert = "INSERT into pruebasusabilidad
                   values ($column[0],'$column[1]','$column[2]','$column[3]',$column[4],$column[5],'$column[6]',$column[7],'$column[8]'
                   ,'$column[9]' ,'$column[10]' ,'$column[11]' ,$column[12])";
            $result = mysqli_query($this->db, $sqlInsert);
            }
        }
            if (!empty($sqlInsert)) {
                echo "Hecho<br>";
                echo "Se han importado los datos";
            } else {
                echo "Error<br>";
                echo "Hubo un problema importando los datos compruebe que no esté metiendo los datos en una tabla con ids iguales";
            }
        $this->desconectar();
    }

}

?>