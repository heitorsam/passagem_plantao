<?php

    $consulta_diag ="SELECT cid.CD_CID || ' (' || cid.DS_CID || ')' AS DS_DIAGNOSTICO
                     FROM dbamv.ATENDIME atd
                     INNER JOIN dbamv.CID cid
                     ON cid.CD_CID = atd.CD_CID
                     WHERE atd.CD_ATENDIMENTO = $var_atd
                     ";




    $result_consulta_diag = oci_parse($conn_ora,$consulta_diag);

    oci_execute($result_consulta_diag);

    $row_diag = oci_fetch_array($result_consulta_diag);

?>




    <div class='col-md-12' style='text-align:left'>

        Diagnostico:
        <textarea class='textarea' style="width: 100%;" name='frm_diagnostico' readonly><?php echo $row_diag ['DS_DIAGNOSTICO']; ?></textarea>

    </div>

