<?php

$consulta_curativos="SELECT DISTINCT resp.DS_RESPOSTA
                     FROM dbamv.SAE_HISTORICO_ENFERMAGEM she
                     INNER JOIN dbamv.SAE_RESP_SELCND_HIST_ENFERMG sel
                     ON sel.CD_HISTORICO_ENFERMAGEM = she.CD_HISTORICO_ENFERMAGEM
                     INNER JOIN dbamv.SAE_PERGUNTA_HISTORICO_ENFERMG perg
                     ON perg.CD_PERGUNTA = sel.CD_PERGUNTA_HISTORICO
                     INNER JOIN dbamv.SAE_RESPOSTA_HISTORICO_ENFERMG resp
                     ON sel.CD_RESPOSTA_HISTORICO = resp.CD_RESPOSTA
                     WHERE sel.CD_PERGUNTA_HISTORICO IN (232, 342, 460, 336, 337)
                     AND she.CD_ATENDIMENTO = $var_atd 
                     AND TO_DATE('$var_exibir_dt','DD/MM/YYYY') = TRUNC(she.DT_INICIO)";

$result_consulta_curativos = oci_parse($conn_ora,$consulta_curativos);

oci_execute($result_consulta_curativos);

$contdor_while = 0;

?>


<div class='col-md-12' style='text-align:left'>

    Curativos/Lesões/Banhos:
    <textarea class='textarea' style="width: 100%;" name='frm_cur_le_dre' readonly><?php while (@$row_curativos = oci_fetch_array($result_consulta_curativos)){


        if ($contdor_while == 0){

            echo $row_curativos['DS_RESPOSTA'];

        }else{

            echo ' || ' . $row_curativos['DS_RESPOSTA'];
        }

        $contdor_while = $contdor_while + 1;



    }
    ?>
    </textarea>

</div>