<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>CalculadoraBasica</title>
    <link rel="stylesheet" href="CalculadoraRPN.css" />
</head>


<?php 

session_start();

if (isset($_SESSION['calculadoraRPN'])) {
    $calculadoraRPN = $_SESSION["calculadoraRPN"];
} else {
    $calculadoraRPN = new CalculadoraRPN();
    $_SESSION['calculadoraRPN'] = $calculadoraRPN;
}

class CalculadoraRPN{

   protected $expresion;
   protected $pila;

   public function __construct(){
    $this->expresion = '';
    $this->pila=array();
   }

   public function digitos($valor){
        $this->expresion .= $valor;
   }

   public function suma(){
        if(count($this->pila)>1){
            $segundo = array_pop($this->pila);
            $primero = array_pop($this->pila);
            $resultado = $primero + $segundo;
            array_push($this->pila,$resultado);
        }

   }

  public function resta(){
    if(count($this->pila)>1){
        $segundo = array_pop($this->pila);
        $primero = array_pop($this->pila);
        $resultado = $primero - $segundo;
        array_push($this->pila,$resultado);
    }
 }

 public function multiplicacion(){
    if(count($this->pila)>1){
        $segundo = array_pop($this->pila);
        $primero = array_pop($this->pila);
        $resultado = $primero * $segundo;
        array_push($this->pila,$resultado);
    }
 }

 public function division(){
    if(count($this->pila)>1){
        $segundo = array_pop($this->pila);
        $primero = array_pop($this->pila);
        $resultado = $primero / $segundo;
        array_push($this->pila,$resultado);
    }
 }


 public function borrar(){
    $this->expresion = '';
 }

 public function punto(){
    $this->expresion .=  '.';
 }

 public function mostrar(){
      return $this->expresion;
 }


 public function enter(){
     if(strcmp ($this->expresion , '' ) !== 0 and count($this->pila)<8){
        array_push($this->pila,$this->expresion);
        $this->borrar();
     }
 }

 public function limpiarUltimo(){
    array_pop($this->pila);
}

public function limpiarMemoria(){
   $this->pila=array();
}



 public function sen(){
    if(count($this->pila)>0){
        $primero = array_pop($this->pila);
        $resultado = sin($primero);
        array_push($this->pila,$resultado);
    }
  }

  public function cos(){
    if(count($this->pila)>0){
        $primero = array_pop($this->pila);
        $resultado = cos($primero);
        array_push($this->pila,$resultado);
    }
  }

  public function tan(){
    if(count($this->pila)>0){
        $primero = array_pop($this->pila);
        $resultado = tan($primero);
        array_push($this->pila,$resultado);
    }
  }

  public function arcsen(){
    if(count($this->pila)>0){
        $primero = array_pop($this->pila);
        $resultado = asin($primero);
        array_push($this->pila,$resultado);
        $this->mostrarMemoria();
    }
  }

  public function arccos(){
    if(count($this->pila)>0){
        $primero = array_pop($this->pila);
        $resultado = acos($primero);
        array_push($this->pila,$resultado);
    }
  }

  public function arctan(){
    if(count($this->pila)>0){
        $primero = array_pop($this->pila);
        $resultado = atan($primero);
        array_push($this->pila,$resultado);
    }
  }
  public function exp(){
    if(count($this->pila)>0){
        $primero = array_pop($this->pila);
        $resultado = exp($primero);
        array_push($this->pila,$resultado);
    }
  }

  public function log(){
    if(count($this->pila)>0){
        $primero = array_pop($this->pila);
        $resultado = log($primero);
        array_push($this->pila,$resultado);
    }
   }

   public function mostrarMemoria(){
    $div='';
    $numElementos = count($this->pila);
    for ($i = $numElementos-1; $i >= 0; $i--) {
       $div.= '<p>' . $this->pila[$i] . '</p>';
   }
    return $div;
   }

}



