<?php 

    include '../../../../conexao.php';



    $var_atd = $_GET['atend'];

    
    //A - Em Aviso / R - Realizada / C - Cancelada / G - Agendada / T - Controle de Checagem / P - Pre Agendamento
    $consulta_obs = "SELECT TO_CHAR(ac.dt_realizacao, 'DD/MM/YYYY HH24:MI') as dt,
                            cir.DS_CIRURGIA as ds,
                            CASE
                                WHEN ac.TP_SITUACAO = 'R' THEN
                                'Realizado'
                            end as status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                        ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                        ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'R'
                        AND ac.CD_ATENDIMENTO = $var_atd
                        ORDER BY dt desc";
    $consulta_obs_null = "SELECT TO_CHAR(ag.dt_inicio_age_cir, 'DD/MM/YYYY HH24:MI') as dt,
                                cir.DS_CIRURGIA as ds,
                                CASE
                                WHEN ac.TP_SITUACAO = 'G' THEN
                                'Agendado'
                                end as status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                            ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                            ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                            INNER JOIN dbamv.age_cir ag
                            ON ag.Cd_Aviso_Cirurgia = AC.CD_AVISO_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'G'
                        AND ac.CD_ATENDIMENTO = $var_atd
                        ORDER BY dt desc";
    $consulta_obs_cancelado = "SELECT TO_CHAR(ac.dt_cancelamento, 'DD/MM/YYYY HH24:MI') as dt,
                            cir.DS_CIRURGIA as ds,
                            CASE
                                WHEN ac.TP_SITUACAO = 'C' THEN
                                'Cancelado'
                            end as status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                        ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                        ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'C'
                        AND ac.CD_ATENDIMENTO = $var_atd
                        ORDER BY dt desc";
    $consulta_obs_g = "SELECT TO_CHAR(ac.dt_aviso_cirurgia, 'DD/MM/YYYY HH24:MI') as dt,
                            cir.DS_CIRURGIA as ds,
                            CASE
                                WHEN ac.TP_SITUACAO = 'A' THEN
                                'Em aviso'
                            end as status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                        ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                        ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'A'
                        AND ac.CD_ATENDIMENTO = $var_atd
                        ORDER BY dt desc";
    $consulta_obs_T = "SELECT TO_CHAR(ac.DT_INICIO_CIRURGIA, 'DD/MM/YYYY HH24:MI') as dt,
                            cir.DS_CIRURGIA as ds,
                            CASE
                                WHEN ac.TP_SITUACAO = 'T' THEN
                                'Controle de checagem'
                            end as status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                        ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                        ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'T'
                        AND ac.CD_ATENDIMENTO = $var_atd
                        ORDER BY ac.DT_INICIO_CIRURGIA desc";
    $consulta_obs_P = "SELECT TO_CHAR(ac.Dt_Pre_Agendamento, 'DD/MM/YYYY HH24:MI') as dt,
                            cir.DS_CIRURGIA as ds,
                            CASE
                                WHEN ac.TP_SITUACAO = 'P' THEN
                                'Pre agendado'
                            end as status
                        FROM dbamv.AVISO_CIRURGIA ac
                        INNER JOIN dbamv.CIRURGIA_AVISO ca
                        ON ca.CD_AVISO_CIRURGIA = ac.CD_AVISO_CIRURGIA
                        INNER JOIN dbamv.CIRURGIA cir
                        ON cir.CD_CIRURGIA = ca.CD_CIRURGIA
                        WHERE ac.TP_SITUACAO = 'P'
                        AND ac.CD_ATENDIMENTO = $var_atd
                        ORDER BY dt desc";
    

    $result_obs = oci_parse($conn_ora, @$consulta_obs);
    oci_execute(@$result_obs);
    
    $result_obs_null = oci_parse($conn_ora, @$consulta_obs_null);
    oci_execute(@$result_obs_null);
    

    $result_obs_cancelado = oci_parse($conn_ora, @$consulta_obs_cancelado);
    oci_execute(@$result_obs_cancelado);
    $result_obs_g = oci_parse($conn_ora, @$consulta_obs_g);
    oci_execute(@$result_obs_g);
    $result_obs_T = oci_parse($conn_ora, @$consulta_obs_T);
    oci_execute(@$result_obs_T);
    $result_obs_P = oci_parse($conn_ora, @$consulta_obs_P);
    oci_execute(@$result_obs_P);
        


    

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
                    while($row_dur_null = oci_fetch_array(@$result_obs_null)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_null['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_null['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_null['STATUS'] . '</td>';
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


</br> 
<h11>Cancelado</h11>
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
                    while($row_dur_cancelado = oci_fetch_array(@$result_obs_cancelado)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_cancelado['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_cancelado['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_cancelado['STATUS'] . '</td>';
                    echo'</tr>';
                }
                }      
            ?>

        </tbody>



        </table>

</div>


</br> 
<h11>Em aviso</h11>
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
                    while($row_dur_g = oci_fetch_array(@$result_obs_g)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_g['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_g['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_g['STATUS'] . '</td>';
                    echo'</tr>';
                    }
                }         
            ?>

        </tbody>



        </table>

</div>
</br> 
<h11>Controle de Checagem</h11>
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
                    while($row_dur_T = oci_fetch_array($result_obs_T)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_T['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_T['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_T['STATUS'] . '</td>';
                    echo'</tr>';
                    }
                }            
            ?>

        </tbody>



        </table>

</div>
</br> 
<h11>Pré agendado</h11>
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
                    while($row_dur_P = oci_fetch_array(@$result_obs_P)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_P['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_P['DS'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_P['STATUS'] . '</td>';
                    echo'</tr>';
                    }
                } 
            ?>

        </tbody>



        </table>

</div>
