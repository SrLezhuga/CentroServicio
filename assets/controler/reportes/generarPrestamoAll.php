<?php
    include("../conexion.php"); 

    $lista   = $_SESSION['RepPrestamo'];
    $Inicio  = $_SESSION['RepInicio'];
    $Fin     = $_SESSION['RepFin'];
    
    $items = explode("-", $Inicio);
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
    
    $items = explode("-", $Fin);
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

    $queryDatosList = "SELECT * FROM tab_prestamo"; 
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
            <h1 class="display-2 text-center"><strong>REPORTE DE PRESTAMOS</strong></h1>
            <div class="row" style="height: 4.5rem;">
              <div class="col-3">
                <p class="display-2"><b>Status del prestamo:</b><br>'.$lista.'</p>
              </div>
              <div class="col-9 offset-3 text-right">
                <p class="display-2"><b>Fecha:</b><br>
                   '.$fechaInicio.' al '.$fechaFin.'</p>
              </div>
            </div>
                <div class="row" style="height: 6rem;">
                            <table class="table table-borderless table-sm table-striped"  width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Descripción</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>';

                                $i=0;
                                while($DatosList = mysqli_fetch_array($rsDatosList)){
                                    $item[$i]['cod_herramienta']=$DatosList['cod_herramienta'];
                                    $item[$i]['desc_prestamo']=$DatosList['desc_prestamo'];
                                    $item[$i]['cliente_prestamo']=$DatosList['cliente_prestamo'];
                                    $item[$i]['fech_salida_prestamo']=$DatosList['fech_salida_prestamo'];
                                    $item[$i]['status_prestamo']=$DatosList['status_prestamo'];

                                  echo '
                                    <tr>
                                        <td>'.$item[$i]['cod_herramienta'].'</td>
                                        <td>'.$item[$i]['desc_prestamo'].'</td>
                                        <td>'.$item[$i]['cliente_prestamo'].'</td>
                                        <td>'.$item[$i]['fech_salida_prestamo'].'</td>
                                        <td>'.$item[$i]['status_prestamo'].'</td>
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
