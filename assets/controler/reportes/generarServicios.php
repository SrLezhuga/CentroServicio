<?php
    include("../conexion.php");  
    
    $queryDatosList = "SELECT * FROM tab_servicio"; 
    $rsDatosList = mysqli_query($con, $queryDatosList) or die ("Error de consulta"); 
    
    $querySumList = "SELECT count(id_servicio) FROM tab_servicio"; 
    $rsSumList = mysqli_query($con, $querySumList) or die ("Error de consulta"); 
    $SumList = mysqli_fetch_array($rsSumList);

    $dia=date("d");
    $mes=date("m"); 
    $año=date("Y"); 
    
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
    
    $fecha =$dia . " de " . $m . " del " . $año;

    echo'
    <html>
      <head>
        <title> Centro de Servicio MFA | Reporte</title>
        <link rel="icon" href="http://192.168.0.98/CentroServicio/assets/img/Logo/MFA.ico" />
        <link rel="stylesheet" href="http://192.168.0.98/CentroServicio/assets/controler/reportes/styles.css">
      </head>
        <body>
            <div class="row header"  style="height: 5.5rem;">
            <img src="http://192.168.0.98/CentroServicio/assets/img/Logo/logo.png" />
                
            </div>  
            <div class="container-fluid">
            <h1 class="display-4 text-center"><strong>MAYOREO FERRETERO ATLAS S.A. DE C.V.</strong><br>
            Centro de servicio</h1>
                <br>
                <h1 class="display-2 text-center"><strong>REPORTE DE SERVICIOS</strong></h1>
                <div class="row" style="height: 4.5rem;">
                  <div class="col-3">
                    <p class="display-2"><b>Total de servicios:</b><br>'.$SumList[0].' servicios.</p>
                  </div>
                  <div class="col-9 offset-3 text-right">
                    <p class="display-2"><b>Fecha:</b><br>
                       '.$fecha.'</p>
                  </div>
                </div>
                <div class="row" style="height: 6rem;">
                            <table class="table table-borderless table-sm table-striped"  width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Descripción</th>
                                        <th>Costo</th>
                                    </tr>
                                </thead>
                                <tbody>';

                                $i=0;
                                while($DatosList = mysqli_fetch_array($rsDatosList)){
                                    $item[$i]['cod_servicio']=$DatosList['cod_servicio'];
                                    $item[$i]['desc_servicio']=$DatosList['desc_servicio'];
                                    $item[$i]['costo_servicio']=$DatosList['costo_servicio'];

                                  echo '
                                    <tr>
                                        <td>'.$item[$i]['cod_servicio'].'</td>
                                        <td>'.$item[$i]['desc_servicio'].'</td>
                                        <td>$ '.$item[$i]['costo_servicio'].'.00</td>
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
