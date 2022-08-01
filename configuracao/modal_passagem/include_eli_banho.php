<?php

$consulta_banho="SELECT DISTINCT resp.DS_RESPOSTA
                 FROM dbamv.SAE_HISTORICO_ENFERMAGEM she
                 INNER JOIN dbamv.SAE_RESP_SELCND_HIST_ENFERMG sel
                 ON sel.CD_HISTORICO_ENFERMAGEM = she.CD_HISTORICO_ENFERMAGEM
                 INNER JOIN dbamv.SAE_PERGUNTA_HISTORICO_ENFERMG perg
                 ON perg.CD_PERGUNTA = sel.CD_PERGUNTA_HISTORICO
                 INNER JOIN dbamv.SAE_RESPOSTA_HISTORICO_ENFERMG resp
                 ON sel.CD_RESPOSTA_HISTORICO = resp.CD_RESPOSTA
                 WHERE sel.CD_PERGUNTA_HISTORICO IN (472, 367, 219)
                 AND she.CD_ATENDIMENTO = $var_atd 
                 AND TO_DATE('$var_exibir_dt','YYYY-MM-DD') = TRUNC(she.DT_INICIO)";


$result_consulta_banho = oci_parse($conn_ora,$consulta_banho);

oci_execute($result_consulta_banho);

$contado_while = 0;


?>


<div class='col-md-12' style='text-align:left'>

    Eliminação/Banho:
    <textarea class='textarea' style="width: 100%;" name='frm_eli_banho' readonly><?php while (@$row_ban = oci_fetch_array($result_consulta_banho)){

    if ($contado_while == 0){

        echo $row_ban['DS_RESPOSTA'];

    }else{

        echo ' || ' . $row_ban['DS_RESPOSTA'];
    }

    $contado_while = $contado_while + 1;


    }
    ?>
    </textarea>

</div>