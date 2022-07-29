<?php

  $consulta_alerg ="SELECT sub.DS_SUBSTANCIA || ' (' || hsp.DS_AVISO || ')' AS DS_ALERGIA
                    FROM HIST_SUBS_PAC hsp
                    INNER JOIN dbamv.SUBSTANCIA sub
                    ON sub.CD_SUBSTANCIA = hsp.CD_SUBSTANCIA
                    WHERE hsp.TP_ALERGIA = 'S'
                    AND hsp.CD_PACIENTE = ". $row_exibir_pac['CD_PACIENTE'];

                    
                    $result_consulta_alerg = oci_parse($conn_ora,$consulta_alerg);

                    oci_execute($result_consulta_alerg);
                    $cont_while=0;

?>


<div class='col-md-12' style='text-align:left'>

    Alergias:
    <textarea class='textarea' style="width: 100%;" name='frm_alergias' readonly><?php while(@$row_alerg = oci_fetch_array($result_consulta_alerg)){

        if ($cont_while==0){

             echo $row_alerg['DS_ALERGIA'];
       
        } else {

             echo ' || ' . $row_alerg['DS_ALERGIA'];

        }

        $cont_while = $cont_while + 1;

    }
    ?>
</textarea>

</div>