if (count($_POST) > 0) {
    if (isset($_POST['botondividir'])) $calculadoraRPN->division();
    if (isset($_POST['boton7'])) $calculadoraRPN->digitos(7);
    if (isset($_POST['boton8'])) $calculadoraRPN->digitos(8);
    if (isset($_POST['boton9'])) $calculadoraRPN->digitos(9);
    if (isset($_POST['botonmultiplicar'])) $calculadoraRPN->multiplicacion();
    if (isset($_POST['boton4'])) $calculadoraRPN->digitos(4);
    if (isset($_POST['boton5'])) $calculadoraRPN->digitos(5);
    if (isset($_POST['boton6'])) $calculadoraRPN->digitos(6);
    if (isset($_POST['botonmenos'])) $calculadoraRPN->resta();
    if (isset($_POST['boton1'])) $calculadoraRPN->digitos(1);
    if (isset($_POST['boton2'])) $calculadoraRPN->digitos(2);
    if (isset($_POST['boton3'])) $calculadoraRPN->digitos(3);
    if (isset($_POST['botonmas'])) $calculadoraRPN->suma();
    if (isset($_POST['boton0'])) $calculadoraRPN->digitos(0);
    if (isset($_POST['botonpunto'])) $calculadoraRPN->punto();
    if (isset($_POST['botonenter'])) $calculadoraRPN->enter();

    //Operaciones nuevas
     if (isset($_POST['botonsen'])) $calculadoraRPN->sen();
     if (isset($_POST['botoncos'])) $calculadoraRPN->cos();
     if (isset($_POST['botontan'])) $calculadoraRPN->tan();
     if (isset($_POST['botonarcsen'])) $calculadoraRPN->arcsen();
     if (isset($_POST['botonarccos'])) $calculadoraRPN->arccos();
     if (isset($_POST['botonarctan'])) $calculadoraRPN->arctan();
     if (isset($_POST['botonexponencial'])) $calculadoraRPN->exp();
     if (isset($_POST['botonlog'])) $calculadoraRPN->log();
     if (isset($_POST['botonlimpiarultimo'])) $calculadoraRPN->limpiarUltimo();
     if (isset($_POST['botonlimpiarmemoria'])) $calculadoraRPN->limpiarMemoria();
     
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
    <div id="contenido"><?php echo $calculadoraRPN->mostrarMemoria();?></div>
    <input type='text' id='expresion' title='Pantalla de la calculadora' disabled value="<?php echo $calculadoraRPN->mostrar(); ?>"/>
    <div class="grid-botones">
        <!--- Primera fila de botones-->
        <input type ="submit" class='button' value ="sen" name='botonsen' />
        <input type ="submit" class='button' value ="cos" name='botoncos' />
        <input type ="submit" class='button' value ="tan" name='botontan' />
        <input type ="submit" class='button' value ="log" name='botonlog' />


        <!--- Segunda fila de botones-->
        <input type ="submit" class='button' value ="arcsen" name='botonarcsen' />
        <input type ="submit" class='button' value ="arccos" name='botonarccos' />
        <input type ="submit" class='button' value ="arctan" name='botonarctan' />
        <input type ="submit" class='button' value ="exp" name='botonexponencial' />

        <!--- Tercera fila de botones-->
         <input type = 'submit' class='button' name='botonmas' value='+' />
         <input type = 'submit' class='button' name='boton7' value='7'/>
         <input type = 'submit' class='button' name='boton8' value='8' />
         <input type = 'submit' class='button' name='boton9' value='9' />


        <!--- Cuarta fila de botones-->
         <input type = 'submit' class='button' name='botonmenos' value='-' />
         <input type = 'submit' class='button' name='boton4' value='4' />
         <input type = 'submit' class='button' name='boton5' value='5' />
         <input type = 'submit' class='button' name='boton6' value='6'/>


        <!--- Quinta fila de botones-->
        <input type = 'submit' class='button' name='botonmultiplicar' value='*' />
        <input type = 'submit' class='button' name='boton1' value='1' />
        <input type = 'submit' class='button' name='boton2' value='2'/>
        <input type = 'submit' class='button' name='boton3' value='3' />

        <!--- Sexta fila de botones-->
        <input type = 'submit' class='button' name='botondividir' value='/' />
        <input type = 'submit' class='button' name='botonpunto' value='.' />
        <input type = 'submit' class='button' name='boton0' value='0' />
        <input type = 'submit' class='button' name='botonenter' value='Enter' />


        <div class='limpiar-ultimo'><input type ="submit" class='button' value ="Limpiar ultimo"  name="botonlimpiarultimo" /></div>
        <div class="limpiar-memoria"><input type ="submit" class="button" value ="Limpiar memoria"   name="botonlimpiarmemoria"/></div>
    </div>
    </form>
</main>
</body>
</html>