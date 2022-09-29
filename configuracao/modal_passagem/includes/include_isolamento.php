<?php

    $consulta_iso ="SELECT resp.DS_RESPOSTA
                FROM dbamv.SAE_HISTORICO_ENFERMAGEM she
                INNER JOIN dbamv.SAE_RESP_SELCND_HIST_ENFERMG sel
                ON sel.CD_HISTORICO_ENFERMAGEM = she.CD_HISTORICO_ENFERMAGEM
                INNER JOIN dbamv.SAE_PERGUNTA_HISTORICO_ENFERMG perg
                ON perg.CD_PERGUNTA = sel.CD_PERGUNTA_HISTORICO
                INNER JOIN dbamv.SAE_RESPOSTA_HISTORICO_ENFERMG resp
                ON sel.CD_RESPOSTA_HISTORICO = resp.CD_RESPOSTA
                WHERE sel.CD_PERGUNTA_HISTORICO IN (475, 419, 289, 343)
                AND she.CD_ATENDIMENTO = $var_atd
                AND she.DT_INICIO = (SELECT MAX(sh.DT_INICIO)
                          FROM dbamv.SAE_HISTORICO_ENFERMAGEM sh
                          INNER JOIN dbamv.SAE_RESP_SELCND_HIST_ENFERMG sel
                            ON sel.CD_HISTORICO_ENFERMAGEM = sh.CD_HISTORICO_ENFERMAGEM
                         WHERE sh.cd_atendimento = $var_atd
                         AND sel.CD_PERGUNTA_HISTORICO IN (475, 419, 289, 343))
                ";




                $result_consulta_iso = oci_parse($conn_ora,$consulta_iso);
                if(@$var_atd != ''){
                    oci_execute(@$result_consulta_iso);
                    $row_iso = oci_fetch_array($result_consulta_iso);
                }
?>

<div class='col-md-12' style='text-align:left'>

    Isolamento:
    <textarea class='textarea' rows="4" style="width: 100%;" name='frm_isolamento' readonly><?php if($var_atd == null){  echo 'Paciente sem atendimento'; }else{ echo @$row_iso ['DS_RESPOSTA']; }?></textarea>

</div>