<?php



$consulta_venti ="SELECT DISTINCT resp.DS_RESPOSTA
                  FROM dbamv.SAE_HISTORICO_ENFERMAGEM she
                  INNER JOIN dbamv.SAE_RESP_SELCND_HIST_ENFERMG sel
                  ON sel.CD_HISTORICO_ENFERMAGEM = she.CD_HISTORICO_ENFERMAGEM
                  INNER JOIN dbamv.SAE_PERGUNTA_HISTORICO_ENFERMG perg
                  ON perg.CD_PERGUNTA = sel.CD_PERGUNTA_HISTORICO
                  INNER JOIN dbamv.SAE_RESPOSTA_HISTORICO_ENFERMG resp
                  ON sel.CD_RESPOSTA_HISTORICO = resp.CD_RESPOSTA
                  WHERE sel.CD_PERGUNTA_HISTORICO IN (467, 483, 348, 234, 346, 313)
                  AND she.CD_ATENDIMENTO = $var_atd 
                  AND she.DT_INICIO = (SELECT MAX(sh.DT_INICIO)
                          FROM dbamv.SAE_HISTORICO_ENFERMAGEM sh
                          INNER JOIN dbamv.SAE_RESP_SELCND_HIST_ENFERMG sel
                            ON sel.CD_HISTORICO_ENFERMAGEM = sh.CD_HISTORICO_ENFERMAGEM
                            WHERE sh.cd_atendimento = $var_atd
                            AND sel.CD_PERGUNTA_HISTORICO IN (467, 483, 348, 234, 346, 313))
                  ";

$result_consulta_venti = oci_parse($conn_ora,$consulta_venti);
if(@$var_atd != ''){
    oci_execute(@$result_consulta_venti);
}
$con_while = 0;



?>

<div class='col-md-12' style='text-align:left'>

    Ventilação:
    <textarea class='textarea' style="width: 100%;" name='frm_ventilacao' readonly><?php 
    if($var_atd == null){ 
         echo 'Paciente sem atendimento'; 
    }else{

        while (@$row_venti = oci_fetch_array($result_consulta_venti)){

        if ($con_while == 0){

            echo @$row_venti['DS_RESPOSTA'];

        }else{

            echo ' || ' . @$row_venti['DS_RESPOSTA'];
        }

        $con_while = $con_while + 1;


        }
    }

    ?>
    </textarea>

</div>
