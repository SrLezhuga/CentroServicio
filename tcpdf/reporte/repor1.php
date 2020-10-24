<?php
include("../../conexion/conec.php");
session_start();
	$db=new Conexion();
    $db->set_charset("utf8");
    //$id=$_GET['id'];
    $id='2422';
    $consu="SELECT tab_refacciones.tab_orden_reparo_folio, tab_refacciones.modelo,  tab_refacciones.descripcion, tab_refacciones.cantidad  FROM tab_refacciones INNER JOIN tab_orden_reparo on tab_orden_reparo.folio = '$id' where tab_refacciones.tab_orden_reparo_folio= tab_orden_reparo.folio";
    
    $repor2=$db->query($consu);
      
	
    $repor="SELECT * FROM tab_orden_reparo where  folio= '$id'";
    $repor1=$db->query($repor);
    $tres=$repor1->fetch_array();
     
     $resul="SELECT sum(costo_real) as total FROM `tab_orden_reparo` WHERE folio='$id'";
     
     $res=$db->query($resul);
     $total=$res->fetch_array($res);
	 
	 $final=$tres['importe']+$total['total']+$IVA;

?>

<html>
<head>
<title>Centro De Servicio MFA</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
	<meta name="stylesheet" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap-responsive.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/styles.css">

</head>
<style>

td,th {
  padding: 15px;
  text-align: center;
  top: 15px;
}

.td2{
  background-color:#EEEEEE;

}
</style>

<body class="container" >


<header class="clearfix">
    <main >

    <h1 align="center">Centro de Servicio</h1>
    <hr>
    <p>
    <table border="1" >
        <tr>
        <center>
          <th class="desc" height="20" class="td2"><b>CLIENTE:</b></th>
          <td class="desc" height="20"><?php echo $tres['nombre_cliente']?></td>
          <td class="desc" height="20" class="td2"><b>FOLIO: </b><?php echo $tres['folio'] ?></td>
          <td class="desc" height="20" ><b>Fecha: </b><?php echo $tres['fecha_entrada']?></td>
        </center>
        </tr>
        <tr>
          <th class="desc" height="20" class="td2"><b>DIRECCION:</b></th>
          <td class="desc" height="20"><?php echo $tres['domicilio'] ?></td>
          <th class="desc" height="20" class="td2"><b>TELEFONO:</b></th>
          <td class="desc" height="20"><?php echo $tres['telefono'] ?></td>
        </tr>
       
        <tr>
          <th class="td2" height="20"><b>RECIBIO:</b></th>
          <td class="desc" height="20"><?php echo $tres['via_recepcion'] ?></td>
          <th class="td2" height="20"><b>HERRAMIENTA:</b></th>
        <td class="desc" height="20"><?php echo $tres['nombre_maquina'] ?></td>
        </tr>
        <tr>
          <th class="td2" height="20"><b>TIPO DE SERVICIO:</b></th>
          <td class="desc" height="20"><?php echo $tres['tipo_servicio'] ?></td>
          <th colspan="2" class="td2" height="20"><b>MODELO</b></th>
        </tr>
        <tr>
        <td colspan="2" class="desc" height="20"><?php echo $tres['marca'] ?></td>
          <td colspan="2" class="desc" height="20"><?php echo $tres['modelo']?></td>
        </tr>
    </table>
      <p>
    
      
      <table border="1">
        <tr>
          <td colspan="2" height="20"><b>DIAGNOSTICO PREVIO:</b><?php echo $tres['diagnostico_p'] ?></td>
        </tr>
        <tr>
          <td colspan="2" class="td2" height="20"><b>REFACCIONES UTILIZADAS</b></td>
        </tr>
        <tr>
          <td width="150" height="20"><b>Cantidad</b></td>
          <td width="150" height="20"><b>Modelo</b></td>
          <td width="330" height="20"><b>Descripcion</b></td>
                      
        </tr>';
	 <?php 	
      if(mysqli_num_rows($repor2)>0){
        while($dos=$repor2->fetch_array()) 
        {?>

        	<tr>
            <td width="150" class="desc" height="20"><?php echo $dos['cantidad'] ?></td>
            <td width="150" class="desc" height="20"><?php echo $dos['modelo'] ?></td>
            <td width="330" class="desc" height="20"><?php echo $dos['descripcion'] ?></td>
          </tr>
        <?php }
	    }
      else
      {
     ?>
        
        <tr>
        <td width="630" colspan="2" class="desc" height="15"> No se han agregado refacciones para el folio <?php echo$tres['folio']?>
        </td>
        </tr>
        
      <?php } ?>
          
    
         </table>
        <p><p>
          <table >
            <tr>
            <td><h4>COMPROBANTE REALIZADO:</h4></td>
            <td class="total"><h4>COSTO POR REVISION: <?php echo $tres['costo_estimado']?></h4></td>
            </tr>
			      <tr>
            <td class="total"><h4 > <?php echo $tres['tipo_repara'] ." ". $tres['Num_repara']?></h4></td>
            <td class="total"><h4 >COSTO REAL: <?php echo $tres['costo_real']?>  </h4></td>
            </tr>
            <tr>
                <td colspan="3" class="desc" >
                  <div id="notices" >
                      <div class="autoriza">RECIBO DE CONFORMIDAD</div>
                      <div class="notice">_______________________</div>
                      <div class="autoriza">NOMBRE Y FIRMA</div>
                  </div>
                </td>
            </tr>
            

          </table> 
        <p>
        <p>
      
    <table >
     <tr>
     <td> 
     <center>
     <div  >
        <div ><b>Tecnico</b></div>
        <div class="notice">_______________________</div>
        <div><b>Nombre y Firma</b></div>
        </div>
     </center>
     </td>
     <td>
     <center>
      <div id="notices" >
                      <div ><b>Recibi la herramienta Funcionando Correctamente</b></div>
                      <div class="notice">_______________________</div>
                      <div ><b>Cliente</b></div>
                  </div></td>
                  </center>
     </tr> 
</table>

    

<br><hr>
<p>

<table border="1">

  <tr>
    <th class="td2"><b>FOLIO DE LA ORDEN</b></th>
    <td class="desc" height="15">'.$tres['folio'].'</td>
    <th colspan="2" class="td2" ><b>TALONARIO PARA EL CLIENTE</b></th>
  </tr>
  <tr>
    <th class="td2"><b>Recibido por:</b></th>
    <td></td>
    <th height="15" class="td2"><b>Fecha de recepcion en CSA</b></th>
    <td height="15">'.$tres['fecha_entrada'].'</td>
  </tr>
  <tr>
  
  <td colspan="2" height="15" >Mayoreo Ferretero Atlas,S.A. de C.V
  </td>
  <td colspan="2"  height="15" >csa@mayoreoferreteroatlas.com</td>
  </tr>
</table>
</main>

<p>
<p>

<p align="justify"><B>Por favor conserve este comprobante ya que de lo contrario no se podrá hacer entrega de su producto; Le recordamos recoger su producto dentro de los 30 días naturales después de haber
sido reparado, pasado 90 días naturales, mayoreo ferretero atlas no se hace responsable del producto. Cualquier revision que no sea garantia, causara honorarios.
</p>
<p align="justify"><B>
IMPORTANTE!!! Sin excepcion de personal la reposicion de este comprobante tendra un costo de $100.00 MN. por gastos de ejecucion.
</p>

</body>
</html>