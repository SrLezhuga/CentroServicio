<?php
    include("../conexion.php");

    $fechaIni =  $_SESSION['fechIn'];
    $fechaSal =  $_SESSION['fechOut'];
    $lista    =  $_SESSION['lista'];
    $total=0;
    
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
    
    $queryDatosList = "SELECT O.id_orden, U.name_user FROM tab_orden AS O 
    JOIN tab_users AS U 
    ON O.code_user = U.code_user 
    WHERE O.tipo_servicio = 'Presupuesto' 
    AND U.sucursal_user = '".$lista."' 
    AND (O.status_orden = 'REPARADA' OR O.status_orden = 'ENTREGADA')
    AND (O.fech_entrada BETWEEN '".$fechaIni."' AND '".$fechaSal."');"; 
    $rsDatosList = mysqli_query($con, $queryDatosList) or die ("Error de consulta"); 
    
    echo'
    <html>
      <head>
        <title> Centro de Servicio MFA | Reporte</title>
        <link rel="icon" href="http://192.168.0.98/CentroServicio/assets/img/Logo/MFA.ico" />
        <link rel="stylesheet" href="http://192.168.0.98/CentroServicio/assets/controler/reportes/styles.css">
      </head>
        <body>
        <div class="row header"  style="height: 2.5rem;">
        <img src="http://192.168.0.98/CentroServicio/assets/img/Logo/logo.png" />
        </div>  
        <div class="container-fluid">
        <h1 class="display-4 text-center"><strong>MAYOREO FERRETERO ATLAS S.A. DE C.V.</strong><br>
        Centro de servicio</h1>
            <br>
            <h1 class="display-2 text-center"><strong>REPORTE DE COMISIONES</strong></h1>
            <div class="row" style="height: 4.5rem;">
              <div class="col-3">
                <p class="display-2"><b>Comisiones por sucursal:</b><br>'.$lista.'</p>
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
                                        <th>Empleado</th>
                                        <th>Costo Refacción</th>
                                        <th>Costo Servicio</th>
                                        <th>Total </th>
                                    </tr>
                                </thead>
                                <tbody>';

                                $i=0;
                                while($DatosList = mysqli_fetch_array($rsDatosList)){

                                    $querySumRef = "SELECT SUM(costo_refaccion) AS SumRef FROM tab_ordenrefaccion WHERE id_orden = ".$DatosList['id_orden']; 
                                    $rsSumRef = mysqli_query($con, $querySumRef) or die ("Error de consulta");  
                                    $sumRef = mysqli_fetch_array($rsSumRef);

                                    $querySumSer = "SELECT SUM(costo_servicio) AS SumSer FROM tab_ordenservicio WHERE id_orden = ".$DatosList['id_orden']; 
                                    $rsSumSer = mysqli_query($con, $querySumSer) or die ("Error de consulta");  
                                    $sumSer = mysqli_fetch_array($rsSumSer);

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

                                      if ($sumRef['SumRef']==null) {
                                        $item[$i]['SumRef']=0;
                                      }else {
                                        $item[$i]['SumRef']=$sumRef['SumRef'];
                                      }
                                      if ($sumSer['SumSer']==null) {
                                        $item[$i]['SumSer']=0;
                                      }else {
                                        $item[$i]['SumSer']=$sumSer['SumSer'];
                                      }
                                    $item[$i]['id_orden']=$folio;
                                    $item[$i]['name_user']=$DatosList['name_user'];
                                    $item[$i]['subtotal']=$sumRef['SumRef']+$sumSer['SumSer'];

                                  echo '
                                    <tr>
                                        <td>'.$item[$i]['id_orden'].'</td>
                                        <td>'.$item[$i]['name_user'].'</td>
                                        <td>$ '.$item[$i]['SumRef'].'</td>
                                        <td>$ '.$item[$i]['SumSer'].'</td>
                                        <td>$ '.$item[$i]['subtotal'].'</td>
                                    </tr> ';
                                    $total= $total+$item[$i]['subtotal'];
                                    $i++;
                                    } 
echo '                              
                                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total:</td>
                                    <td>$ '.$total.'</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>  
            </div>  
        </body>
    </html>
    ';

?>
