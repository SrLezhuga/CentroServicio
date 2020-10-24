<!DOCTYPE html>
<html lang="es">
	<head>
	
	<!--<link rel="stylesheet"  href="stylesheet.css" href="stylesheet.css" />	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	-->
	<title> APOA</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
	<meta name="stylesheet" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap-responsive.css">
	<link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css">

	<script src='scriptPrincipal.js'></script>

	<style type="text/css"> 
  
  body
{
  background-image: url('../img/.jpg');
  font-family:"Helvetica",Arial;
  background-repeat: no-repeat;
  background-size: cover;
}
.container
 {
 
 text-align:center;
}

#cabecera
{
 width:1170px;
 height:110px;
 }
 #footer
 {
 	background-color:#D9DAD9;
 }

#consulta-clave 
    {
         overflow:scroll;
         height:300px;
         
    }



  </style>
	</head>
	

	
	<body>
<?php
	
	include("../../conec.php");
	$obj=new conect;
	if($obj->conectar()== TRUE)
	{
	session_start();
	$periodo=$_SESSION['id_periodo'];	
	if(isset($_SESSION['usuario'])and $_SESSION['estado'] == 'autenticado' and $_SESSION['tipo_usuario']=='1')
	{
	echo "
    <div class='modal fade' id='myModal' role='dialog'>
              <div class='modal-dialog'>
                <!-- Modal content-->
    
               
                  </div>
                  <div class='modal-body'>
                    
                <legend >Bienvenido $_SESSION[usuario] </legend>
                
                
                
                
                  </div>
            
                                </div>";


  $sql="SELECT SUM(Tpresupuestal) a FROM techodepto where id_periodo=$periodo";
  $resultado=mysql_query($sql);
  $res=mysql_fetch_array($resultado);
  
  
  $peri="select *from periodos where id_periodo='$periodo'";
      $peri1=mysql_query($peri);
	  $peri2=mysql_fetch_array($peri1);
	  
	  
	}							
    else{
    	$obj->desconectar();
		header("location:../../index.php");  
	}
}
	?>
<br>
	<div class="container">
		

			<div class="row-fluid">
				<div class="span12" >
					<img src="../../img/cabecera.png"  id="cabecera"> 
			</div>
			</div>

		<div class="row-fluid">
			<div class="span12">
  			

				<div class="navbar ">

					<div class="navbar-inner">
					<div class="container-fluid">

				 	<a href="index2.php" class="brand"> <img src="../../img/ITFC__2.gif" alt="curso" class="img-rounded" width="37"/> A.POA</a>

							<ul class="nav pull-right">
								<li><a href="../../index-reportes.php">Home</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">About</a></li>
								<li class="divider-vertical"></li>
							    <li>
							    	
							    	<?php 
										if(isset($_SESSION['usuario'])and $_SESSION['estado'] == 'autenticado' and $_SESSION['tipo_usuario']=='1')
										{
											
											echo "<a href='../../cerrar.php'>Log-out</a>";
										}
									else
										{
						


											echo "<a href='#myModal' data-toggle='modal' data-target='#myModal'>Log-in</a>";
										}
						           ?>


							    </li>
							</ul>
				
					  </div>
					  </div>
     		 </div>


		</div>
		</div>
	

			<div class="row-fluid">
				<div class="span12">
				<!-- ESPACIO PARA PONER ALGO ARRIBA DEL INSERTAR-->

				
							
												      

							 <?php
    
include_once("../../conec.php");
$obj=new Conect;

if($obj->conectar()==true)
{
    
    
 
  $uno="select * from _vw_reporte_departamentos where id_periodo=$periodo";
  $dos=mysql_query($uno);
    ?>

  <div id="consulta-clave"><table class='table table-bordered table-striped table-hover table-condensed'>
    <tr class='success'>
    <td width='10'>Num Depa</td>
    <td>Departamento</td>
    <td>Enero</td>
    <td>Febrero</td>
    <td>Marzo</td>
    <td>Abril</td>
    <td>Mayo</td>
    <td>Junio</td>
    <td>Julio</td>
    <td>Agosto</td>
    <td>Septiembre</td>
     <td>Octubre</td>
    <td>Noviembre</td>
    <td>Diciembre</td>
    <td>Total</td>

    </tr>
    
    

    <?php

while($tres=mysql_fetch_array($dos))
{
	echo"<tr>
<td>$tres[id_depa]</td>
<td>$tres[departamento]</td>
<td>$tres[enerototal]</td>
<td>$tres[febrerototal]</td>
<td>$tres[marzototal]</td>
<td>$tres[abriltotal]</td>
<td>$tres[mayototal]</td>
<td>$tres[juniototal]</td>
<td>$tres[juliototal]</td>
<td>$tres[agostototal]</td>
<td>$tres[septiembretotal]</td>
<td>$tres[octubretotal]</td>
<td>$tres[noviembretotal]</td>
<td>$tres[diciembretotal]</td>
";
$suma=$suma+$tres['enerototal']+
$tres['febrerototal']+
$tres['marzototal']+
$tres['abriltotal']+
$tres['mayototal']+
$tres['juniototal']+
$tres['juliototal']+
$tres['agostototal']+
$tres['septiembretotal']+
$tres['octubretotal']+
$tres['noviembretotal']+
$tres['diciembretotal'];
echo "<td>$suma</td>
</tr>";
$total=$total+$suma;
$suma=0;
}

echo "</table> ";

}




?>

</div>
<h4 class=text-info>El total del techo presupuestal es de <?php echo "$".$res['a']; ?></h4>
<h4 class=text-success>El total de los departamentos es de <?php echo "$".$total; ?></h4>
			</div>
			</div>
<br>
			<div class="row-fluid"  >
				<div class="span12" id="footer">
					<address>
						<br>
					<?php 
					$uno="select * from instituciones";
  					$dos=mysql_query($uno);
  					while($tres=mysql_fetch_array($dos))
  					{		
  							echo "
							<strong>$tres[Institucion]</strong>
							<br>$tres[Direccion]<br>
							<abbr title='C.P'> Cod. Postal: </abbr>$tres[CP]
							<abbr title='Telefono'> Telefono: </abbr>$tres[Telefono]";
					}
					$obj->desconectar();
					?>	
					</address>
				</div>
			</div>
		

<br>

 
<script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
	

     <script>





    </script>


	

	</body>
</html>

