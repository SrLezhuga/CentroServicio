<?php
    include("../conexion.php");

    $Orden =  $_SESSION['fromOrdenList'];
    
    
    $queryDatosList = "SELECT * FROM tab_cliente ORDER BY nom_cliente " . $Orden; 
    $rsDatosList = mysqli_query($con, $queryDatosList) or die ("Error de consulta"); 
    
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
                <h1 class="display-2 text-center"><strong>REPORTE DE CLIENTES</strong></h1>
                <div class="row" style="height: 6rem;">
                            <table class="table table-borderless table-sm table-striped"  width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Cliente</th>
                                        <th>RFC</th>
                                        <th>Dirección</th>
                                        <th>Municipio</th>
                                        <th>C.P.</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                    </tr>
                                </thead>
                                <tbody>';

                                $i=0;
                                while($DatosList = mysqli_fetch_array($rsDatosList)){
                                    $item[$i]['nom_cliente']=$DatosList['nom_cliente'];
                                    $item[$i]['rfc_cliente']=$DatosList['rfc_cliente'];
                                    $item[$i]['dir_cliente']=$DatosList['dir_cliente'];
                                    $item[$i]['mun_cliente']=$DatosList['mun_cliente'];
                                    $item[$i]['cp_cliente']=$DatosList['cp_cliente'];
                                    $item[$i]['tel_cliente']=$DatosList['tel_cliente'];
                                    $item[$i]['mail_cliente']=$DatosList['mail_cliente'];
                                   
                                  echo '
                                    <tr>
                                        <td>'.$item[$i]['nom_cliente'].'</td>
                                        <td>'.$item[$i]['rfc_cliente'].'</td>
                                        <td>'.$item[$i]['dir_cliente'].'</td>
                                        <td>'.$item[$i]['mun_cliente'].'</td>
                                        <td>'.$item[$i]['cp_cliente'].'</td>
                                        <td>'.$item[$i]['tel_cliente'].'</td>
                                        <td>'.$item[$i]['mail_cliente'].'</td>
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
