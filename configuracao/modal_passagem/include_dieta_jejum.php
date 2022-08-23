<?php

$consulta_dieta ="SELECT DISTINCT tp.DS_TIP_PRESC
                  FROM dbamv.PRE_MED pm
                  INNER JOIN dbamv.ITPRE_MED itpm
                  ON itpm.CD_PRE_MED = pm.CD_PRE_MED
                  INNER JOIN dbamv.TIP_PRESC tp
                  ON tp.CD_TIP_PRESC = itpm.CD_TIP_PRESC
                  WHERE itpm.CD_TIP_ESQ IN ('DIE', 'JEJ')
                  AND pm.CD_ATENDIMENTO = $var_atd
                  AND pm.CD_PRE_MED IN (SELECT MAX(aux_pm.CD_PRE_MED) AS MAX_CD_PRE_MED 
                                           FROM dbamv.PRE_MED aux_pm
                                           INNER JOIN dbamv.ITPRE_MED aux_itpm
                                               ON aux_itpm.CD_PRE_MED = aux_pm.CD_PRE_MED
                                           WHERE aux_itpm.CD_TIP_ESQ IN ('DIE', 'JEJ')
                                           AND aux_pm.CD_ATENDIMENTO = $var_atd)";

$result_consulta_dieta = oci_parse($conn_ora,$consulta_dieta);

oci_execute($result_consulta_dieta);

$conta_while = 0;

?>


<div class='col-md-12' style='text-align:left'>

    Dieta/Jejum:
    <textarea class='textarea' style="width: 100%;" name='frm_dienta_jejum' readonly><?php while (@$row_dieta = oci_fetch_array($result_consulta_dieta)){



    if ($conta_while == 0){

        echo $row_dieta['DS_TIP_PRESC'];

    }else{

        echo ' || ' . $row_dieta['DS_TIP_PRESC'];
    }

    $conta_while = $conta_while + 1;


    }
    ?>
    </textarea>

</div>
