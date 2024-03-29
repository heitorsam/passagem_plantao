<?php 

    $var_leito = $_POST['leito'];

    include '../../conexao.php';

    $consulta = "SELECT DISTINCT pc.nm_paciente AS NM FROM dbamv.PACIENTE pc
                INNER JOIN dbamv.atendime at
                    ON at.cd_paciente = pc.cd_paciente
                INNER JOIN dbamv.mov_int mov
                    ON mov.cd_atendimento = at.cd_atendimento
                INNER JOIN dbamv.leito lt
                ON lt.cd_leito = mov.cd_leito
                where at.dt_alta is null
                and lt.ds_enfermaria = '$var_leito'
                and lt.tp_ocupacao in ('I','O')
                AND mov.CD_MOV_INT IN (                
                (SELECT MAX(aux_mi.CD_MOV_INT)
                 FROM dbamv.MOV_INT aux_mi
                 INNER JOIN dbamv.LEITO aux_lt
                   ON aux_lt.CD_LEITO = aux_mi.CD_LEITO
                 WHERE aux_lt.ds_enfermaria = '$var_leito'
                  and aux_lt.tp_ocupacao in ('I','O')))";

    $result = oci_parse($conn_ora, $consulta);

    oci_execute($result);

    $row = oci_fetch_array($result);

    echo $row['NM'];



?>