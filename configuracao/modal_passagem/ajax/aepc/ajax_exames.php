<?php 

    include '../../../../conexao.php';



    $var_atd = $_GET['atend'];


    $consulta_obs = "SELECT TO_CHAR(itrx.dt_entrega, 'DD/MM/YYYY HH24:MI') as dt,
                            tp.DS_TIP_PRESC as ds,
                            CASE
                            WHEN itrx.CD_LAUDO IS NOT NULL THEN
                            'Laudado'
                            else
                            'Aguardando laudo'
                        end as Status
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
                        AND itrx.CD_LAUDO IS NOT NULL
                        and itrx.Sn_Realizado = 'S'
                        ORDER BY status ,itrx.dt_entrega desc";

    $consulta_obs_realizado = "SELECT TO_CHAR(itrx.dt_entrega, 'DD/MM/YYYY HH24:MI') as dt,
                                tp.DS_TIP_PRESC as ds,
                                CASE
                                WHEN itrx.CD_LAUDO IS NOT NULL THEN
                                'Laudado'
                                else
                                'Aguardando laudo'
                            end as Status
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
                            AND itrx.CD_LAUDO IS NULL
                            and itrx.Sn_Realizado = 'S'
                            ORDER BY status ,itrx.dt_entrega desc";

    $consulta_obs_ag = "SELECT TO_CHAR(itrx.dt_entrega, 'DD/MM/YYYY HH24:MI') as dt,
                                tp.DS_TIP_PRESC as ds,
                                CASE
                                    WHEN itrx.sn_realizado = 'N' then
                                    'Agendado'
                                    else
                                    'Realizado'
                                end as Status
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
                            AND itrx.CD_LAUDO IS NULL
                            AND itrx.sn_realizado = 'N'
                            ORDER BY status ,itrx.dt_entrega desc";

        
        
   

    $result_obs = oci_parse($conn_ora, @$consulta_obs);
    oci_execute(@$result_obs);

    $result_obs_realizado = oci_parse($conn_ora, @$consulta_obs_realizado);
    oci_execute(@$result_obs_realizado);
    

    $result_obs_ag = oci_parse($conn_ora, @$consulta_obs_ag);
    oci_execute(@$result_obs_ag);
    

    

?>
</br>


<h11>Agendada</h11>

    <span class="espaco_pequeno" style="width: 6px"></span>
    <div class="table-responsive col-md-12" style="padding: 0px !important;overflow-y: auto; max-height: 150px; overflow-x: hidden;">   
    
            <table class="table table-striped"  cellspacing="0" cellpadding="0">
                
            <thead>

                <tr>
                    <th style="text-align: center;">Data</th>
                    <th style="text-align: center;">Descrição</th>
                    <th style="text-align: center;">Status</th>
                </tr>

            </thead>

            <tbody>

                <?php
                    if($var_atd != null){
                        while($row_dur_ag = oci_fetch_array(@$result_obs_ag)){

                        echo'<tr>';
                            echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_ag['DT'] . '</td>';
                            echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_ag['DS'] . '</td>';
                            echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_ag['STATUS'] . '</td>';
                        echo'</tr>';
                        }
                    }     
                ?>

            </tbody>



            </table>
    
</div>
</br> 

<h11>Realizado</h11>

<span class="espaco_pequeno" style="width: 6px"></span>

<div class="table-responsive col-md-12" style="padding: 0px !important;overflow-y: auto; max-height: 150px; overflow-x: hidden;">

    <table class="table table-striped"  cellspacing="0" cellpadding="0">
    
        <thead>

            <tr>
                <th style="text-align: center;">Data</th>
                <th style="text-align: center;">Descrição</th>
                <th style="text-align: center;">Status</th>
            </tr>

        </thead>

        <tbody>

            <?php
                if($var_atd != null){
                    while(@$row_dur_realizado = oci_fetch_array(@$result_obs_realizado)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_realizado['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_realizado['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_realizado['STATUS'] . '</td>';
                        
                    echo'</tr>';
                    }
                }        
            ?>

        </tbody>

        

    </table>
</div>

<h11>Laudado</h11>

<span class="espaco_pequeno" style="width: 6px"></span>

<div class="table-responsive col-md-12" style="padding: 0px !important;overflow-y: auto; max-height: 150px; overflow-x: hidden;">

    <table class="table table-striped"  cellspacing="0" cellpadding="0">
    
        <thead>

            <tr>
                <th style="text-align: center;">Data</th>
                <th style="text-align: center;">Descrição</th>
                <th style="text-align: center;">Status</th>

            </tr>

        </thead>

        <tbody>

            <?php
                if($var_atd != null){
                    while(@$row_dur = oci_fetch_array(@$result_obs)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur['STATUS'] . '</td>';
                        
                    echo'</tr>';
                    }
                }        
            ?>

        </tbody>

        

    </table>
</div>

