<?php


$consulta_aepc="SELECT 'PARECER: (' || TO_CHAR(pm.DT_SOLICITACAO, 'DD/MM/YYYY') || ') '|| esp.DS_ESPECIALID || ' [' || pm.DS_SITUACAO || '] ' AS DS_DESCRICAO
                FROM dbamv.PAR_MED pm
                INNER JOIN dbamv.ESPECIALID esp
                ON esp.CD_ESPECIALID = pm.CD_ESPECIALID
                WHERE pm.CD_ATENDIMENTO = $var_atd
                
                UNION ALL

                SELECT 'CIRURGIA : (' || TO_CHAR(ac.DT_INICIO_CIRURGIA, 'DD/MM/YYYY') || ') '|| cir.DS_CIRURGIA AS DS_DESCRICAO
                FROM dbamv.AVISO_CIRURGIA ac
                INNER JOIN dbamv.CIRURGIA_AVISO ca
                ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                INNER JOIN dbamv.CIRURGIA cir
                ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                WHERE ac.TP_SITUACAO = 'A'
                AND ac.CD_ATENDIMENTO = $var_atd

                UNION ALL

                SELECT 
                CASE
                WHEN itrx.CD_LAUDO IS NOT NULL THEN 'EXAMES : (' || TO_CHAR(pm.DT_PRE_MED, 'DD/MM/YYYY') || ') '
                    || tp.DS_TIP_PRESC || ' [LAUDO: ' || ld.HR_LAUDO || ']'
                ELSE 'EXAMES : (' || pm.DT_PRE_MED || ') '|| tp.DS_TIP_PRESC 
                    || ' [LAUDO: AGUARDANDO]'
                END AS DS_DESCRICAO
                FROM dbamv.PRE_MED pm
                INNER JOIN dbamv.ITPRE_MED itpm
                ON itpm.CD_PRE_MED = pm.CD_PRE_MED 
                INNER JOIN dbamv.TIP_PRESC tp
                ON tp.CD_TIP_PRESC = itpm.CD_TIP_PRESC
                INNER JOIN dbamv.ITPED_RX itrx
                ON itrx.CD_ITPRE_MED = itpm.CD_ITPRE_MED
                LEFT JOIN dbamv.LAUDO_RX ld
                ON ld.CD_LAUDO = itrx.CD_LAUDO
                WHERE itpm.CD_TIP_ESQ IN ('EXA')
                AND pm.CD_ATENDIMENTO = $var_atd

                UNION ALL 

                SELECT 'EXAMES LABORATORIAIS : (' || TO_CHAR(pm.DT_PRE_MED, 'DD/MM/YYYY') || ') '|| tp.DS_TIP_PRESC || ' [' || tf.DS_TIP_FRE || ']' AS DS_DESCRICAO
                FROM dbamv.PRE_MED pm
                INNER JOIN dbamv.ITPRE_MED itpm
                ON itpm.CD_PRE_MED = pm.CD_PRE_MED 
                INNER JOIN dbamv.TIP_PRESC tp
                ON tp.CD_TIP_PRESC = itpm.CD_TIP_PRESC
                INNER JOIN dbamv.TIP_FRE tf
                ON tf.CD_TIP_FRE = itpm.CD_TIP_FRE
                WHERE itpm.CD_TIP_ESQ IN ('LAB')
                AND pm.CD_ATENDIMENTO = $var_atd ";

$result_consulta_aepc = oci_parse($conn_ora,$consulta_aepc);

oci_execute($result_consulta_aepc);

$contadr_while = 0;



?>

<div class='col-md-12' style='text-align:left'>

    Avaliações/Exames Pendentes/Cirurgias:
    <div class='textarea' style="width: 100%; height: 120px; overflow-y: scroll;"  name='frm_aepc'>   
        
        <?php 
        
            while (@$row_aepc = oci_fetch_array($result_consulta_aepc)){    
                
                if ($contadr_while==0){

                        echo $row_aepc['DS_DESCRICAO'];
                
                } else {

                        echo ' </br> ' . $row_aepc['DS_DESCRICAO'];

                }

                $contadr_while = $contadr_while + 1;
                    
            
            }
        ?>

    </div>

</div>