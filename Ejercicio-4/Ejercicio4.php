<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Ejercicio 10</title>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="Ejercicio4.css" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
</head>

<?php 


$newsapi = new NewsAPI();

Class NewsAPI{

    public $apikey = '17e55a59c8msh5ebc9f8985a5b90p1b041ajsn8f5e234b533d';
    public $apihost = "bing-news-search1.p.rapidapi.com";
    public $url='https://bing-news-search1.p.rapidapi.com/news/search?q=';
    public $lang="&setLang=ES";
    public $freshness='&freshness=Day';
    public $textFormat='&textFormat=Raw';
    public $safeSearch='&safeSearch=Off';
    public $contador=0;
    public $json;


public function peticion($query){
    if($query != ''){
    $tempUrl = $this->url . $query . $this->lang . $this->freshness .$this->textFormat . $this->safeSearch;

    $opts = array(
        'http'=>array(
          'method'=>"GET",
          'header'=>"x-bingapis-sdk: true\r\n" .
                    "x-rapidapi-key:" . $this->apikey ."\r\n" .
                    "x-rapidapi-host:" . $this->apihost . "\r\n"
        )
      );
      
      $context = stream_context_create($opts);
      
      // Open the file using the HTTP headers set above
      $respuesta = file_get_contents($tempUrl, false, $context);
      $json = json_decode($respuesta);

    if($json!=null) {
        $this->json = $json;
    }
}
}

public function mostrar(){
    $cadena='';
    if($this->json != null){
      $i =1;  
      foreach($this->json->value as $item){
       $cadena.= "<h3 id=encabezadoDatos$i> Noticia $i</h3>";
       $cadena.= "<p><ul><li>" . $item->name . "</li>";
       $cadena.= "<li> <a href=\"" . $item->url . "\">Enlace de la noticia</a></li>";
       $cadena.= "<li><figure><img src=\"" . $item->image->thumbnail->contentUrl . "\"></figure></li>";
       $cadena.= "<li>" . $item->description . "</li></ul></p>";
       $i++;
    }
    }
    return $cadena;
}

}


if (count($_POST) > 0) {
    if (isset($_POST['botonbusqueda'])) $newsapi->peticion($_POST['busqueda']);
   }

?>

<body>
    <h1>Servicio Web de Noticias</h1>
    <label for="busqueda">Buscador:</label>
    <form name="form" action="#" method="post">
        <input type="text" id="busqueda" name='busqueda' required>
        <input type="submit" class="button" id="buscar" name='botonbusqueda' value="Obtener Noticias" >
    </form>
    <?php
        echo $newsapi->mostrar();
    ?>
    <footer>
        <a>
            <img style="border:0;width:88px;height:31px" src="https://jigsaw.w3.org/css-validator/images/vcss"
                alt="¡CSS Válido!" />

            <img style="border:0;width:88px;height:31px" src="https://jigsaw.w3.org/css-validator/images/vcss-blue"
                alt="¡CSS Válido!" />
        </a>
    </footer>
</body>


</html>