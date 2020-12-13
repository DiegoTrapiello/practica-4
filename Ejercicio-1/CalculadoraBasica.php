<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>CalculadoraBasica</title>
    <link rel="stylesheet" href="CalculadoraBasica.css" />
</head>


<?php 

session_start();

if (isset($_SESSION['calculadora'])) {
    $calculadora = $_SESSION["calculadora"];
} else {
    $calculadora = new Calculadora();
    $_SESSION['calculadora'] = $calculadora;
}

class Calculadora{

   protected $expresion;
   protected $memoria;

   public function __construct(){
    $this->expresion = '';
    $this->memoria=array();
   }

   public function digitos($valor){
        $this->expresion .= $valor;
   }

   public function suma(){
    $this->expresion .= '+';
   }

  public function resta(){
    $this->expresion .= '-';
 }

 public function multiplicacion(){
    $this->expresion .= '*';
 }

 public function division(){
    $this->expresion .= '/';
 }


 public function igual(){
    try {
        $this->expresion = eval("return $this->expresion ;"); 
    }
    catch(Error $e){
        $this->expresion = "Error";
    }
    catch (Exception $e) {
        $this->expresion = "Error";
    }   
 }

 public function borrar(){
    $this->expresion = '';
 }

 public function punto(){
    $this->expresion .=  '.';
 }

 public function mMenos(){
    $this->expresion .= array_pop($this->memoria);
 }

 public function mMas(){
    try {
        $temp = eval("return $this->expresion ;"); 
        if(!is_nan($temp)){
            array_push($this->memoria,$temp);
            $this->expresion =''; 
        }
    }
    catch(Error $e){
        $this->expresion = "Error";
    }
    catch (Exception $e) {
        $this->expresion = "Error";
    }  
 }

 public function mrc(){
    $this->memoria= array();
   }

 public function mostrar(){
      return $this->expresion;
 }

}


if (count($_POST) > 0) {
    if (isset($_POST['botonmrc'])) $calculadora->mrc();
    if (isset($_POST['botonmmenos'])) $calculadora->mMenos();
    if (isset($_POST['botonmmas'])) $calculadora->mMas();
    if (isset($_POST['botondividir'])) $calculadora->division();
    if (isset($_POST['boton7'])) $calculadora->digitos(7);
    if (isset($_POST['boton8'])) $calculadora->digitos(8);
    if (isset($_POST['boton9'])) $calculadora->digitos(9);
    if (isset($_POST['botonmultiplicar'])) $calculadora->multiplicacion();
    if (isset($_POST['boton4'])) $calculadora->digitos(4);
    if (isset($_POST['boton5'])) $calculadora->digitos(5);
    if (isset($_POST['boton6'])) $calculadora->digitos(6);
    if (isset($_POST['botonmenos'])) $calculadora->resta();
    if (isset($_POST['boton1'])) $calculadora->digitos(1);
    if (isset($_POST['boton2'])) $calculadora->digitos(2);
    if (isset($_POST['boton3'])) $calculadora->digitos(3);
    if (isset($_POST['botonmas'])) $calculadora->suma();
    if (isset($_POST['boton0'])) $calculadora->digitos(0);
    if (isset($_POST['botonpunto'])) $calculadora->punto();
    if (isset($_POST['botonc'])) $calculadora->borrar();
    if (isset($_POST['botonigual'])) $calculadora->igual();
    }

?>

<body>
<h1>Calculadora básica</h1>
<p>
    <a>
            <img style='border:0;width:88px;height:31px' src='https://jigsaw.w3.org/css-validator/images/vcss'
                alt='¡CSS Válido!' />

            <img style='border:0;width:88px;height:31px' src='https://jigsaw.w3.org/css-validator/images/vcss-blue'
                alt='¡CSS Válido!' />
        </a>
</p>

<main>
    <form action="#" method='post' name='botones'>
    <input type='text' id='expresion' title='Pantalla de la calculadora' disabled value="<?php echo $calculadora->mostrar(); ?>"/>
    <div class="grid-botones">
        <!--- Primera fila de botones-->
        <input type = 'submit' class='button' name='botonmrc' value='mrc' />
         <input type = 'submit' class='button' name='botonmmenos' value='m-' />
         <input type = 'submit' class='button' name='botonmmas' value='m+' />
         <input type = 'submit' class='button' name='botondividir' value='/' />

        <!--- Segunda fila de botones-->
         <input type = 'submit' class='button' name='boton7' value='7'/>
         <input type = 'submit' class='button' name='boton8' value='8' />
         <input type = 'submit' class='button' name='boton9' value='9' />
         <input type = 'submit' class='button' name='botonmultiplicar' value='*' />

        <!--- Tercera fila de botones-->
         <input type = 'submit' class='button' name='boton4' value='4' />
         <input type = 'submit' class='button' name='boton5' value='5' />
         <input type = 'submit' class='button' name='boton6' value='6'/>
         <input type = 'submit' class='button' name='botonmenos' value='-' />

        <!--- Cuarta fila de botones-->
         <input type = 'submit' class='button' name='boton1' value='1' />
         <input type = 'submit' class='button' name='boton2' value='2'/>
         <input type = 'submit' class='button' name='boton3' value='3' />
         <input type = 'submit' class='button' name='botonmas' value='+' />

        <!--- Quinta fila de botones-->
         <input type = 'submit' class='button' name='boton0' value='0' />
         <input type = 'submit' class='button' name='botonpunto' value='.' />
         <input type = 'submit' class='button' name='botonc' value='C' />
        <input type = 'submit' class='button' name='botonigual' value='=' />
        </div>
    </form>
</main>
</body>
</html>