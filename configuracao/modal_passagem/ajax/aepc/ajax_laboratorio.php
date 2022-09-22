<?php 

    include '../../../../conexao.php';


    $var_atd = @$_GET['atend'];


    $consulta_prescrito = "SELECT TO_CHAR(pm.hr_pre_med, 'DD/MM/YYYY HH24:MI') as dt,
                            tp.DS_TIP_PRESC as ds, 
                            tf.DS_TIP_FRE
                        FROM dbamv.PRE_MED pm
                        INNER JOIN dbamv.ITPRE_MED itpm
                        ON itpm.CD_PRE_MED = pm.CD_PRE_MED 
                        INNER JOIN dbamv.TIP_PRESC tp
                        ON tp.CD_TIP_PRESC = itpm.CD_TIP_PRESC
                        INNER JOIN dbamv.TIP_FRE tf
                        ON tf.CD_TIP_FRE = itpm.CD_TIP_FRE
                        WHERE itpm.CD_TIP_ESQ = 'LAB'
                        AND pm.CD_ATENDIMENTO = $var_atd
                        AND itpm.CD_ITPRE_MED not in (SELECT hr.cd_itpre_med FROM dbamv.hritpre_cons hr)
                        ORDER BY dt desc, tf.DS_TIP_FRE asc";

    $consulta_coletado = "SELECT tp.DS_TIP_PRESC as ds,
                            TO_CHAR(hrit.dh_medicacao, 'DD/MM/YYYY HH24:MI') as dt
                        FROM dbamv.PRE_MED pm
                        INNER JOIN dbamv.ITPRE_MED itpm
                        ON itpm.CD_PRE_MED = pm.CD_PRE_MED
                        INNER JOIN dbamv.TIP_PRESC tp
                        ON tp.CD_TIP_PRESC = itpm.CD_TIP_PRESC
                        INNER JOIN dbamv.TIP_FRE tf
                        ON tf.CD_TIP_FRE = itpm.CD_TIP_FRE
                        INNER JOIN dbamv.hritpre_cons hrit
                        ON hrit.cd_itpre_med = itpm.cd_itpre_med
                        WHERE itpm.CD_TIP_ESQ = 'LAB'
                        AND pm.CD_ATENDIMENTO = $var_atd
                        AND itpm.CD_ITPRE_MED in
                            (SELECT hr.cd_itpre_med FROM dbamv.hritpre_cons hr WHERE hr.cd_itpre_med = itpm.cd_itpre_med)
                        AND itpm.CD_ITPRE_MED not in
                            (SELECT distinct itpms.cd_itpre_med
                            FROM dbamv.atendime atd
                            INNER JOIN dbamv.PED_LAB pdl
                                ON pdl.CD_ATENDIMENTO = atd.CD_ATENDIMENTO
                            INNER JOIN dbamv.RES_EXA re
                                ON re.CD_PED_LAB = pdl.CD_PED_LAB
                            INNER JOIN dbamv.EXA_LAB exl
                                ON exl.CD_EXA_LAB = re.CD_EXA_LAB
                            INNER JOIN dbamv.ITPRE_MED itpms
                                ON itpms.CD_PRE_MED = pdl.cd_pre_med
                            WHERE atd.cd_atendimento = $var_atd
                            AND itpms.cd_tip_esq = 'LAB')
                        ORDER BY dt desc, tp.DS_TIP_PRESC asc";
        
    $consulta_resultado = "SELECT distinct TO_CHAR(pdl.dt_exame, 'DD/MM/YYYY HH24:MI') as dt, 
                                                tp.DS_TIP_PRESC as ds
                                                FROM dbamv.atendime atd
                                            INNER JOIN dbamv.PED_LAB pdl
                                                ON pdl.CD_ATENDIMENTO = atd.CD_ATENDIMENTO
                                            INNER JOIN dbamv.RES_EXA re
                                                ON re.CD_PED_LAB = pdl.CD_PED_LAB
                                            INNER JOIN dbamv.EXA_LAB exl
                                                ON exl.CD_EXA_LAB = re.CD_EXA_LAB
                                            INNER JOIN dbamv.ITPRE_MED itpm
                                                ON itpm.CD_PRE_MED = pdl.cd_pre_med
                                            INNER JOIN dbamv.TIP_PRESC tp
                                                ON tp.CD_TIP_PRESC = itpm.CD_TIP_PRESC
                                            WHERE atd.cd_atendimento = $var_atd
                                            AND itpm.cd_tip_esq = 'LAB'
                                            AND itpm.CD_ITPRE_MED in (SELECT hr.cd_itpre_med FROM dbamv.hritpre_cons hr WHERE hr.cd_itpre_med = itpm.cd_itpre_med)
                                            ORDER BY dt desc, tp.DS_TIP_PRESC asc";
      
 
    $result_prescrito = oci_parse($conn_ora, $consulta_prescrito);
    @oci_execute($result_prescrito);

    $result_coletado = oci_parse($conn_ora, $consulta_coletado);
    @oci_execute($result_coletado);

    $result_resultado = oci_parse($conn_ora, $consulta_resultado);   
    @oci_execute($result_resultado);
        



?>
</br>


    
<h11>Prescrito</h11>
<div class="table-responsive col-md-12" style="padding: 0px !important;overflow-y: auto; max-height: 150px; overflow-x: hidden;">

    <table class="table table-striped"  cellspacing="0" cellpadding="0">
    
        <thead>

            <tr>
                <th style="text-align: center;">Data</th>
                <th style="text-align: center;">Descrição</th>
                <th style="text-align: center;">Frequencia</th>

            </tr>

        </thead>

        <tbody>

            <?php
                if($var_atd != null){
                    while($row_prescrito = oci_fetch_array($result_prescrito)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_prescrito['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_prescrito['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_prescrito['DS_TIP_FRE'] . '</td>';

                    echo'</tr>';
                    }
                }        
            ?>

        </tbody>

        

    </table>
</div>
</br>
<h11>Coletado</h11>
<div class="table-responsive col-md-12" style="padding: 0px !important;overflow-y: auto; max-height: 150px; overflow-x: hidden;">

    <table class="table table-striped"  cellspacing="0" cellpadding="0">
    
        <thead>

            <tr>
                <th style="text-align: center;">Data da Coleta</th>
                <th style="text-align: center;">Descrição</th>


            </tr>

        </thead>

        <tbody>

            <?php
                if($var_atd != null){
                    while($row_coletado = oci_fetch_array($result_coletado)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_coletado['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_coletado['DS'] . '</td>';

                    echo'</tr>';
                    }
                }        
            ?>

        </tbody>

        

    </table>
</div>

</br>
<h11>Resultado</h11>
<div class="table-responsive col-md-12" style="padding: 0px !important;overflow-y: auto; max-height: 150px; overflow-x: hidden;">

    <table class="table table-striped"  cellspacing="0" cellpadding="0">
    
        <thead>

            <tr>
                <th style="text-align: center;">Data do Resultado</th>
                <th style="text-align: center;">Descrição</th>


            </tr>

        </thead>

        <tbody>

            <?php
                if($var_atd != null){
                    while($row_resultado = oci_fetch_array(@$result_resultado)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_resultado['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_resultado['DS'] . '</td>';

                    echo'</tr>';
                    }
                }        
            ?>

        </tbody>

        

    </table>
</div>



