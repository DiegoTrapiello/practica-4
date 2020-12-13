<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name=viewport content="width=device-width, initial-scale=1">
<title>CalculadoraCientifica</title>
<link rel="stylesheet" href="CalculadoraCientifica.css"/>
</head>

<?php 

session_start();

if (isset($_SESSION['calculadoraCientifica'])) {
    $calculadoraC = $_SESSION["calculadoraCientifica"];
} else {
    $calculadoraC = new CalculadoraCientifica();
    $_SESSION['calculadoraCientifica'] = $calculadoraC;
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

public function evaluar(){
    if (count($_POST) > 0) {
        if (isset($_POST['botonmrc'])) $this->mrc();
        if (isset($_POST['botonmmenos'])) $this->mMenos();
        if (isset($_POST['botonmmas'])) $this->mMas();
        if (isset($_POST['botondividir'])) $this->division();
        if (isset($_POST['boton7'])) $this->digitos(7);
        if (isset($_POST['boton8'])) $this->digitos(8);
        if (isset($_POST['boton9'])) $this->digitos(9);
        if (isset($_POST['botonmultiplicar'])) $this->multiplicacion();
        if (isset($_POST['boton4'])) $this->digitos(4);
        if (isset($_POST['boton5'])) $this->digitos(5);
        if (isset($_POST['boton6'])) $this->digitos(6);
        if (isset($_POST['botonmenos'])) $this->resta();
        if (isset($_POST['boton1'])) $this->digitos(1);
        if (isset($_POST['boton2'])) $this->digitos(2);
        if (isset($_POST['boton3'])) $this->digitos(3);
        if (isset($_POST['botonmas'])) $this->suma();
        if (isset($_POST['boton0'])) $this->digitos(0);
        if (isset($_POST['botonpunto'])) $this->punto();
        if (isset($_POST['botonc'])) $this->borrar();
        if (isset($_POST['botonigual'])) $this->igual();
    }
}
}

class CalculadoraCientifica extends Calculadora{

    public function __construct(){
        parent::__construct();
       }


       public function sen(){
        try{
        $this->expresion = sin(eval("return $this->expresion ;")); 
      //$this->expresion = eval("return $this->expresion ;"); 
        }
        catch(Error $e){
            $this->expresion = "Error";
        }
        catch (Exception $e) {
            $this->expresion = "Error";
        }   
       }

       public function cos(){
        try{
        $this->expresion = cos(eval("return $this->expresion ;")); 
        }
        catch(Error $e){
            $this->expresion = "Error";
        }
        catch (Exception $e) {
            $this->expresion = "Error";
        }   
       }

       public function tan(){
        try{
        $this->expresion = tan(eval("return $this->expresion ;"));                  
        }
        catch(Error $e){
            $this->expresion = "Error";
        }
        catch (Exception $e) {
            $this->expresion = "Error";
        }   
       }


       public function arcsen(){
        try{
        $this->expresion = asin(eval("return $this->expresion ;"));
        }
        catch(Error $e){
            $this->expresion = "Error";
        }
        catch (Exception $e) {
            $this->expresion = "Error";
        }    
       }

       public function arccos(){
        try{
        $this->expresion = acos(eval("return $this->expresion ;")); 
        }
        catch(Error $e){
            $this->expresion = "Error";
        }
        catch (Exception $e) {
            $this->expresion = "Error";
        }   
       }

       public function arctan(){
        try{
        $this->expresion = atan(eval("return $this->expresion ;")); 
        }
        catch(Error $e){
            $this->expresion = "Error";
        }
        catch (Exception $e) {
            $this->expresion = "Error";
        }   
       }

       public function exp(){
        try{
            $this->expresion = exp(eval("return $this->expresion ;")); 
            }
            catch(Error $e){
                $this->expresion = "Error";
            }
            catch (Exception $e) {
                $this->expresion = "Error";
            } 
       }

       
       public function log(){
        try{
            $this->expresion = log(eval("return $this->expresion ;")); 
            }
            catch(Error $e){
                $this->expresion = "Error";
            }
            catch (Exception $e) {
                $this->expresion = "Error";
            } 
       }

       public function cuadrado(){
        try{
            $this->expresion = pow(eval("return $this->expresion ;"),2); 
            }
            catch(Error $e){
                $this->expresion = "Error";
            }
            catch (Exception $e) {
                $this->expresion = "Error";
            } 
       }

       public function raizCuadrada(){
        try{
            $this->expresion = sqrt(eval("return $this->expresion ;")); 
            }
            catch(Error $e){
                $this->expresion = "Error";
            }
            catch (Exception $e) {
                $this->expresion = "Error";
            } 
       }


