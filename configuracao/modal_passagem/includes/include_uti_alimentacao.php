<?php
  
    $consulta_alimentacao = "SELECT res.*
                             FROM(SELECT 
                                  CASE 
                                  WHEN UPPER(resp.DS_RESPOSTA) = 'OUTROS' THEN 'Outros:  ' || sel.DS_RESPOSTA
                                  ELSE resp.DS_RESPOSTA
                                  END DS_RESPOSTA
                                  --SELECT *
                                  --SELECT DISTINCT sel.CD_PERGUNTA_HISTORICO, resp.DS_RESPOSTA
                                  FROM dbamv.SAE_HISTORICO_ENFERMAGEM she
                                  INNER JOIN dbamv.SAE_RESP_SELCND_HIST_ENFERMG sel
                                  ON sel.CD_HISTORICO_ENFERMAGEM = she.CD_HISTORICO_ENFERMAGEM
                                  INNER JOIN dbamv.SAE_PERGUNTA_HISTORICO_ENFERMG perg
                                  ON perg.CD_PERGUNTA = sel.CD_PERGUNTA_HISTORICO
                                  INNER JOIN dbamv.SAE_RESPOSTA_HISTORICO_ENFERMG resp
                                  ON sel.CD_RESPOSTA_HISTORICO = resp.CD_RESPOSTA
                                  WHERE she.CD_ATENDIMENTO = $var_atd
                                  AND sel.CD_PERGUNTA_HISTORICO IN (216)
                                  AND she.DT_INICIO = (SELECT MAX(sh.DT_INICIO)
                                                          FROM dbamv.SAE_HISTORICO_ENFERMAGEM sh
                                                          INNER JOIN dbamv.SAE_RESP_SELCND_HIST_ENFERMG sel
                                                              ON sel.CD_HISTORICO_ENFERMAGEM = sh.CD_HISTORICO_ENFERMAGEM
                                                          WHERE sh.cd_atendimento = $var_atd
                                                          AND sel.CD_PERGUNTA_HISTORICO IN (216))) res
                                  ORDER BY res.DS_RESPOSTA ASC";

    $result_consulta_alimentacao = oci_parse($conn_ora,$consulta_alimentacao);
    if(@$var_atd != ''){
    oci_execute(@$result_consulta_alimentacao);
    }
    $contador_while = 0;

?>


<div class='col-md-12' style='text-align:left'>

    Alimentação:
    <div style="max-height: 120px;
                overflow:auto; 
                border: solid 2px #CCCCCC; 
                border-radius: 5px;
                padding: 12px 20px 12px 20px;
                background-color: #F8F8F8">
    
    <?php 
    if($var_atd == null){ 
        echo 'Paciente sem atendimento';
    }else{
    
        while (@$row_alimentacao = oci_fetch_array($result_consulta_alimentacao)){


            if ($contador_while == 0){

                echo @$row_alimentacao['DS_RESPOSTA'];
        
            } else {

                echo ' || ' . @$row_alimentacao['DS_RESPOSTA'];
            }

            $contador_while = $contador_while + 1;

        }
    }

    ?>
    
</div>

</div>