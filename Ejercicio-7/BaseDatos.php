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
        $this->database = "BaseDatosRPG";
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
        $cadenaSQL = "CREATE DATABASE IF NOT EXISTS BaseDatosRPG COLLATE utf8_spanish_ci";
        if ($this->db->query($cadenaSQL) === true) {
            echo "<p>Base de datos BaseDatosRPG creada con éxito</p>";
        } else {
            echo "<p>ERROR en la creación de la Base de Datos BaseDatos</p>";
            exit();
        }
        $this->desconectar();
    }

    public function crearTabla()
    {
        $this->conectar();
        //Tabla Enemigos
        $crearTabla = "CREATE TABLE IF NOT EXISTS Enemigos(id INT NOT NULL AUTO_INCREMENT,
                        nombre  VARCHAR(40) NOT NULL,
                        zona VARCHAR(40) NOT NULL,
                        PRIMARY KEY (id))";
        if ($this->db->query($crearTabla) === true) {
            echo "<p>Tabla Enemigos creada con éxito </p>";
        } else {
            echo "<p>ERROR en la creación de la tabla Enemigos</p>";
            exit();
        }

        //Tabla Objetos-
        $crearTabla = "CREATE TABLE IF NOT EXISTS Objetos(id INT NOT NULL AUTO_INCREMENT,
                        nombre  VARCHAR(40) NOT NULL,
                        tipo VARCHAR(40) NOT NULL,
                        obtenido BOOLEAN NOT NULL, 
                        PRIMARY KEY (id))";
        if ($this->db->query($crearTabla) === true) {
            echo "<p>Tabla Objetos creada con éxito </p>";
        } else {
            echo "<p>ERROR en la creación de la tabla Objetos</p>";
            exit();
        }

        //Tabla Drops
        $crearTabla = "CREATE TABLE IF NOT EXISTS Drops(
                        idEnemigo INT NOT NULL ,
                        idObjeto INT NOT NULL ,
                        porcentaje  INT NOT NULL,  
                        PRIMARY KEY (idEnemigo,idObjeto),
                        FOREIGN KEY (idEnemigo) REFERENCES Enemigos(id),
                        FOREIGN KEY (idObjeto) REFERENCES Objetos(id))";
        if ($this->db->query($crearTabla) === true) {
            echo "<p>Tabla Drops creada con éxito </p>";
        } else {
            echo "<p>ERROR en la creación de la tabla Drops</p>";
            exit();
        }


        $this->desconectar();
    }

    public function añadirEnemigo($nombre,$zona)
    {
            $this->conectar();
            $consultaPre = $this->db->prepare("INSERT INTO Enemigos (nombre, zona) VALUES (?,?)");   
        
            //añado los parámetros de la variable Predefinida $_POST
            $consultaPre->bind_param(
                'ss',
                $nombre, 
                $zona
            );    

            //ejecuto la sentencia
            $consultaPre->execute();

            //muestro los resultados
            $ultid = $this->db->insert_id;
            echo "ID del enemigo creado: " . $ultid;
            //cierro la base de datos
            $consultaPre->close();
            $this->desconectar();
    }



    public function añadirDrop($nombre,$objeto,$porcentaje)
    {
            $this->conectar();
            $consultaPre = $this->db->prepare("INSERT INTO Drops (idEnemigo, idObjeto, porcentaje) SELECT e.id, o.id, ? FROM enemigos e, objetos o WHERE e.nombre=? and o.nombre=?");   
        
            //añado los parámetros de la variable Predefinida $_POST
            $consultaPre->bind_param(
                'iss',
                $porcentaje,
                $nombre, 
                $objeto
            );    

            //ejecuto la sentencia
            $consultaPre->execute();

            //muestro los resultados
            echo "<p>Filas añadidas: " . $consultaPre->affected_rows . "</p>";
            //cierro la base de datos
            $consultaPre->close();
            $this->desconectar();
    }



    public function añadirObjeto($nombre,$tipo)
    {
            $this->conectar();
            $consultaPre = $this->db->prepare("INSERT INTO Objetos (nombre, tipo, obtenido) VALUES (?,?,0)");   
        
            //añado los parámetros de la variable Predefinida $_POST
            $consultaPre->bind_param(
                'ss',
                $nombre, 
                $tipo
            );    

            //ejecuto la sentencia
            $consultaPre->execute();

            //muestro los resultados
            $ultid = $this->db->insert_id;
            echo "ID del objeto añadido:" . $ultid;
            //cierro la base de datos
            $consultaPre->close();
            $this->desconectar();
    }

    public function insertarDrop($idEnemigo, $idObjeto, $porcentaje)
    {
        $this->conectar();
            $consultaPre = $this->db->prepare("INSERT INTO Drops(idEnemigo, idObjeto,porcentaje) VALUES (?,?,?)");   
        
            //añado los parámetros de la variable Predefinida $_POST
            $consultaPre->bind_param(
                'iii',
                $idEnemigo, 
                $idObjeto,
                $porcentaje 
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


    public function obtenerObjetos(){
        $this->conectar();
         // preparao la consulta
        $consultaPre = $this->db->prepare("SELECT nombre FROM objetos WHERE obtenido = 0");   

         //ejecuto la consulta
        $consultaPre->execute();

         //obtengo los resultados
        $resultado = $consultaPre->get_result();
        

        while($data = mysqli_fetch_array($resultado))
        {
            echo "<option value='". $data['nombre'] ."'>" .$data['nombre'] ."</option>";  
        }	
         // cierro la consulta y la base de datos
        $consultaPre->close();
        $this->desconectar();

    }


    public function marcarObtenido($nombre){

        $this->conectar();
        // preparao la consulta
       $consultaPre = $this->db->prepare("UPDATE objetos SET obtenido=1 WHERE nombre=?");   
       
        // obtengo los parámetros de la variable predefinida $_POST
       $consultaPre->bind_param('s', $nombre);    
        
       //ejecuto la sentencia
       $consultaPre->execute();

        //muestro los resultados
        echo "<p>Filas modificadas: " .
        $consultaPre->affected_rows . "</p>";
        //cierro la base de datos
        $consultaPre->close();
       $this->desconectar();
       header("Location: Ejercicio7.php");
    }


    public function obtenerTipos(){
        $this->conectar();
         // preparao la consulta
        $consultaPre = $this->db->prepare("SELECT DISTINCT tipo FROM objetos");   

         //ejecuto la consulta
        $consultaPre->execute();

         //obtengo los resultados
        $resultado = $consultaPre->get_result();
        

        while($data = mysqli_fetch_array($resultado))
        {
            echo "<option value='". $data['tipo'] ."'>" .$data['tipo'] ."</option>";  
        }	
         // cierro la consulta y la base de datos
        $consultaPre->close();
        $this->desconectar();
    }

    public function obtenerZonas(){
        $this->conectar();
         // preparao la consulta
        $consultaPre = $this->db->prepare("SELECT DISTINCT zona FROM enemigos");   

         //ejecuto la consulta
        $consultaPre->execute();

         //obtengo los resultados
        $resultado = $consultaPre->get_result();
        

        while($data = mysqli_fetch_array($resultado))
        {
            echo "<option value='". $data['zona'] ."'>" .$data['zona'] ."</option>";  
        }	
         // cierro la consulta y la base de datos
        $consultaPre->close();
        $this->desconectar();
    }


    public function obtenerEnemigos(){
        $this->conectar();
         // preparao la consulta
        $consultaPre = $this->db->prepare("SELECT DISTINCT nombre FROM enemigos");   

         //ejecuto la consulta
        $consultaPre->execute();

         //obtengo los resultados
        $resultado = $consultaPre->get_result();
        

        while($data = mysqli_fetch_array($resultado))
        {
            echo "<option value='". $data['nombre'] ."'>" .$data['nombre'] ."</option>";  
        }	
         // cierro la consulta y la base de datos
        $consultaPre->close();
        $this->desconectar();
    }

    public function buscarObjetosPorEnemigo($nombre)
    {
        $this->conectar();
         // preparao la consulta
        $consultaPre = $this->db->prepare("SELECT o.nombre as nombreobjeto, o.tipo, o.obtenido, d.porcentaje ,e.zona FROM enemigos e, drops d, objetos o where o.id = d.idObjeto and d.idEnemigo = e.id and e.nombre = ?");   
        
         // obtengo los parámetros de la variable predefinida $_POST
        $consultaPre->bind_param('s', $nombre);    

         //ejecuto la consulta
        $consultaPre->execute();

         //obtengo los resultados
        $resultado = $consultaPre->get_result();

         //verifico los resultados
        if ($resultado->num_rows > 0) {
             // Mostrar los datos en un lista
            while ($row = $resultado->fetch_assoc()) {
                echo "<p>Nombre Objeto: " . $row['nombreobjeto'] . " | Obtenido: " . $row['obtenido'] . " | Zona: " . $row['zona'] . " | Porcentaje de Drop: " . $row['porcentaje'] . "%</p>";
            }

        } else {
            echo "Sin resultados";
        }
        
         // cierro la consulta y la base de datos
        $consultaPre->close();
        $this->desconectar();
    }

    
    public function buscarObjetosPorZona($zona)
    {
        $this->conectar();
         // preparao la consulta
        $consultaPre = $this->db->prepare("SELECT o.nombre as nombreobjeto, o.tipo, o.obtenido, e.nombre,d.porcentaje FROM enemigos e, drops d, objetos o where o.id = d.idObjeto and d.idEnemigo = e.id and e.zona = ?");   
        
         // obtengo los parámetros de la variable predefinida $_POST
        $consultaPre->bind_param('s', $zona);    

         //ejecuto la consulta
        $consultaPre->execute();

         //obtengo los resultados
        $resultado = $consultaPre->get_result();

         //verifico los resultados
        if ($resultado->num_rows > 0) {
             // Mostrar los datos en un lista
            while ($row = $resultado->fetch_assoc()) {
                echo "<p>Nombre Objeto: " . $row['nombreobjeto'] . " | Obtenido: " . $row['obtenido'] . " | Nombre Enemigo: " . $row['nombre'] . " | Porcentaje de Drop: " . $row['porcentaje'] . "%</p>";
            }

        } else {
            echo "Sin resultados";
        }
        
         // cierro la consulta y la base de datos
        $consultaPre->close();
        $this->desconectar();
    }


    public function exportarEnemigos(){
        
        $filename = "enemigos.csv";


        $this->conectar();

        $query = mysqli_query($this->db, 'select * from enemigos');

        if ($query->num_rows > 0) {

            $delimiter = ";";
     
            $f = fopen('php://memory', 'w'); 
            while ($row = $query->fetch_assoc()) {

                $lineData = array(
                    $row['id'],$row['nombre'],$row['zona']
                );
                fputcsv($f, $lineData, $delimiter);
            }
        } else
                echo "No hay datos en la tabla";
        fseek($f, SEEK_SET);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        fpassthru($f);

        $this->desconectar();
        exit();
    }

    public function exportarDrops(){
        $filename = "drops.csv";
        $this->conectar();

        $query = mysqli_query($this->db, 'select * from drops');

        if ($query->num_rows > 0) {

            $delimiter = ";";
     
            $f = fopen('php://memory', 'w'); 
            while ($row = $query->fetch_assoc()) {

                $lineData = array(
                    $row['idEnemigo'],$row['idObjeto'],$row['porcentaje']
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
        exit();
    }

    public function exportarObjetos(){
        $filename = "objetos.csv";
        $this->conectar();

        $query = mysqli_query($this->db, 'select * from objetos');

        if ($query->num_rows > 0) {

            $delimiter = ";";
     
            $f = fopen('php://memory', 'w'); 
            while ($row = $query->fetch_assoc()) {

                $lineData = array(
                    $row['id'],$row['nombre'],$row['tipo'],$row['obtenido']
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
        exit();
    }

    public function cargarEnemigos($fileName)
    {
        $this->conectar();
        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ";")) !== false) {
            if($column[0]!=null){
            $sqlInsert = "INSERT into enemigos
                   values ($column[0],'$column[1]','$column[2]')";
            $result = mysqli_query($this->db, $sqlInsert);
            }
        }
            if (!empty($sqlInsert)) {
                echo "<p>Hecho</p>";
                echo "<p>Se han importado los datos</p>";
            } else {
                echo "<p>Error</p>";
                echo "<p>Hubo un problema importando los datos</p>";
            }
        $this->desconectar();
    }

    
    public function cargarObjetos($fileName)
    {
        $this->conectar();
        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ";")) !== false) {
            if($column[0]!=null){
            $sqlInsert = "INSERT into objetos
                   values ($column[0],'$column[1]','$column[2]',$column[3])";
            $result = mysqli_query($this->db, $sqlInsert);
            }
        }
            if (!empty($sqlInsert)) {
                echo "<p>Hecho</p>";
                echo "<p>Se han importado los datos</p>";
            } else {
                echo "<p>Error</p>";
                echo "<p>Hubo un problema importando los datos</p>";
            }
        $this->desconectar();
    }

    public function cargarDrops($fileName)
    {
        $this->conectar();
        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ";")) !== false) {
            if($column[0]!=null){
            $sqlInsert = "INSERT into drops
                   values ($column[0],$column[1],$column[2])";
            $result = mysqli_query($this->db, $sqlInsert);
            }
        }
            if (!empty($sqlInsert)) {
                echo "<p>Hecho</p>";
                echo "<p>Se han importado los datos</p>";
            } else {
                echo "<p>Error</p>";
                echo "<p>Hubo un problema importando los datos</p>";
            }
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