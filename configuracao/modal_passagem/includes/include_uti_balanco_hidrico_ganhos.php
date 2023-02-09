<?php
  
    $consulta_comorbi = "SELECT g.*
                         FROM(SELECT
                              'GANHOS' AS TIPO_BALANCO,
                              pbh.CD_BALANCO_HIDRICO, pbh.CD_ATENDIMENTO, 
                              pbh.CD_PACIENTE, pbh.DT_REFERENCIA,
                              --pitbh.DH_COLETA,
                              tp.CD_TIP_PRESC, tp.DS_TIP_PRESC,
                              SUM(pitbh.VL_COLETA) AS SUM_VL_COLETA
                              FROM dbamv.PW_BALANCO_HIDRICO pbh
                              INNER JOIN dbamv.PW_GRUPO_BALANCO_HIDRICO pgbh 
                              ON pgbh.CD_BALANCO_HIDRICO = pbh.CD_BALANCO_HIDRICO
                              INNER JOIN dbamv.PW_ITBALANCO_HIDRICO pitbh
                              ON pitbh.CD_GRUPO_BALANCO_HIDRICO = pgbh.CD_GRUPO_BALANCO_HIDRICO
                              INNER JOIN dbamv.TIP_PRESC tp
                              ON tp.CD_TIP_PRESC = pitbh.CD_TIP_PRESC
                              AND pbh.CD_ATENDIMENTO = $var_atd
                              AND pbh.DT_REFERENCIA IN (SELECT MAX(aux.DT_REFERENCIA) 
                                                      FROM dbamv.PW_BALANCO_HIDRICO aux
                                                      WHERE aux.CD_ATENDIMENTO = $var_atd)
                              AND tp.TP_BALANCO = 'G'
                              GROUP BY pbh.CD_BALANCO_HIDRICO, pbh.CD_ATENDIMENTO, 
                              pbh.CD_PACIENTE, pbh.DT_REFERENCIA, 
                              --pitbh.DH_COLETA,
                              tp.CD_TIP_PRESC, tp.DS_TIP_PRESC, tp.DS_TIP_PRESC
                              ORDER BY tp.DS_TIP_PRESC ASC) g";

    $result_consulta_comorbi = oci_parse($conn_ora,$consulta_comorbi);
    if(@$var_atd != ''){
    oci_execute(@$result_consulta_comorbi);
    }
    $contador_while = 0;

?>


<div class='col-md-12' style='text-align:left'>

    Ganhos:
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
    
        while (@$row_comorbi = oci_fetch_array($result_consulta_comorbi)){


            if ($contador_while == 0){

                echo @$row_comorbi['DS_TIP_PRESC'] . ': <b style="color: #202020 !important;">' . @$row_comorbi['SUM_VL_COLETA'] . '</b>';

            }else{

                echo '<br>' . @$row_comorbi['DS_TIP_PRESC'] . ': <b style="color: #202020 !important;">' . @$row_comorbi['SUM_VL_COLETA'] . '</b>';
            }

            $contador_while = $contador_while + 1;

        }
    }

    ?>
    
</div>

</div>