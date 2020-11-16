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
    
    switch ($lista) {
        case 'APxP':
            $orden='Aprovada pendiente por partes';
            break;
        case 'PxP':
            $orden='Pendiente por partes';
            break;
        case 'PxA':
            $orden='Pendiente por aprobar';
            break;    
        case 'Reparada':
            $orden='Ordenes reparadas';
            break; 
        case 'Cancelada':
            $orden='Ordenes canceladas';
            break; 
        case 'En espera':
            $orden='Ordenes en espera';
            break;
        case 'Entregada':
            $orden='Ordenes entregadas';
            break;
    }

    $queryDatosList = "CALL ReporteStado('".$lista."', '".$fechaIni."','".$fechaSal."');"; 
    $rsDatosList = mysqli_query($con, $queryDatosList) or die ("Error de consulta"); 
    
    echo'
    <html>
      <head>
        <title> Centro de Servicio MFA | Reporte</title>
        <link rel="icon" href="http://localhost/CentroServicio/assets/img/Logo/MFA.ico" />
      </head>
        <style>    
           
        @page { margin: 4rem 4rem 4rem 4rem; }
        .header { position: fixed; left: 0px; top: 0px; right: 0px; height: 0px; }
         *,
          *::before,
          *::after {
            box-sizing: border-box;
          }
          
          html {
            font-size: 0.7rem;
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
          }
          .display-1 {
            font-size: 0.7rem;
            font-weight: 300;
            line-height: 1.2;
          }
          .display-2 {
            font-size: 1.2rem;
          }
        .display-4 {
            font-size: 1.5rem;
            font-weight: 150;
          }
          .text-left {
            text-align: left !important;
          }
          
          .text-right {
            text-align: right !important;
          }
          
          .text-center {
            text-align: center !important;
          }
          .border {
            border: 1px solid #9E9E9E !important;
          }
          .border-info {
            border: 1px dashed  !important;
          }
          .border-out {
            border: 0px none  !important;
          }
          .row {
      display: flex;
      flex-wrap: wrap;
      margin-right: -0.75rem;
      margin-left: -0.75rem;
    }
    .no-gutters {
      margin-right: 0;
      margin-left: 0;
    }
    
    .no-gutters > .col,
    .no-gutters > [class*="col-"] {
      padding-right: 0;
      padding-left: 0;
    }
    
    .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col,
    .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm,
    .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
    .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg,
    .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl,
    .col-xl-auto {
      position: relative;
      width: 100%;
      padding-right: 0.75rem;
      padding-left: 0.75rem;
    }
    
    .col {
      flex-basis: 0;
      flex-grow: 1;
      min-width: 0;
      max-width: 100%;
    }
    .col-1 {
      flex: 0 0 8.33333%;
      max-width: 8.33333%;
    }
    
    .col-2 {
      flex: 0 0 16.66667%;
      max-width: 16.66667%;
    }
    
    .col-3 {
      flex: 0 0 25%;
      max-width: 25%;
    }
    
    .col-4 {
      flex: 0 0 33.33333%;
      max-width: 33.33333%;
    }
    
    .col-5 {
      flex: 0 0 41.66667%;
      max-width: 41.66667%;
    }
    
    .col-6 {
      flex: 0 0 50%;
      max-width: 50%;
    }
    
    .col-7 {
      flex: 0 0 58.33333%;
      max-width: 58.33333%;
    }
    
    .col-8 {
      flex: 0 0 66.66667%;
      max-width: 66.66667%;
    }
    
    .col-9 {
      flex: 0 0 75%;
      max-width: 75%;
    }
    
    .col-10 {
      flex: 0 0 83.33333%;
      max-width: 83.33333%;
    }
    
    .col-11 {
      flex: 0 0 91.66667%;
      max-width: 91.66667%;
    }
    
    .col-12 {
      flex: 0 0 100%;
      max-width: 100%;
    }
    .offset-1 {
      margin-left: 8.33333%;
    }
    
    .offset-2 {
      margin-left: 16.66667%;
    }
    
    .offset-3 {
      margin-left: 25%;
    }
    
    .offset-4 {
      margin-left: 33.33333%;
    }
    
    .offset-5 {
      margin-left: 41.66667%;
    }
    
    .offset-6 {
      margin-left: 50%;
    }
    
    .offset-7 {
      margin-left: 58.33333%;
    }
    
    .offset-8 {
      margin-left: 66.66667%;
    }
    
    .offset-9 {
      margin-left: 75%;
    }
    
    .offset-10 {
      margin-left: 83.33333%;
    }
    
    .offset-11 {
      margin-left: 91.66667%;
    }
    hr {
        color: #f8b500;
    height: px;
    border:1px dashed;
    }
    img {
        position: absolute; 
        z-index: 0; 
        opacity: 0.20; 
        filter: grayscale(1);
        margin-top: 8em;
    }
    .table {
      width: 100%;
    }
    
    .table th,
    .table td {
      padding: 0.75rem;
      vertical-align: top;
      border-top: 1px solid #9E9E9E;
    }
    
    .table-sm th,
    .table-sm td {
      padding: 0.3rem;
    }

    .table .thead-dark th {
        color: #fff;
        background-color: #5a5c69;
        border-color: #6c6e7e;
      }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .table-dark.table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(255, 255, 255, 0.05);
    }
        </style>
        <body>
        <div class="row header"  style="height: 2.5rem;">
        <img src="http://localhost/CentroServicio/assets/img/Logo/logo.png" />
        </div>  
        <div class="container-fluid">
        <h1 class="display-4 text-center"><strong>MAYOREO FERRETERO ATLAS S.A. DE C.V.</strong><br>
        Centro de servicio</h1>
            <br>
            <h1 class="display-2 text-center"><strong>REPORTE ORDENES</strong></h1>
            <div class="row" style="height: 4.5rem;">
              <div class="col-3">
                <p class="display-2"><b>Status de la orden:</b><br>'.$lista.'</p>
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
