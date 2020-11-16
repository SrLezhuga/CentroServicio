<?php
    include("../conexion.php");   
    
    $queryDatosList = "SELECT * FROM tab_users " ; 
    $rsDatosList = mysqli_query($con, $queryDatosList) or die ("Error de consulta"); 

    echo'
    <html>
      <head>
        <title> Centro de Servicio MFA | Reporte</title>
        <link rel="icon" href="http://localhost/CentroServicio/assets/img/Logo/MFA.ico" />
        <link rel="stylesheet" href="http://localhost/CentroServicio/assets/controler/reportes/styles.css">
      </head>
        <body>
            <div class="row header"  style="height: 5.5rem;">
            <img src="http://localhost/CentroServicio/assets/img/Logo/logo.png" />
                
            </div>  
            <div class="container-fluid">
            <h1 class="display-4 text-center"><strong>MAYOREO FERRETERO ATLAS S.A. DE C.V.</strong><br>
            Centro de servicio</h1>
                <br>
                <h1 class="display-2 text-center"><strong>REPORTE DE USUARIOS</strong></h1>
                <div class="row" style="height: 6rem;">
                            <table class="table table-borderless table-sm table-striped"  width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Privilegio</th>
                                    </tr>
                                </thead>
                                <tbody>';

                                $i=0;
                                while($DatosList = mysqli_fetch_array($rsDatosList)){
                                    $item[$i]['name_user']=$DatosList['name_user'];
                                    $item[$i]['nick_user']=$DatosList['nick_user'];
                                    $item[$i]['priv_user']=$DatosList['priv_user'];

                                    if ($DatosList['priv_user']=='1') {
                                      $item[$i]['priv_user']='Administrador';
                                    }elseif ($DatosList['priv_user']=='2') {
                                      $item[$i]['priv_user']='Vendedor/Mostrador';
                                    }else {
                                      $item[$i]['priv_user']='Taller/Técnico';
                                    }
                                   
                                  echo '
                                    <tr>
                                        <td>'.$item[$i]['name_user'].'</td>
                                        <td>'.$item[$i]['nick_user'].'</td>
                                        <td>'.$item[$i]['priv_user'].'</td>
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
