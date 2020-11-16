<?php
    include("../conexion.php");

    $fechaIni =  $_SESSION['fechIn'];
    $fechaSal =  $_SESSION['fechOut'];
    $lista    =  $_SESSION['lista'];
    
    $items = explode("-", $fechaIni);
    $dia=$items[2];
    $mes=$items[1];
    $año=$items[0];
    
    switch ($mes) {
        case '01':
            $m="Enero";
            break;
        case '02':
            $m="Febrero";
            break;
        case '03':
            $m="Marzo";
            break;
        case '04':
            $m="Abril";
            break;
        case '05':
            $m="Mayo";
            break;
        case '06':
            $m="Junio";
            break;
         case '07':
            $m="Julio";
            break;
        case '08':
             $m="Agosto";
            break;        
        case '09':
            $m="Septiembre";
            break;
        case '10':
            $m="Octubre";
            break;
        case '11':
            $m="Noviembre";
            break;
        case '12':
            $m="Diciembre";
            break;
    }
    
    $fechaInicio =$dia . " de " . $m . " del " . $año;
    
    $items = explode("-", $fechaSal);
    $dia=$items[2];
    $mes=$items[1];
    $año=$items[0];
    
    switch ($mes) {
        case '01':
            $m="Enero";
            break;
        case '02':
            $m="Febrero";
            break;
        case '03':
            $m="Marzo";
            break;
        case '04':
            $m="Abril";
            break;
        case '05':
            $m="Mayo";
            break;
        case '06':
            $m="Junio";
            break;
         case '07':
            $m="Julio";
            break;
        case '08':
             $m="Agosto";
            break;        
        case '09':
            $m="Septiembre";
            break;
        case '10':
            $m="Octubre";
            break;
        case '11':
            $m="Noviembre";
            break;
        case '12':
            $m="Diciembre";
            break;
    }
    
    $fechaFin =$dia . " de " . $m . " del " . $año;
    
    $queryDatosList = "SELECT O.id_orden, C.nom_cliente, O.tipo_servicio, O.desc_herramienta, O.fech_entrada, U.name_user, O.status_orden FROM tab_orden AS O
    JOIN tab_cliente AS C
    ON O.id_cliente = C.id_cliente
    JOIN tab_users AS U
    ON O.code_user = U.code_user
    WHERE O.status_orden = 'ENTREGADA' AND (O.fech_entrada BETWEEN '".$fechaIni."' AND '".$fechaSal."');"; 
    $rsDatosList = mysqli_query($con, $queryDatosList) or die ("Error de consulta"); 
    
    echo'
    <html>
      <head>
        <title> Centro de Servicio MFA | Reporte</title>
        <link rel="icon" href="http://localhost/CentroServicio/assets/img/Logo/MFA.ico" />
        <link rel="stylesheet" href="http://localhost/CentroServicio/assets/controler/reportes/styles.css">
      </head>
        <body>
        <div class="row header"  style="height: 2.5rem;">
        <img src="http://localhost/CentroServicio/assets/img/Logo/logo.png" />
        </div>  
        <div class="container-fluid">
        <h1 class="display-4 text-center"><strong>MAYOREO FERRETERO ATLAS S.A. DE C.V.</strong><br>
        Centro de servicio</h1>
            <br>
            <h1 class="display-2 text-center"><strong>REPORTE DE TIPO DE PAGO</strong></h1>
            <div class="row" style="height: 4.5rem;">
              <div class="col-3">
                <p class="display-2"><b>Tipo de pago:</b><br>'.$lista.'</p>
              </div>
              <div class="col-9 offset-3 text-right">
                <p class="display-2"><b>Fecha:</b><br>
                   '.$fechaInicio.' al '.$fechaFin.'</p>
              </div>
            </div>
                <div class="row" style="height: 6rem;">
                            <table class="table table-borderless table-striped table-sm"  width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                    <tr>
                                        <th>Folio</th>
                                        <th>Cliente</th>
                                        <th>Servicio</th>
                                        <th>Herramienta</th>
                                        <th>Fecha </th>
                                        <th>Recepción </th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>';

                                $i=0;
                                while($DatosList = mysqli_fetch_array($rsDatosList)){
                                    $folio=$DatosList['id_orden'];
                                      if(strlen($folio)==1){
                                        $folio="0000".$folio;
                                      }else if(strlen($folio)==2){
                                        $folio="000".$folio;
                                      }else if(strlen($folio)==3){
                                        $folio="00".$folio;
                                      }else if(strlen($folio)==4){
                                        $folio="0".$folio;
                                      }
                                    $item[$i]['id_orden']=$folio;
                                    $item[$i]['nom_cliente']=$DatosList['nom_cliente'];
                                    $item[$i]['tipo_servicio']=$DatosList['tipo_servicio'];
                                    $item[$i]['desc_herramienta']=$DatosList['desc_herramienta'];
                                    $item[$i]['fech_entrada']=$DatosList['fech_entrada'];
                                    $item[$i]['name_user']=$DatosList['name_user'];
                                    $item[$i]['status_orden']=$DatosList['status_orden'];
                                   
                                  echo '
                                    <tr>
                                        <td>'.$item[$i]['id_orden'].'</td>
                                        <td>'.$item[$i]['nom_cliente'].'</td>
                                        <td>'.$item[$i]['tipo_servicio'].'</td>
                                        <td>'.$item[$i]['desc_herramienta'].'</td>
                                        <td>'.$item[$i]['fech_entrada'].'</td>
                                        <td>'.$item[$i]['name_user'].'</td>
                                        <td>'.$item[$i]['status_orden'].'</td>
                                    </tr> ';
                                    $i++;
                                    } 
echo '
                                </tbody>
                            </table>
                    </div>  
            </div>  
        </body>
    </html>
    ';

?>
