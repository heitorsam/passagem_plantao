<?php 

    include '../../../conexao.php';

    $tipo = $_GET['tipo'];

    $var_atd = $_GET['atend'];

    if($tipo == 'par'){
        $consulta_obs = "SELECT TO_CHAR(pm.dt_parecer, 'DD/MM/YYYY HH24:MI') as dt,
                                esp.DS_ESPECIALID as ds,
                                pm.DS_SITUACAO as status
                            FROM dbamv.PAR_MED pm
                            INNER JOIN dbamv.ESPECIALID esp
                            ON esp.CD_ESPECIALID = pm.CD_ESPECIALID
                            WHERE pm.CD_ATENDIMENTO = $var_atd
                            AND pm.DS_SITUACAO = 'Realizado'
                            ORDER BY dt desc";

        $consulta_obs_null = "SELECT TO_CHAR(pm.DT_SOLICITACAO, 'DD/MM/YYYY HH24:MI') as dt,
                                esp.DS_ESPECIALID as ds,
                                pm.DS_SITUACAO as status
                            FROM dbamv.PAR_MED pm
                            INNER JOIN dbamv.ESPECIALID esp
                            ON esp.CD_ESPECIALID = pm.CD_ESPECIALID
                            WHERE pm.CD_ATENDIMENTO = $var_atd
                            AND pm.DS_SITUACAO = 'Solicitado'
                            ORDER BY dt desc";

        $consulta_obs_cancelado = "SELECT TO_CHAR(pm.dt_cancelamento, 'DD/MM/YYYY HH24:MI') as dt,
                                        esp.DS_ESPECIALID as ds,
                                        pm.DS_SITUACAO as status
                                    FROM dbamv.PAR_MED pm
                                    INNER JOIN dbamv.ESPECIALID esp
                                    ON esp.CD_ESPECIALID = pm.CD_ESPECIALID
                                    WHERE pm.CD_ATENDIMENTO = $var_atd
                                    AND pm.DS_SITUACAO = 'Cancelado'
                                    ORDER BY dt desc";
    }else if($tipo =='exa'){
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

        $consulta_obs_null = "SELECT TO_CHAR(itrx.dt_entrega, 'DD/MM/YYYY HH24:MI') as dt,
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

        
        
    }else if($tipo == 'lab'){
        $consulta_obs = "SELECT TO_CHAR(pm.hr_pre_med, 'DD/MM/YYYY HH24:MI') as dt,
                                tp.DS_TIP_PRESC as ds, 
                                tf.DS_TIP_FRE
                            FROM dbamv.PRE_MED pm
                            INNER JOIN dbamv.ITPRE_MED itpm
                            ON itpm.CD_PRE_MED = pm.CD_PRE_MED 
                            INNER JOIN dbamv.TIP_PRESC tp
                            ON tp.CD_TIP_PRESC = itpm.CD_TIP_PRESC
                            INNER JOIN dbamv.TIP_FRE tf
                            ON tf.CD_TIP_FRE = itpm.CD_TIP_FRE
                            WHERE itpm.CD_TIP_ESQ IN ('LAB')
                            AND pm.CD_ATENDIMENTO = $var_atd
                            ORDER BY dt desc, tf.DS_TIP_FRE asc";
        
    }else if($tipo == 'cir'){
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
    }

    if($var_atd != ''){

        $result_obs = oci_parse($conn_ora, @$consulta_obs);
        oci_execute(@$result_obs);
        if($tipo <> 'lab'){
            $result_obs_null = oci_parse($conn_ora, @$consulta_obs_null);
            oci_execute(@$result_obs_null);
            
        }
        if($tipo == 'par'){
            $result_obs_cancelado = oci_parse($conn_ora, @$consulta_obs_cancelado);
            oci_execute(@$result_obs_cancelado);
        }
        if($tipo == 'cir'){
            $result_obs_cancelado = oci_parse($conn_ora, @$consulta_obs_cancelado);
            oci_execute(@$result_obs_cancelado);
            $result_obs_g = oci_parse($conn_ora, @$consulta_obs_g);
            oci_execute(@$result_obs_g);
            $result_obs_T = oci_parse($conn_ora, @$consulta_obs_T);
            oci_execute(@$result_obs_T);
            $result_obs_P = oci_parse($conn_ora, @$consulta_obs_P);
            oci_execute(@$result_obs_P);
        }
        if($tipo == 'exa'){
            $result_obs_ag = oci_parse($conn_ora, @$consulta_obs_ag);
            oci_execute(@$result_obs_ag);
        }

    }

?>
</br>
<?php if($tipo == 'exa'){ ?>
    <h11>Agendado</h11>
    <span class="espaco_pequeno" style="width: 6px"></span>
    <div class="table-responsive col-md-12" style="padding: 0px !important;overflow-y: auto; max-height: 150px; overflow-x: hidden;">   
    
            <table class="table table-striped"  cellspacing="0" cellpadding="0">
                
            <thead>

                <tr>
                    <th style="text-align: center;">Descrição</th>
                    <th style="text-align: center;">Status</th>
                </tr>

            </thead>

            <tbody>

                <?php
                    if($var_atd != null){
                        while($row_dur_ag = oci_fetch_array(@$result_obs_ag)){

                        echo'<tr>';
                            echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_ag['DS'] . '</td>';
                            echo '<td class="align-middle" style="text-align: center;">' . @$row_dur_ag['STATUS'] . '</td>';
                        echo'</tr>';
                        }
                    }           
                ?>

            </tbody>



            </table>
    
    </div>
<?php } ?>
<?php if($tipo <> 'lab'){ ?>
    <?php if($tipo <> 'par'){ 
            if($tipo <> 'cir'){?>
            <h11>Aguardando Laudo</h11>
            <?php }else{ ?>
            <h11>Agendada</h11>
            <?php }
          }else{ ?>
        <h11>Solicitado</h11>
    <?php } ?>
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
    <?php if($tipo <> 'par' && $tipo <> 'cir'){ ?> 
        <h11>Laudado</h11>
    <?php }else{ ?>
        <h11>Realizado</h11>
    <?php } ?>
    <span class="espaco_pequeno" style="width: 6px"></span>
<?php } ?>
<div class="table-responsive col-md-12" style="padding: 0px !important;overflow-y: auto; max-height: 150px; overflow-x: hidden;">

    <table class="table table-striped"  cellspacing="0" cellpadding="0">
    
        <thead>

            <tr>
                <th style="text-align: center;">Data</th>
                <th style="text-align: center;">Descrição</th>
                <?php if($tipo == 'lab'){ ?>
                <th style="text-align: center;">Frequencia</th>
                <?php }else{ ?>
                <th style="text-align: center;">Status</th>
                <?php } ?>
            </tr>

        </thead>

        <tbody>

            <?php
                if($var_atd != null){
                    while(@$row_dur = oci_fetch_array(@$result_obs)){

                    echo'<tr>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur['DT'] . '</td>';
                        echo '<td class="align-middle" style="text-align: center;">' . @$row_dur['DS'] . '</td>';
                        if($tipo == 'lab'){ 
                            echo '<td class="align-middle" style="text-align: center;">' . @$row_dur['DS_TIP_FRE'] . '</td>';
                        }else{ 
                            echo '<td class="align-middle" style="text-align: center;">' . @$row_dur['STATUS'] . '</td>';
                        }
                    echo'</tr>';
                    }
                }        
            ?>

        </tbody>

        

    </table>
</div>

<?php if($tipo == 'par' || $tipo == 'cir'){ ?>
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
<?php } ?>

<?php if($tipo == 'cir'){ ?>
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
<?php } ?>