<?php

$consulta_pc="SELECT ap.DS_ALERTA_PROTOCOLO
              FROM dbamv.PW_CASO_PROTOCOLO cp
              INNER JOIN dbamv.PW_ALERTA_PROTOCOLO ap
              ON ap.CD_ALERTA_PROTOCOLO = cp.CD_ALERTA_PROTOCOLO
              AND cp.TP_ETAPA IN (1,2,3)
              WHERE CD_PACIENTE = $id ";



$result_consulta_pc = oci_parse($conn_ora,$consulta_pc);

oci_execute($result_consulta_pc);

$contado_while = 0;



?>

<div class='col-md-12' style='text-align:left'>

    Protocolos Clínicos Abertos:
    <textarea class='textarea'rows="4" style="width: 100%;" name='frm_aepc' readonly><?php while(@$row_pc = oci_fetch_array($result_consulta_pc)){
    
    if ($contado_while==0){

        echo $row_pc['DS_ALERTA_PROTOCOLO'];
  
   } else {

        echo ' || ' . $row_pc['DS_ALERTA_PROTOCOLO'];

   }

   $contado_while = $contado_while + 1;
    
    }
    ?>
    </textarea>

</div>