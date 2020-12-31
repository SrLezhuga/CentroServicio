<?php
echo $tmpfname = $_POST['data'];
echo "<pre>";
var_dump($tmpfname);
echo "</pre>";

$cont=1;
$xmlDoc = simplexml_load_string($tmpfname);

echo "<pre>";
print_r($xmlDoc);
echo "</pre>";

$abuelos = $xmlDoc->children('cfdi', TRUE);

echo "<pre>";
print_r($abuelos);
echo "</pre>";

$padres = $abuelos[2]->children('cfdi', TRUE);

echo "<pre>";
print_r($padres);
echo "</pre>";

for ($i=0; $i < count($abuelos[2]) ; $i++) { 

$hijos = $padres[$i]->attributes();

echo "<pre>";
print_r($hijos);
echo "</pre>";

    
    echo 'Refacción '. $cont .'°<br>';
    echo 'Código: '.$hijos['ClaveProdServ'].'<br>';
    echo 'Descripción: '.$hijos['Descripcion'].'<br>';
    echo '$ '.$hijos['ValorUnitario'].'<br>';
    echo '<br>';
    $cont++;
}



?>