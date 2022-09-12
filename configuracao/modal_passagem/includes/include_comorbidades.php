<?php

    

    $consulta_comorbi = "SELECT hr.DS_RESPOSTA
                         FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR hr
                         WHERE hr.DS_IDENTIFICADOR = 'SC_EEPIA_HPP_1'
                         AND hr.DS_RESPOSTA IS NOT NULL
                         AND hr.CD_ATENDIMENTO = $var_atd 
                         AND hr.DH_IMPRESSO IN (SELECT MAX(hr_aux.DH_IMPRESSO) AS MAX_DH_IMPRESSO
                                                 FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR hr_aux
                                                 WHERE hr_aux.DS_IDENTIFICADOR = 'SC_EEPIA_HPP_1'
                                                 AND hr_aux.DS_RESPOSTA IS NOT NULL
                                                 AND hr_aux.CD_ATENDIMENTO = $var_atd)";

    $result_consulta_comorbi = oci_parse($conn_ora,$consulta_comorbi);
    if(@$var_atd != ''){
    oci_execute(@$result_consulta_comorbi);
    }
    $contador_while = 0;

?>


<div class='col-md-12' style='text-align:left'>

    Comorbidades:
    <textarea class='textarea' rows="4" style="width: 100%;" name='frm_comorbidades' readonly><?php 
    if($var_atd == null){ 
        echo 'Paciente sem atendimento';
    }else{
    
        while (@$row_comorbi = oci_fetch_array($result_consulta_comorbi)){


            if ($contador_while == 0){

                echo @$row_comorbi['DS_RESPOSTA'];

            }else{

                echo '||' . @$row_comorbi['DS_RESPOSTA'];
            }

            $contador_while = $contador_while + 1;

        }
    }

    ?>
    
    </textarea>

</div>