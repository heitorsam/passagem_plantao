<?php 

    include '../../../../conexao.php';



    $pac = @$_GET['paciente'];

    
    //A - Em Aviso / R - Realizada / C - Cancelada / G - Agendada / T - Controle de Checagem / P - Pre Agendamento

    $consulta_agendado = "SELECT TO_CHAR(ag.dt_inicio_age_cir, 'DD/MM/YYYY HH24:MI') AS dt,
                                    cir.DS_CIRURGIA AS ds,
                                    CASE
                                        WHEN ac.TP_SITUACAO = 'G' THEN
                                        'Agendado'
                                    END AS STATUS
                                FROM dbamv.AVISO_CIRURGIA ac
                                INNER JOIN dbamv.CIRURGIA_AVISO ca
                                ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                                INNER JOIN dbamv.CIRURGIA cir
                                ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                                INNER JOIN dbamv.age_cir ag
                                ON ag.Cd_Aviso_Cirurgia = AC.CD_AVISO_CIRURGIA
                                WHERE ac.TP_SITUACAO = 'G'
                                AND ac.CD_PACIENTE = $pac
                                AND ac.cd_cen_cir = 1
                                ORDER BY dt DESC";

    $consulta_realizado = "SELECT TO_CHAR(ac.dt_realizacao, 'DD/MM/YYYY HH24:MI') AS dt,
                            cir.DS_CIRURGIA AS ds,
                            CASE
                                WHEN ac.TP_SITUACAO = 'R' THEN
                                'Realizado'
                            end AS status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                        ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                        ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'R'
                        AND ac.CD_PACIENTE = $pac
                        AND ac.cd_cen_cir = 1
                        ORDER BY dt desc";
   
    $consulta_cancelado = "SELECT TO_CHAR(ac.dt_cancelamento, 'DD/MM/YYYY HH24:MI') AS dt,
                            cir.DS_CIRURGIA AS ds,
                            CASE
                                WHEN ac.TP_SITUACAO = 'C' THEN
                                'Cancelado'
                            end AS status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                        ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                        ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'C'
                        AND ac.CD_PACIENTE = $pac
                        AND ac.cd_cen_cir = 1
                        ORDER BY dt desc";

    $consulta_aviso = "SELECT TO_CHAR(ac.dt_aviso_cirurgia, 'DD/MM/YYYY HH24:MI') AS dt,
                            cir.DS_CIRURGIA AS ds,
                            CASE
                                WHEN ac.TP_SITUACAO = 'A' THEN
                                'Em aviso'
                            end AS status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                        ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                        ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'A'
                        AND ac.CD_PACIENTE = $pac
                        AND ac.cd_cen_cir = 1
                        ORDER BY dt desc";

    $consulta_controle = "SELECT TO_CHAR(ac.DT_INICIO_CIRURGIA, 'DD/MM/YYYY HH24:MI') AS dt,
                            cir.DS_CIRURGIA AS ds,
                            CASE
                                WHEN ac.TP_SITUACAO = 'T' THEN
                                'Controle de checagem'
                            end AS status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                        ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                        ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'T'
                        AND ac.CD_PACIENTE = $pac
                        AND ac.cd_cen_cir = 1
                        ORDER BY ac.DT_INICIO_CIRURGIA desc";

    $consulta_pre_agen = "SELECT TO_CHAR(ac.Dt_pre_Agendamento, 'DD/MM/YYYY HH24:MI') AS dt,
                            cir.DS_CIRURGIA AS ds,
                            CASE
                                WHEN ac.TP_SITUACAO = 'P' THEN
                                'Pre agendado'
                            end AS status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                        ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                        ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'P'
                        AND ac.CD_PACIENTE = $pac
                        AND ac.cd_cen_cir = 1
                        ORDER BY dt desc";
    

    $result_agendado = oci_parse($conn_ora, $consulta_agendado);
    @oci_execute($result_agendado);

    $result_realizado = oci_parse($conn_ora, $consulta_realizado);
    @oci_execute($result_realizado);
    
    $result_cancelado = oci_parse($conn_ora, $consulta_cancelado);
    @oci_execute($result_cancelado);
    
    $result_aviso = oci_parse($conn_ora, $consulta_aviso);
    @oci_execute($result_aviso);
    
    $result_controle = oci_parse($conn_ora, $consulta_controle);
    @oci_execute($result_controle);

    $result_pre_agen = oci_parse($conn_ora, $consulta_pre_agen);
    @oci_execute($result_pre_agen);
        


    

?>
</br>

<h11>Agendada</h11>

<span class="espaco_penequeno" style="width: 6px"></span>
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
                if($pac != null){
                    while($row_agendado = oci_fetch_array($result_agendado)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_agendado['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_agendado['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_agendado['STATUS'] . '</td>';
                    echo'</tr>';
                    }
                }     
            ?>

        </tbody>



        </table>

</div>
</br> 

<h11>Realizado</h11>
<span class="espaco_penequeno" style="width: 6px"></span>

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
                if($pac != null){
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


</br> 
<h11>Cancelado</h11>
<span class="espaco_penequeno" style="width: 6px"></span>
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
                if($pac != null){
                    while($row_cancelado = oci_fetch_array($result_cancelado)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_cancelado['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_cancelado['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_cancelado['STATUS'] . '</td>';
                    echo'</tr>';
                }
                }      
            ?>

        </tbody>



        </table>

</div>


</br> 
<h11>Em aviso</h11>
<span class="espaco_penequeno" style="width: 6px"></span>
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
                if($pac != null){
                    while($row_aviso = oci_fetch_array($result_aviso)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_aviso['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_aviso['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_aviso['STATUS'] . '</td>';
                    echo'</tr>';
                    }
                }         
            ?>

        </tbody>



        </table>

</div>
</br> 
<h11>Controle de Checagem</h11>
<span class="espaco_penequeno" style="width: 6px"></span>
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
                if($pac != null){
                    while($row_controle = oci_fetch_array($result_controle)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_controle['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_controle['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_controle['STATUS'] . '</td>';
                    echo'</tr>';
                    }
                }            
            ?>

        </tbody>



        </table>

</div>
</br> 
<h11>Pré agendado</h11>
<span class="espaco_penequeno" style="width: 6px"></span>
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
                if($pac != null){
                    while($row_pre_agen = oci_fetch_array($result_pre_agen)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_pre_agen['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_pre_agen['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . $row_pre_agen['STATUS'] . '</td>';
                    echo'</tr>';
                    }
                } 
            ?>

        </tbody>



        </table>

</div>
