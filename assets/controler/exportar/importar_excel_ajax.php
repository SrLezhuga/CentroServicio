<?php
        if (is_array($_FILES['archivoexcel']) && count($_FILES['archivoexcel'])> 0 ) {
            require_once '../../vendor/PHPExcel/Classes/PHPExcel.php';
            require_once '../conexion.php';

            $tmpfname = $_FILES['archivoexcel']['tmp_name'];
            $leerExcel = PHPExcel_IOFactory::createReaderForFile($tmpfname);

            $excelobj = $leerExcel->load($tmpfname);

            $hoja = $excelobj->getSheet(0);
            $filas = $hoja->getHighestRow();

            echo '
            <div class="table">
                <table class="table table-hover thead-dark table-sm" id="tabla_detalle" width="100%"
                    cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Marca</th>
                            <th>Existencia</th>
                            <th>Unidad</th>
                            <th>Costo</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_tabla_detalle">';
                    
                    for ($row=2; $row <=$filas ; $row++) { 
                        $Codigo = $hoja->getCell('A'.$row)->getValue();
                        $Descripcion = $hoja->getCell('B'.$row)->getValue();
                        $DescripcionRem1 = str_replace("'","-",$Descripcion);
                        $DescripcionRem2 = str_replace('"',"In",$DescripcionRem1);
                        $DescripcionRem3 = str_replace("&","and",$DescripcionRem2);
                        $DescripcionEx = str_replace(",", "", $DescripcionRem3);
                        $Marca = $hoja->getCell('C'.$row)->getValue();
                        $Cantidad = $hoja->getCell('D'.$row)->getValue();
                        $Unidad = $hoja->getCell('E'.$row)->getValue();
                        $UnidadEx = str_replace(",", "", $Unidad);
                        $Costo = $hoja->getCell('F'.$row)->getValue();
                        $CostoEx = str_replace(",", "", $Costo);

                        $query = "SELECT COUNT(*) AS contador, id_refaccion AS id, cod_refaccion AS codigo, desc_refaccion AS descripcion, marca_refaccion AS marca, cant_refaccion AS cantidad, unidad_refaccion AS unidad, costo_refaccion AS costo FROM tab_refaccion WHERE cod_refaccion = '".$Codigo."'";
                        $resultado = $con->query($query);
                        $respuesta = $resultado->fetch_assoc();
                        if ($respuesta['contador']=="0") {
                            $Id="NUEVO";
                            if ($Codigo == "") {
                                # code...
                            }else{
                            echo '<tr class="table-success">';
                            echo '<td>'.$Id.'</td>';
                            echo '<td>'.$Codigo.'</td>'; 
                            echo '<td>'.$DescripcionEx.'</td>';        
                            echo '<td>'.$Marca.'</td>'; 
                            echo '<td>'.$Cantidad.'</td>'; 
                            echo '<td>'.$UnidadEx.'</td>'; 
                            echo '<td>'.$CostoEx.'</td>'; 
                            echo '</tr>';
                            }
                        }else {
                            $Id=$respuesta['id'];
                            if ($Codigo == $respuesta['codigo'] && 
                                $DescripcionEx == $respuesta['descripcion'] && 
                                $Marca == $respuesta['marca'] && 
                                $Cantidad == $respuesta['cantidad'] && 
                                $UnidadEx == $respuesta['unidad'] && 
                                $CostoEx == "$".$respuesta['costo'] ) {
                                # code...
                            }else{
                            echo '<tr class="table-warning">';
                            echo '<td>'.$Id.'</td>';
                            echo '<td>'.$Codigo.'</td>'; 
                            echo '<td>'.$DescripcionEx.'</td>';        
                            echo '<td>'.$Marca.'</td>'; 
                            echo '<td>'.$Cantidad.'</td>'; 
                            echo '<td>'.$UnidadEx.'</td>'; 
                            echo '<td>'.$CostoEx.'</td>'; 
                            echo '</tr>';
                            }
                        }
                    }
                    echo '
                    </tbody>
                </table>
            </div>
                                    ';
        }


?>