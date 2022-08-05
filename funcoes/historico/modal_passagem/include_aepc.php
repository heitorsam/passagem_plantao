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
                ELSE 'EXAMES : (' || TO_CHAR(pm.DT_PRE_MED, 'DD/MM/YYYY') || ') '|| tp.DS_TIP_PRESC 
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
<div class="col-md-12">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tabs('par', '<?php echo $var_atd ?>')" class="nav-link" >Parecer</button>

            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tabs('exa', '<?php echo $var_atd ?>')" class="nav-link" >Exames</button>

            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tabs('lab', '<?php echo $var_atd ?>')" class="nav-link" >Laboratoriais</button>

            <button type="button" style="color: #fff; background-color: #3185c1;" onclick="tabs('cir', '<?php echo $var_atd ?>')" class="nav-link" >Cirurgias</button>
        </div>
    </nav>
</div>
<div class="col-md-12" id="div_tab">

</div>


   

<script>

    function tabs(tipo, atend){
        if(tipo == 'par'){
            var sql = "SELECT 'PARECER: (' || TO_CHAR(pm.DT_SOLICITACAO, 'DD/MM/YYYY') || ') '|| esp.DS_ESPECIALID || ' [' || pm.DS_SITUACAO || '] ' AS DS_DESCRICAO FROM dbamv.PAR_MED pm INNER JOIN dbamv.ESPECIALID esp ON esp.CD_ESPECIALID = pm.CD_ESPECIALID WHERE pm.CD_ATENDIMENTO ="+ atend;
        }else if(tipo == 'exa'){
            var sql = "SELECT 'CIRURGIA : (' || TO_CHAR(ac.DT_INICIO_CIRURGIA, 'DD/MM/YYYY') || ') '|| cir.DS_CIRURGIA AS DS_DESCRICAO FROM dbamv.AVISO_CIRURGIA ac INNER JOIN dbamv.CIRURGIA_AVISO ca ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA INNER JOIN dbamv.CIRURGIA cir ON cir.CD_CIRURGIA = ca.CD_CIRURGIA WHERE ac.TP_SITUACAO = 'A' AND ac.CD_ATENDIMENTO ="+ atend;
        }else if(tipo == 'lab'){
            var sql = "SELECT CASE WHEN itrx.CD_LAUDO IS NOT NULL THEN 'EXAMES : (' || TO_CHAR(pm.DT_PRE_MED, 'DD/MM/YYYY') || ') ' || tp.DS_TIP_PRESC || ' [LAUDO: ' || ld.HR_LAUDO || ']' ELSE 'EXAMES : (' || TO_CHAR(pm.DT_PRE_MED, 'DD/MM/YYYY') || ') '|| tp.DS_TIP_PRESC  || ' [LAUDO: AGUARDANDO]' END AS DS_DESCRICAO FROM dbamv.PRE_MED pm INNER JOIN dbamv.ITPRE_MED itpm ON itpm.CD_PRE_MED = pm.CD_PRE_MED INNER JOIN dbamv.TIP_PRESC tp ON tp.CD_TIP_PRESC = itpm.CD_TIP_PRESC INNER JOIN dbamv.ITPED_RX itrx ON itrx.CD_ITPRE_MED = itpm.CD_ITPRE_MED LEFT JOIN dbamv.LAUDO_RX ld ON ld.CD_LAUDO = itrx.CD_LAUDO WHERE itpm.CD_TIP_ESQ IN ('EXA') AND pm.CD_ATENDIMENTO ="+ atend;
        }else if(tipo == 'cir'){
            var sql = "SELECT 'EXAMES LABORATORIAIS : (' || TO_CHAR(pm.DT_PRE_MED, 'DD/MM/YYYY') || ') '|| tp.DS_TIP_PRESC || ' [' || tf.DS_TIP_FRE || ']' AS DS_DESCRICAO FROM dbamv.PRE_MED pm INNER JOIN dbamv.ITPRE_MED itpm ON itpm.CD_PRE_MED = pm.CD_PRE_MED INNER JOIN dbamv.TIP_PRESC tp ON tp.CD_TIP_PRESC = itpm.CD_TIP_PRESC INNER JOIN dbamv.TIP_FRE tf ON tf.CD_TIP_FRE = itpm.CD_TIP_FRE WHERE itpm.CD_TIP_ESQ IN ('LAB') AND pm.CD_ATENDIMENTO ="+ atend;
        }

        $('#div_tab').load("configuracao/modal_passagem/ajax/ajax_aepc.php?tipo="+ tipo +"&atend="+ atend);

    }





</script>