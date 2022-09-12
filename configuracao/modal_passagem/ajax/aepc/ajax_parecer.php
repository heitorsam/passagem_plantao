<?php 

    include '../../../../conexao.php';



    $var_atd = $_GET['atend'];

    $consulta_obs = "SELECT TO_CHAR(pm.dt_parecer, 'DD/MM/YYYY HH24:MI') as dt,
                            esp.DS_ESPECIALID as ds,
                            pm.DS_SITUACAO as status
                        FROM dbamv.PAR_MED pm
                        INNER JOIN dbamv.ESPECIALID esp
                        ON esp.CD_ESPECIALID = pm.CD_ESPECIALID
                        WHERE pm.CD_ATENDIMENTO = $var_atd
                        AND pm.DS_SITUACAO = 'Realizado'
                        ORDER BY dt desc";

    $consulta_obs_realizado = "SELECT TO_CHAR(pm.DT_SOLICITACAO, 'DD/MM/YYYY HH24:MI') as dt,
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
    
    

    $result_obs = oci_parse($conn_ora, @$consulta_obs);
    oci_execute(@$result_obs);

    $result_obs_realizado = oci_parse($conn_ora, @$consulta_obs_realizado);
    oci_execute(@$result_obs_realizado);
 

    $result_obs_cancelado = oci_parse($conn_ora, @$consulta_obs_cancelado);
    oci_execute(@$result_obs_cancelado);
       


?>
</br>


<h11>Solicitado</h11>

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
            while($row_dur_realizado = oci_fetch_array(@$result_obs_realizado)){

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