       public function elevado(){
        $this->expresion .= '**';
       }
    }


    if (count($_POST) > 0) {
        if (isset($_POST['botonmrc'])) $calculadoraC->mrc();
        if (isset($_POST['botonmmenos'])) $calculadoraC->mMenos();
        if (isset($_POST['botonmmas'])) $calculadoraC->mMas();
        if (isset($_POST['botondividir'])) $calculadoraC->division();
        if (isset($_POST['boton7'])) $calculadoraC->digitos(7);
        if (isset($_POST['boton8'])) $calculadoraC->digitos(8);
        if (isset($_POST['boton9'])) $calculadoraC->digitos(9);
        if (isset($_POST['botonmultiplicar'])) $calculadoraC->multiplicacion();
        if (isset($_POST['boton4'])) $calculadoraC->digitos(4);
        if (isset($_POST['boton5'])) $calculadoraC->digitos(5);
        if (isset($_POST['boton6'])) $calculadoraC->digitos(6);
        if (isset($_POST['botonmenos'])) $calculadoraC->resta();
        if (isset($_POST['boton1'])) $calculadoraC->digitos(1);
        if (isset($_POST['boton2'])) $calculadoraC->digitos(2);
        if (isset($_POST['boton3'])) $calculadoraC->digitos(3);
        if (isset($_POST['botonmas'])) $calculadoraC->suma();
        if (isset($_POST['boton0'])) $calculadoraC->digitos(0);
        if (isset($_POST['botonpunto'])) $calculadoraC->punto();
        if (isset($_POST['botonc'])) $calculadoraC->borrar();
        if (isset($_POST['botonigual'])) $calculadoraC->igual();

        //Operaciones nuevas
        if (isset($_POST['botonsen'])) $calculadoraC->sen();
        if (isset($_POST['botoncos'])) $calculadoraC->cos();
        if (isset($_POST['botontan'])) $calculadoraC->tan();
        if (isset($_POST['botonarcsen'])) $calculadoraC->arcsen();
        if (isset($_POST['botonarccos'])) $calculadoraC->arccos();
        if (isset($_POST['botonarctan'])) $calculadoraC->arctan();
        if (isset($_POST['botonexponencial'])) $calculadoraC->exp();
        if (isset($_POST['botonlog'])) $calculadoraC->log();
        if (isset($_POST['botoncuadrado'])) $calculadoraC->cuadrado();
        if (isset($_POST['botonraizCuadrada'])) $calculadoraC->raizCuadrada();
        if (isset($_POST['botonelevado'])) $calculadoraC->elevado();
}
?>
<body>
<h1>Calculadora Científica</h1>
<p>
        <img style="border:0;width:88px;height:31px"
            src="https://jigsaw.w3.org/css-validator/images/vcss"
            alt="¡CSS Válido!" />

            <img style="border:0;width:88px;height:31px"
            src="https://jigsaw.w3.org/css-validator/images/vcss-blue"
            alt="¡CSS Válido!" />
</p>
<main>
<form action="#" method='post' name='botones'>
    <input type='text' id='expresion' title='Pantalla de la calculadora' disabled value="<?php echo $calculadoraC->mostrar(); ?>"/>
    <div class="grid-botones">
        <!--- Primera fila de botones-->
        <input type ="submit" class='button' value ="sen" name='botonsen' />
        <input type ="submit" class='button' value ="cos" name='botoncos' />
        <input type ="submit" class='button' value ="tan" name='botontan' />
        <input type ="submit" class='button' value ="arcsen" name='botonarcsen' />
        <input type ="submit" class='button' value ="arccos" name='botonarccos' />
        <input type ="submit" class='button' value ="arctan" name='botonarctan' />
        <!--- Segunda fila de botones-->
        
        <input type ="submit" class='button' value ="exp" name='botonexponencial' />
        <input type ="submit" class='button' value ="log" name='botonlog' />
        <input type ="submit" class='button' value ="x^2" name='botoncuadrado' />
        <input type ="submit" class='button' value ="√" name='botonraizCuadrada' />
        <input type ="submit" class='button' value ="x^y" name='botonelevado' />
        <input type ="submit" class='button' value ="C" name='botonc' />
        
        <!--- Tercera fila de botones-->
        <input type = 'submit' class='button' name='botonmmas' value='m+' />
        <input type = 'submit' class='button' name='botonmmenos' value='m-' />
        <input type = 'submit' class='button' name='boton7' value='7'/>
        <input type = 'submit' class='button' name='boton8' value='8' />
        <input type = 'submit' class='button' name='boton9' value='9' />
        <input type = 'submit' class='button' name='botonmrc' value='mrc' />
        <!--- Cuarta fila de botones-->
        <input type = 'submit' class='button' name='botonmultiplicar' value='*' />
        <input type = 'submit' class='button' name='botondividir' value='/' />
        <input type = 'submit' class='button' name='boton4' value='4' />
        <input type = 'submit' class='button' name='boton5' value='5' />
        <input type = 'submit' class='button' name='boton6' value='6'/>
        <input type = 'submit' class='button' name='botonpunto' value='.' />
        <!--- Quinta fila de botones-->
        <input type = 'submit' class='button' name='botonmenos' value='-' />
        <input type = 'submit' class='button' name='botonmas' value='+' />
        <input type = 'submit' class='button' name='boton1' value='1' />
        <input type = 'submit' class='button' name='boton2' value='2'/>
        <input type = 'submit' class='button' name='boton3' value='3' />
        <input type = 'submit' class='button' name='botonigual' value='=' />
        
        <div class="boton-cero"><input type = 'submit' class='button' name='boton0' value='0' /></div>
    </div>
</form>
</main> 
</body>
</html>