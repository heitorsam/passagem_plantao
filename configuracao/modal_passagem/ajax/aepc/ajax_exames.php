<?php 

    include '../../../../conexao.php';



    $var_atd = @$_GET['atend'];


    $consulta_laudado = "SELECT TO_CHAR(itrx.dt_entrega, 'DD/MM/YYYY HH24:MI') as dt,
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
                        INNER JOIN dbamv.TIP_ESQ esq
                        ON esq.CD_TIP_ESQ = itpm.CD_TIP_ESQ
                        WHERE esq.SN_EXA_RX = 'S'
                        AND pm.CD_ATENDIMENTO = $var_atd
                        AND itrx.CD_LAUDO IS NOT NULL
                        and itrx.Sn_Realizado = 'S'
                        ORDER BY status ,itrx.dt_entrega desc";

    $consulta_realizado = "SELECT TO_CHAR(itrx.dt_realizado, 'DD/MM/YYYY HH24:MI') as dt,
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
                            INNER JOIN dbamv.TIP_ESQ esq
                            ON esq.CD_TIP_ESQ = itpm.CD_TIP_ESQ
                            WHERE esq.SN_EXA_RX = 'S'
                            AND pm.CD_ATENDIMENTO = $var_atd
                            AND itrx.CD_LAUDO IS NULL
                            and itrx.Sn_Realizado = 'S'
                            ORDER BY status ,itrx.dt_realizado desc";

    $consulta_ag = "SELECT TO_CHAR(itrx.dt_entrega, 'DD/MM/YYYY HH24:MI') as dt,
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
                            INNER JOIN dbamv.TIP_ESQ esq
                            ON esq.CD_TIP_ESQ = itpm.CD_TIP_ESQ
                            WHERE esq.SN_EXA_RX = 'S'
                            AND pm.CD_ATENDIMENTO = $var_atd
                            AND itrx.CD_LAUDO IS NULL
                            AND itrx.sn_realizado = 'N'
                            AND pm.dt_validade > sysdate
                            ORDER BY status ,itrx.dt_entrega desc";

        
        
   

    $result_laudado = oci_parse($conn_ora, $consulta_laudado);
    @oci_execute($result_laudado);

    $result_realizado = oci_parse($conn_ora, $consulta_realizado);
    @oci_execute($result_realizado);
    

    $result_ag = oci_parse($conn_ora, $consulta_ag);
    @oci_execute($result_ag);
    

    

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
                        while($row_ag = oci_fetch_array($result_ag)){

                        echo'<tr>';
                            echo '<td class="align-middle" style="text-align: center;">' . $row_ag['DT'] . '</td>';
                            echo '<td class="align-middle" style="text-align: center;">' . $row_ag['DS'] . '</td>';
                            echo '<td class="align-middle" style="text-align: center;">' . $row_ag['STATUS'] . '</td>';
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
                    while($row_realizado = oci_fetch_array($result_realizado)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_realizado['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_realizado['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_realizado['STATUS'] . '</td>';
                        
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
                    while($row_laudado = oci_fetch_array($result_laudado)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_laudado['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_laudado['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_laudado['STATUS'] . '</td>';
                        
                    echo'</tr>';
                    }
                }        
            ?>

        </tbody>

        

    </table>
</div>

