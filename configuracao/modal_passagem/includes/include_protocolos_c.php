<?php

    $consulta_pc="SELECT DISTINCT ap.DS_ALERTA_PROTOCOLO
                FROM dbamv.PW_CASO_PROTOCOLO cp
                INNER JOIN dbamv.PW_ALERTA_PROTOCOLO ap
                ON ap.CD_ALERTA_PROTOCOLO = cp.CD_ALERTA_PROTOCOLO

                WHERE CD_PACIENTE = $id 
                and cp.dt_fim is null";



    $result_consulta_pc = oci_parse($conn_ora,$consulta_pc);
    if(@$var_atd != ''){
        oci_execute(@$result_consulta_pc);
    }
    $contado_while = 0;



?>

<div class='col-md-12' style='text-align:left'>

    Protocolos Clínicos Abertos:
    <textarea class='textarea'rows="4" style="width: 100%;" name='frm_aepc' readonly><?php 
    
    if($var_atd == null){  
        echo 'Paciente sem atendimento'; 
    }else{
        while(@$row_pc = oci_fetch_array($result_consulta_pc)){
        
        if ($contado_while==0){

            echo @$row_pc['DS_ALERTA_PROTOCOLO'];
    
        } else {

                echo ' || ' . @$row_pc['DS_ALERTA_PROTOCOLO'];

        }

        $contado_while = $contado_while + 1;
        
        }
    }
    ?>
    </textarea>

</div>