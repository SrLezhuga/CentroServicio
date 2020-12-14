<?php
    include("../conexion.php");  
    
    $queryDatosList = "SELECT * FROM tab_refaccion"; 
    $rsDatosList = mysqli_query($con, $queryDatosList) or die ("Error de consulta"); 
    
    $querySumList = "SELECT sum(cant_refaccion), sum(cant_refaccion*costo_refaccion) FROM tab_refaccion"; 
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
                <h1 class="display-2 text-center"><strong>REPORTE DE REFACCIONES</strong></h1>
                <div class="row" style="height: 4.5rem;">
                  <div class="col-3">
                    <p class="display-2"><b>Total de refacciones:<br>
                       Coste total refacciones:</b></p>
                  </div>
                  <div class="col-3 offset-3 ">
                    <p class="display-2">'.$SumList[0].' partes/piezas.<br>
                       $ '.$SumList[1].'</p>
                  </div>
                  <div class="col-6 offset-6 text-right">
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
                                        <th>Marca</th>
                                        <th>Cantidad</th>
                                        <th>Unidad</th>
                                        <th>Costo</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>';

                                $i=0;
                                while($DatosList = mysqli_fetch_array($rsDatosList)){
                                    $item[$i]['cod_refaccion']=$DatosList['cod_refaccion'];
                                    $item[$i]['desc_refaccion']=$DatosList['desc_refaccion'];
                                    $item[$i]['marca_refaccion']=$DatosList['marca_refaccion'];
                                    $item[$i]['cant_refaccion']=$DatosList['cant_refaccion'];
                                    $item[$i]['unidad_refaccion']=$DatosList['unidad_refaccion'];
                                    $item[$i]['costo_refaccion']=$DatosList['costo_refaccion'];
                                    $total=$item[$i]['cant_refaccion']*$item[$i]['costo_refaccion'];
                                    
                                  echo '
                                    <tr>
                                        <td>'.$item[$i]['cod_refaccion'].'</td>
                                        <td>'.$item[$i]['desc_refaccion'].'</td>
                                        <td>'.$item[$i]['marca_refaccion'].'</td>
                                        <td>'.$item[$i]['cant_refaccion'].'</td>
                                        <td>'.$item[$i]['unidad_refaccion'].'</td>
                                        <td>$ '.$item[$i]['costo_refaccion'].'</td>
                                        <td>$ '.$total.'</td>
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
